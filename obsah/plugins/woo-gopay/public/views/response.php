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
    $returnedWooOrderId         = $_GET['p2'];
    $gopay_product_name         = $_GET['p3'];
    $gopay_order_id             = $_GET['p4'];



	/*
	 * Nacist data objednavky dle prichoziho paymentSessionId, zde z testovacich duvodu vse primo v testovaci tride Order
	 * Upravte dle ulozeni vasich objednavek
	 */
	$order     = wc_get_order( $returnedWooOrderId );
    $order_key = Toret_Order_Compatibility::get_order_key( $order );
        //Woo 3.0.+ compatibility
        $version = toret_check_wc_version();
        if( $version === false ){
            $order_id = $order->id;
        }else{
            $order_id = $order->get_id();
        }


    update_post_meta( $order_id, 'gopay-returnedOrderNumber', $returnedOrderNumber );
    update_post_meta( $order_id, 'gopay-p1', $payment_method );
    update_post_meta( $order_id, 'gopay-p2', $returnedWooOrderId );
    update_post_meta( $order_id, 'gopay-p3', $gopay_product_name );
    update_post_meta( $order_id, 'gopay-p4', $gopay_order_id );


	$paymentSessionId = get_post_meta($order_id, '_paymentSessionId', true);
    $wpml_lang        = get_post_meta($order_id, 'wpml_language', true);
    update_post_meta( $order_id, 'gopay-response-status', 'default' );
  
    //Set location url for each else
    $checkout_url = $order->get_checkout_order_received_url();
    if( !empty( $wpml_lang ) ){
        
        global $sitepress;
        $sitepress->switch_lang( $wpml_lang );

        $page_id   = wc_get_page_id( 'checkout' );    
        $icl_object_id = icl_object_id( $page_id, 'page', true, $wpml_lang );
        $permalink = get_permalink( $icl_object_id );
      
        $order_received_url = wc_get_endpoint_url( 'order-received', $order_id, $permalink );

        if ( 'yes' == get_option( 'woocommerce_force_ssl_checkout' ) || is_ssl() ) {
            $order_received_url = str_replace( 'http:', 'https:', $order_received_url );
        }

        $order_received_url = add_query_arg( 'key', $order_key, $order_received_url );
        $location = $order_received_url;

    }else{
        $location = apply_filters( 'gopay_response_location_url', $checkout_url, $order, $order_key, $order_id );
    }

    /**
     * Pokud se neshoduje zaslané a uložené id, přesměrujeme
     */     
	if( $paymentSessionId != $returnedPaymentSessionId ){
  
        
        $url_args = array(
            'order-received' => $order_id,
            'key'            => $order_key,
            'error-info'     => 'sessionid-se-neshoduje',
            'sessionState'   => GopayHelper::FAILED
        );
  
        //Save info about response
        update_post_meta($order_id, 'gopay-response-status', 'not equal order id');
  
        $location = add_query_arg($url_args,$location); 
	    header("Location: " . $location );
	    exit;
 	
	}
  
    /**
     * Get currency
     */     
    $gopay_currency = get_post_meta( $order_id, 'gopay_order_currency', true ); 
   
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
  
    $price = (int)($order->get_total()*100);

	/*
	 * Kontrola validity parametru v redirectu, opatreni proti podvrzeni potvrzeni / zruseni platby
	 */

    update_post_meta( $order_id, 'gopay_check', $returnedGoId.', '.$returnedPaymentSessionId.', '.$returnedOrderNumber.', '.$returnedEncryptedSignature.', '.$gopay->goid.', '.$gopay_order_id.', '.$gopay->secure_key );

    try {
		 
        GopayHelper::checkPaymentIdentity(
					$returnedGoId,
					$returnedPaymentSessionId,
					null,
					(float)$returnedOrderNumber,
					$returnedEncryptedSignature,
					(float)$gopay->goid,
					(float)$gopay_order_id,
					$gopay->secure_key);
          

		      /*
		       * Kontrola zaplacenosti objednavky na serveru GoPay
		       */
		      $result = GopaySoap::isPaymentDone(
					(float)$returnedPaymentSessionId,
					(float)$gopay->goid,
					$gopay_order_id,
					(int)$price,
					$gopay_currency,
					$gopay_product_name,
					$gopay->secure_key );
	
        Toret_GoPay_Log::save( 'Stav platby: '.$result["sessionState"] , 'n', 'response', 'Objednávka: '.$order_id  ); 




  
		  update_option( 'gopay_result', $result );
    
        
  
        //Set url args for each else
        $url_args = array();

        if ($result["sessionState"] == GopayHelper::PAID ) {
		  //Zaplaceno - aktualizovat stav objednávky


    	/*
			 * Zpracovat pouze objednavku, ktera jeste nebyla zaplacena 
			 */
        Toret_GoPay_Log::save( 'Stav objednávky: '.$order->status, 'n', 'response', 'Objednávka: '.$order_id  );
       
			//if ( $order->status != 'completed' AND $order->status != 'failed') {
        if ( $order->status != 'completed' ) {
      
          $gopay->processPayment();
          $items = $order->get_items();
        
          if ( class_exists('WC_Pre_Orders_Order') && WC_Pre_Orders_Order::order_contains_pre_order( $order_id ) ) {
        
            $order->update_status('pre-ordered',$returnedPaymentSessionId);   
            $url_args['error-info'] = 'preordered';
            $url_args['status']     = 'preordered';
        
          }else{
        
            $has_virtual = true;
            foreach($items as $item){
              $product = wc_get_product( $item['product_id'] );
              if( !$product->is_virtual() ){
                $has_virtual = false;
              }
            }
        
            if($has_virtual){
              $url_args['order-received']  = $order_id;
              $order->update_status( 'completed', $returnedPaymentSessionId );
              $url_args['error-info'] = 'zaplacena';
              $status = 'completed';
              $url_args['status']     = apply_filters( 'gopay_notify_virtual_product_status', $status, $order );
            
              // Reduce stock levels
              $order->reduce_order_stock();

              Toret_GoPay_Log::save( 'Objednávka má pouze virtuální produkty', 'n', 'response', 'Objednávka: '.$order_id );
            
            }else{
  			   $url_args['order-received']  = $order_id;
              $order->update_status('processing',$returnedPaymentSessionId);
              $url_args['error-info'] = 'zaplacena';
              $status = 'processing';
              $url_args['status']     = apply_filters( 'gopay_notify_normal_product_status', $status, $order );   

              // Reduce stock levels
              $order->reduce_order_stock();
          
              Toret_GoPay_Log::save( 'Objednávka má i hmotné produkty', 'n', 'response', 'Objednávka: '.$order_id );
            
            } 
          
          }
          
          Toret_GoPay_Log::save( 'Error info '.$order_id, 'n', 'response', $url_args['error-info'] );        
        }
        
		  } else if ( $result["sessionState"] == GopayHelper::PAYMENT_METHOD_CHOSEN) {
			  /* Platba ceka na zaplaceni */
			  $url_args['order-received']  = $order_id;
        $order->update_status('on-hold',$returnedPaymentSessionId);
	      $url_args['error-info'] = 'ceka-na-zaplaceni';
        $status = 'pending';
        $url_args['status']     = apply_filters( 'gopay_notify_payment_method_chosen', $status, $order );  
		                                                                 
		  } else if ( $result["sessionState"] == GopayHelper::CREATED) {
			  /* Platba nebyla zaplacena */
			  $url_args['order-received']  = $order_id;
        $order->update_status('on-hold',$returnedPaymentSessionId);
			  $url_args['error-info'] = 'ceka-na-zaplaceni';
        $status = 'on-hold';
        $url_args['status']     = apply_filters( 'gopay_notify_payment_created', $status, $order ); 
            
		  } else if ( $result["sessionState"] == GopayHelper::CANCELED) {
			  /* Platba byla zrusena objednavajicim */
        $gopay->cancelPayment();
        
        $url_args['order-received']  = $order_id;
        $url_args['error-info'] = 'zruseno-objednavajicim';
        $status = 'canceled';
        $url_args['status']     = apply_filters( 'gopay_notify_payment_canceled', $status, $order ); 

        $order->update_status('failed',$returnedPaymentSessionId);
      
		  } else if ( $result["sessionState"] == GopayHelper::TIMEOUTED) {
			  /* Platnost platby vyprsela  */
			  $gopay->timeoutPayment();
        $url_args['order-received']  = $order_id;
			  $order->update_status('failed',$returnedPaymentSessionId);
        $url_args['error-info'] = 'platnost-vyprsela';
        $status = 'failed';
        $url_args['status']     = apply_filters( 'gopay_notify_payment_timeouted', $status, $order ); 
		
		  } else if ( $result["sessionState"] == GopayHelper::AUTHORIZED) {
			  /* Platba byla autorizovana, ceka se na dokonceni  */
			  $gopay->autorizePayment();
        $url_args['order-received']  = $order_id;
	      $url_args['error-info'] = 'autorizovana-ceka';
        $status = 'pending';
        $url_args['status']     = apply_filters( 'gopay_notify_payment_authorized', $status, $order ); 
  
		  } else if ( $result["sessionState"] == GopayHelper::REFUNDED) {
			  /* Platba byla vracena - refundovana  */
			  $gopay->refundPayment();
			  $order->update_status('refunded',$returnedPaymentSessionId);
        $url_args['order-received']  = $order_id;
        $url_args['error-info'] = 'platba-refundovana';
        $status = 'refunded';
        $url_args['status']     = apply_filters( 'gopay_notify_payment_refunded', $status, $order ); 
	
		  } else {
			  /* Chyba ve stavu platby */
			  $order->update_status('failed',$returnedPaymentSessionId);
        $url_args['order-received']  = $order_id;
        $result["sessionState"] = GopayHelper::FAILED;
			  $url_args['error-info'] = 'chyba-stavu';
        $status = 'failed';
        $url_args['status']     = apply_filters( 'gopay_notify_payment_failed', $status, $order ); 
		
		  }
    
        //Save info about response
        update_post_meta($order_id, 'gopay-response-status', 'finish');
    
            
            $url_args['key']             = $order_key;
            $url_args['sessionState']    = $result["sessionState"];
            $url_args['sessionSubState'] = $result["sessionSubState"];
       
        $location = add_query_arg($url_args,$location);
    
        Toret_GoPay_Log::save( serialize( $url_args ), 'n', 'response', 'Objednávka - url args: '.$order_id );

        // Reduce stock levels
        //wc_reduce_stock_levels( $order_id );

		  header('Location: ' . $location );
        exit();      
        //}

	} catch (Exception $e) {
  
        Toret_GoPay_Log::save( serialize( $e ), 'e', 'response', 'Objednávka: '.$order_id ); 
		
        update_option( 'gopay_result',$e->getMessage() );
        update_option( 'gopay_serialize',serialize( $e ) );
        /*
		 * Nevalidni informace z redirectu
		 */
        $order->update_status( 'failed',$returnedPaymentSessionId );
     
        
            $url_args['order-received']  = $order_id;
            $url_args['key']        = $order_key;
            $url_args['error-info'] = 'chyba-redirectu';
            $url_args['status']     = 'failed';
          
        //Save info about response
        update_post_meta( $order_id, 'gopay-response-status', 'redirect error' );
        update_post_meta( $order_id, 'gopay-response-message', $e->getMessage() );   
        $location = add_query_arg($url_args,$location);    
		      header('Location: ' . $location );
  		    exit;
	}
	
