<?php


  Toret_GoPay_Log::save( $_SERVER['REQUEST_URI'], 'n', 'response', 'Odpověď z GoPay' ); 

	/**
	 * Provede overeni zaplacenosti objednavky po zpetnem presmerovani z platebni brany
	 * 
	 */
  $gopay = new WC_Gateway_Woo_GoPay();
  $gopay_option = get_option( 'woocommerce_gopay_settings' );
		
	/*
	 * Parametry obsazene v redirectu po potvrzeni / zruseni platby, predavane od GoPay e-shopu
	 */
	$returnedPaymentSessionId   = $_GET['paymentSessionId'];
	$returnedGoId               = $_GET['targetGoId'];
	$returnedOrderNumber        = $_GET['orderNumber'];
	$returnedEncryptedSignature = $_GET['encryptedSignature'];
  $payment_method             = $_GET['p1'];

	/*
	 * Nacist data objednavky dle prichoziho paymentSessionId, zde z testovacich duvodu vse primo v testovaci tride Order
	 * Upravte dle ulozeni vasich objednavek
	 */
	$order            = new WC_Order($returnedOrderNumber);
	$paymentSessionId = get_post_meta($order->id, '_paymentSessionId', true);
  $wpml_lang        = get_post_meta($order->id, 'wpml_order_lang', true);
  update_post_meta($order->id, 'gopay-response-status', 'default');
  

  

  /**
   * Pokud se neshoduje zaslané a uložené id, přesměrujeme
   */     
	if($paymentSessionId != $returnedPaymentSessionId){
  
    $location = $order->get_checkout_order_received_url();
  
      $url_args = array(
        'order-received' => $order->id,
        'key'            => $order->order_key,
        'error-info'     => 'sessionid-se-neshoduje',
        'sessionState'   => GopayHelper::FAILED
      );
  
    //Save info about response
    update_post_meta($order->id, 'gopay-response-status', 'not equal order id');
  
    $location = add_query_arg($url_args,$location); 
	 header("Location: " . $location );
	 exit;
 	
	}
  
  /**
   * Get currency
   */     
  $gopay_currency = get_post_meta( $order->id, 'gopay_order_currency', true ); 
   
  //Get order total price
  /**
   * This detect active woocommerce currency switcher plugin
   * and check language and currencies
   */           
  $active_plugins = get_option('active_plugins');
    if(in_array('woocommerce-currency-switcher/index.php', $active_plugins)){
      
      //WOOCS přepočet ceny
      Toret_GoPay_Define::get_woocs_price( $gopay_currency, $order->get_total() );
    
    }else{
      
      if(in_array('toret-zaokrouhleni-objednavky.php', $active_plugins)){
        $sub_price = round( $order->get_total() );
      }else{
        $sub_price = $order->get_total();
      }

      $price = (int)($sub_price*100);
        //$price = (int)($order->get_total()*100);
    
    }
  

	/*
	 * Kontrola validity parametru v redirectu, opatreni proti podvrzeni potvrzeni / zruseni platby
	 */
