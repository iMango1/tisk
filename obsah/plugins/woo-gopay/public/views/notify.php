<?php
                        


  Toret_GoPay_Log::save( $_SERVER['REQUEST_URI'], 'n', 'notify', 'Notifikace z GoPay' ); 
  
  //Get GoPay Gateway instance
  $gopay = new WC_Gateway_Woo_GoPay();
  //Get Gopay gateway setting    
  $gopay_option = get_option( 'woocommerce_gopay_settings' );
  //Set test or productions server
  set_gopay_test_config( $gopay_option );
  
  
    /*
	 * Parametry obsazene v notifikaci platby, predavane od GoPay e-shopu
	 */
	$returnedPaymentSessionId   	= $_GET['paymentSessionId'];
	$returnedParentPaymentSessionId = $_GET['parentPaymentSessionId'];
	$returnedGoId               	= $_GET['targetGoId'];
	$returnedOrderNumber        	= $_GET['orderNumber'];
	$returnedEncryptedSignature 	= $_GET['encryptedSignature'];
    $payment_method             	= $_GET['p1'];
    $returnedWooOrderId         	= $_GET['p2'];
    $gopay_product_name         	= $_GET['p3'];
    $gopay_order_id             	= $_GET['p4'];

  	$payment_method = get_post_meta($returnedWooOrderId,'_selected_paymentchannel');
  
  	//Get order object
	$order = wc_get_order( $returnedWooOrderId );
  	$order_key = Toret_Order_Compatibility::get_order_total( $order );
  	$order_status = Toret_Order_Compatibility::get_order_status( $order );
  		//Woo 3.0.+ compatibility
  		$version = toret_check_wc_version();
  		if( $version === false ){
  			$order_id = $order->id;
  		}else{
  			$order_id = $order->get_id();
  		}
  
  
  
	if ( empty( $returnedParentPaymentSessionId ) ) {
    
    	//Set null parent session id
      	$returnedParentPaymentSessionId = null;
      	//Control returned session id and saved id
      	$paymentSessionId = get_post_meta( $order_id, '_paymentSessionId', true );
      	//If not equal, its false notify - redirect
		if($paymentSessionId != $returnedPaymentSessionId){
		  
		  	Toret_GoPay_Log::save( 'Neshoduje se paymentSessionId a returnedPaymentSessionId v notifikaci', 'e', 'notify', 'Notifikace z GoPay' ); 
         	header("HTTP/1.1 200 Neshoduje se paymentSessionId a returnedPaymentSessionId v notifikaci");
			exit(0);
		  
		}	
	
	}else{
		/**
		 * If parrent session id is not empty, it is repeat payment
		 * we must check order parent id 
		 *
		 */ 
		Toret_GoPay_Define::check_subscription_payment( $returnedParentPaymentSessionId );                   

	}
  
  
  
  
  
  	$gopay_currency = get_post_meta($order_id,'gopay_order_currency',true);
	
	/**
   	 * This detect active woocommerce currency switcher plugin
   	 * and check language and currencies
   	 * TODO - refactoring
  	 */           
  	$active_plugins = get_option('active_plugins');
    if(in_array('woocommerce-currency-switcher/index.php', $active_plugins)){
    
    
      	$woocs = get_option('woocs');
    
      	$rate = $woocs[$gopay_currency]['rate'];
      	$sub_price = $order->get_total();
      	
      		if(!empty($rate)){ 
      			$rate_price = $sub_price * $rate; 
      		}else{ 
      			$rate_price = $sub_price; 
      		}
      	$decimals = get_option('woocommerce_price_num_decimals');
      	$rate_price = round($rate_price,$decimals); 
      	$price = (int)($rate_price*100);
    
    }else{
    
        if(in_array('toret-zaokrouhleni-objednavky.php', $active_plugins)){
        	$sub_price = round( $order->get_total() );
      	}else{
        	$sub_price = $order->get_total();
      	}

      	$price = (int)($sub_price*100);
        //$price = (int)($order->get_total()*100);
    }
  
  
  
  
  
  	/**
	 * Kontrola validity parametru v http notifikaci, opatreni proti podvrzeni potvrzeni platby (notifikace)
	 */
	try {
	
		GopayHelper::checkPaymentIdentity(
					(float)$returnedGoId,
					(float)$returnedPaymentSessionId,
					(float)$returnedParentPaymentSessionId,
					(float)$returnedOrderNumber,
					$returnedEncryptedSignature,
					(float)$gopay->goid,
					(float)$gopay_order_id,
					$gopay->secure_key);

		/*
		 * Kontrola zaplacenosti objednavky na strane GoPay
		 */
		$result = GopaySoap::isPaymentDone(
										(float)$returnedPaymentSessionId,
										(float)$gopay->goid,
										$gopay_order_id,
										(int)$price,
										$gopay_currency,
										$gopay_product_name,
										$gopay->secure_key);
	
  
   		Toret_GoPay_Log::save( $result["sessionState"], 'n', 'notify', 'Kontrola zaplacenosti objednavky na strane GoPay' ); 
  
  
		if ($result["sessionState"] == GopayHelper::PAID) {
			/*
			 * Zpracovat pouze objednavku, ktera jeste nebyla zaplacena 
			 */
			if ( empty( $returnedParentPaymentSessionId ) ) {
				// notifikace o bezne platbe
	
				if ( $order_status != 'completed' ) {
	
        			if ( class_exists('WC_Pre_Orders_Order') && WC_Pre_Orders_Order::order_contains_pre_order( $order_id ) ) {
          
            			$order->update_status('pre-ordered',$order_id);
           				//TODO: maybe set some functions
        			}else{
					
						/**
					 	 * Zpracovani objednávky
					 	 *
					 	 * Pro odeslání emailu zákazníku, u kterého nejprve platba selhala,
					 	 * musíme nastavit status objednávky on-hold, protože WooCommerce nezná akci pending_to_processing
					 	 * ale pouze failed_to_on_hold          
						 */
           				$order->update_status('on-hold',$returnedPaymentSessionId);
           
						$gopay->processPayment();
          
          				//Check if is product virtual
          				$items = $order->get_items();
          				$has_virtual = true;
          				foreach($items as $item){
            				$product = wc_get_product( $item['product_id'] );
              					if( !$product->is_virtual() ){
                  					$has_virtual = false;
              					}
          				}
        
          				if($has_virtual == true){
            				$status = 'completed';
                            $set_status = apply_filters( 'gopay_notify_virtual_product_status', $status, $order );
            				$order->update_status( $set_status, $returnedPaymentSessionId );
            				Toret_GoPay_Log::save( 'Stav objednávky byl nastaven na dokončeno', 's', 'notify', 'Objednávka má pouze virtuální produkty' ); 
            		
          				}else{
  				  			$status = 'processing';
            				$set_status = apply_filters( 'gopay_notify_normal_product_status', $status, $order );
  				  			$order->update_status($set_status,$returnedPaymentSessionId);
            				Toret_GoPay_Log::save( 'Stav objednávky byl nastaven na zpracovává se', 's', 'notify', 'Objednávka má i hmotné produkty' ); 
            
          				} 
					
          
        			}  
              
				}
	
			} else {
				
				// TODO: notifikace o rekurentni platbe
	
			}
		
		} else if ( $result["sessionState"] == GopayHelper::CANCELED) {
			/* Platba byla zrusena objednavajicim */
			$gopay->cancelPayment();
			$status = 'cancelled';
      		$set_status = apply_filters( 'gopay_notify_payment_canceled', $status, $order );  
			$order->update_status($set_status,$returnedPaymentSessionId);
			Toret_GoPay_Log::save( 'Stav objednávky byl nastaven na selhalo', 'e', 'notify', 'Platba byla zrusena objednavajicim' ); 
	
		} else if ( $result["sessionState"] == GopayHelper::TIMEOUTED) {
			/* Platnost platby vyprsela  */
			$gopay->timeoutPayment();
			$status = 'failed';
      		$set_status = apply_filters( 'gopay_notify_payment_timeouted', $status, $order );  
			$order->update_status($set_status,$returnedPaymentSessionId);
			Toret_GoPay_Log::save( 'Stav objednávky byl nastaven na selhalo', 'e', 'notify', 'Platnost platby vyprsela' ); 
	
		} else if ( $result["sessionState"] == GopayHelper::REFUNDED) {
			/* Platba byla vracena - refundovana */
			$status = 'refunded';
      		$set_status = apply_filters( 'gopay_notify_payment_refunded', $status, $order );
			$order->update_status($set_status,$returnedPaymentSessionId);
			$gopay->refundePayment();
			Toret_GoPay_Log::save( 'Stav objednávky byl nastaven na vráceno', 's', 'notify', 'Platba byla vracena - refundovana' ); 
		
		} else if ( $result["sessionState"] == GopayHelper::AUTHORIZED) {
			/* Platba byla autorizovana, ceka se na dokonceni  */
			$gopay->autorizePayment();
			Toret_GoPay_Log::save( 'Stav objednávky se nezměnil', 's', 'notify', 'Platba byla autorizovana, ceka se na dokonceni' ); 
		
		} else {
			$order->update_status('failed',$returnedPaymentSessionId);
			Toret_GoPay_Log::save( 'Došlo k neočekávané chybě', 'e', 'notify', 'HTTP/1.1 500 Internal Server Error' ); 
			header("HTTP/1.1 200 Došlo k neočekávané chybě");
			exit(0);
		
		}
	
	} catch (Exception $e) {

		Toret_GoPay_Log::save( serialize( $e ) , 'e', 'notify', 'Chyba kontroly zaplacenosti objednávky' ); 

		$order->update_status( 'failed', $returnedPaymentSessionId );
		header("HTTP/1.1 200 Chyba kontroly zaplacenosti objednávky");
		exit( 0 );
	}
?>