try {
		 
      GopayHelper::checkPaymentIdentity(
					(float)$returnedGoId,
					(float)$returnedPaymentSessionId,
					null,
					$returnedOrderNumber,
					$returnedEncryptedSignature,
					(float)$gopay->goid,
					$order->id,
					$gopay->secure_key);
          
      
		  /*
		   * Kontrola zaplacenosti objednavky na serveru GoPay
		   */
		  $result = GopaySoap::isPaymentDone(
					(float)$returnedPaymentSessionId,
					(float)$gopay->goid,
					$order->id,
					(int)$price,
					$gopay_currency,
					$order->billing_first_name.' '.$order->billing_last_name,
					$gopay->secure_key);
	
      Toret_GoPay_Log::save( 'Stav platby: '.$result["sessionState"] , 'n', 'response', 'Objednávka: '.$order->id  ); 




  
		  update_option( 'gopay_result', $result );
    
      //Set location url for each else
      $location = $order->get_checkout_order_received_url();
  
    //Set url args for each else
    $url_args = array();

    if ($result["sessionState"] == GopayHelper::PAID ) {
		  //Zaplaceno - aktualizovat stav objednávky


    	/*
			 * Zpracovat pouze objednavku, ktera jeste nebyla zaplacena 
			 */
      Toret_GoPay_Log::save( 'Stav objednávky: '.$order->status, 'n', 'response', 'Objednávka: '.$order->id  );
       
			//if ( $order->status != 'completed' AND $order->status != 'failed') {
      if ( $order->status != 'completed' ) {
      
          $gopay->processPayment();
          $items = $order->get_items();
        
          if ( class_exists('WC_Pre_Orders_Order') && WC_Pre_Orders_Order::order_contains_pre_order( $order->id ) ) {
        
            $order->update_status('pre-ordered',$returnedPaymentSessionId);   
            $url_args['error-info'] = 'preordered';
            $url_args['status']     = 'preordered';
        
          }else{
        
            $has_virtual = true;
            foreach($items as $item){
              $product = new WC_Product( $item['product_id'] );
              if( !$product->is_virtual() ){
                $has_virtual = false;
              }
            }
        
            if($has_virtual){
          
              $order->update_status( 'completed', $returnedPaymentSessionId );
              $url_args['error-info'] = 'zaplacena';
              $status = 'completed';
              $url_args['status']     = apply_filters( 'gopay_notify_virtual_product_status', $status, $order );
            
              Toret_GoPay_Log::save( 'Objednávka má pouze virtuální produkty', 'n', 'response', 'Objednávka: '.$order->id );
            
            }else{
  				
              $order->update_status('processing',$returnedPaymentSessionId);
              $url_args['error-info'] = 'zaplacena';
              $status = 'processing';
              $url_args['status']     = apply_filters( 'gopay_notify_normal_product_status', $status, $order );   
          
              Toret_GoPay_Log::save( 'Objednávka má i hmotné produkty', 'n', 'response', 'Objednávka: '.$order->id );
            
            } 
          
          }
          
          Toret_GoPay_Log::save( 'Error info '.$order->id, 'n', 'response', $url_args['error-info'] );        
        }
        
		  } else if ( $result["sessionState"] == GopayHelper::PAYMENT_METHOD_CHOSEN) {
			  /* Platba ceka na zaplaceni */
			  $order->update_status('on-hold',$returnedPaymentSessionId);
	      $url_args['error-info'] = 'ceka-na-zaplaceni';
        $status = 'pending';
        $url_args['status']     = apply_filters( 'gopay_notify_payment_method_chosen', $status, $order );  
		                                                                 
		  } else if ( $result["sessionState"] == GopayHelper::CREATED) {
			  /* Platba nebyla zaplacena */
			  $order->update_status('on-hold',$returnedPaymentSessionId);
			  $url_args['error-info'] = 'ceka-na-zaplaceni';
        $status = 'on-hold';
        $url_args['status']     = apply_filters( 'gopay_notify_payment_created', $status, $order ); 
            
		  } else if ( $result["sessionState"] == GopayHelper::CANCELED) {
			  /* Platba byla zrusena objednavajicim */

        $gopay->cancelPayment();
			  $order->update_status('failed',$returnedPaymentSessionId);
        $url_args['error-info'] = 'zruseno-objednavajicim';
        $status = 'failed';
        $url_args['status']     = apply_filters( 'gopay_notify_payment_canceled', $status, $order ); 
		
		  } else if ( $result["sessionState"] == GopayHelper::TIMEOUTED) {
			  /* Platnost platby vyprsela  */
			  $gopay->timeoutPayment();
			  $order->update_status('failed',$returnedPaymentSessionId);
        $url_args['error-info'] = 'platnost-vyprsela';
        $status = 'failed';
        $url_args['status']     = apply_filters( 'gopay_notify_payment_timeouted', $status, $order ); 
		
		  } else if ( $result["sessionState"] == GopayHelper::AUTHORIZED) {
			  /* Platba byla autorizovana, ceka se na dokonceni  */
			  $gopay->autorizePayment();
	      $url_args['error-info'] = 'autorizovana-ceka';
        $status = 'pending';
        $url_args['status']     = apply_filters( 'gopay_notify_payment_authorized', $status, $order ); 
  
		  } else if ( $result["sessionState"] == GopayHelper::REFUNDED) {
			  /* Platba byla vracena - refundovana  */
			  $gopay->refundPayment();
			  $order->update_status('refunded',$returnedPaymentSessionId);
        $url_args['error-info'] = 'platba-refundovana';
        $status = 'refunded';
        $url_args['status']     = apply_filters( 'gopay_notify_payment_refunded', $status, $order ); 
	
		  } else {
			  /* Chyba ve stavu platby */
			  $order->update_status('failed',$returnedPaymentSessionId);
        $result["sessionState"] = GopayHelper::FAILED;
			  $url_args['error-info'] = 'chyba-stavu';
        $status = 'failed';
        $url_args['status']     = apply_filters( 'gopay_notify_payment_failed', $status, $order ); 
		
		  }
    
      //Save info about response
      update_post_meta($order->id, 'gopay-response-status', 'finish');
    
            $url_args['order-received']  = $order->id;
            $url_args['key']             = $order->order_key;
            $url_args['sessionState']    = $result["sessionState"];
            $url_args['sessionSubState'] = $result["sessionSubState"];
       
        $location = add_query_arg($url_args,$location);
    
        Toret_GoPay_Log::save( serialize( $url_args ), 'n', 'response', 'Objednávka - url args: '.$order->id );



		  header('Location: ' . $location );
      exit();      
    //}

	} catch (Exception $e) {
  
    Toret_GoPay_Log::save( serialize( $e ), 'e', 'response', 'Objednávka: '.$order->id ); 
		
    update_option( 'gopay_result',$e->getMessage() );
    /*
		 * Nevalidni informace z redirectu
		 */
    $order->update_status( 'failed',$returnedPaymentSessionId );
     
      $location = $order->get_checkout_order_received_url();
   
          $url_args['order-received']  = $order->id;
          $url_args['key']        = $order->order_key;
          $url_args['error-info'] = 'chyba-redirectu';
          $url_args['status']     = 'failed';
          
      //Save info about response
      update_post_meta( $order->id, 'gopay-response-status', 'redirect error' );   
      $location = add_query_arg($url_args,$location);    
		  header('Location: ' . $location );
  		exit;
	}
	
