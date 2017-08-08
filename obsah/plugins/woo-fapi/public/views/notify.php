<?php
    
      $invoiceId = isset($_POST['id']) ? (int) $_POST['id'] : null;

      $info = 'Notifikace zaplacené faktury - post data';
            $log  = serialize( $_POST );
            fapi_log_info($info, $log);


      $invoice = null;
      if ($invoiceId) {
        
        //Get login data
        $fapi_email     = get_option('wc_settings_tab_fapi_email');
        $fapi_password  = get_option('wc_settings_tab_fapi_password');
    
        //Get FAPI Client instance
        $fapi = new FAPIClient( $fapi_email, $fapi_password );
        
        //Get invoice
        $invoice = $fapi->invoice->get( $invoiceId );
        
        //Invoice exist and is paid
        if ($invoice && $invoice['paid']) {
        
          if ($invoice['proforma']) { // pokud se jedná o zálohovou fakturu
          
            $info = 'Notifikace zaplacené faktury - proforma';
            $log  = 'Id proforma faktury: '.$invoiceId;
            fapi_log_info($info, $log);
            
            
             //Get order id by Fapi invoice id
             $key = 'fapi_invoice_id';
             global $wpdb;
	           $meta = $wpdb->get_results("SELECT * FROM `".$wpdb->postmeta."` WHERE meta_key='".$wpdb->escape($key)."' AND meta_value='".$wpdb->escape($invoiceId)."'");
	             if (is_array($meta) && !empty($meta) && isset($meta[0])) {
		              $meta = $meta[0];
  	           }	
              
              $info = 'Notifikace zaplacené objednávky';
              $log  = 'Id objednávky: '.$meta->post_id;
              fapi_log_info($info, $log);
              if($meta->post_id){
               
                  //Update order status
                  $order = new WC_Order($meta->post_id);
                  $order->update_status('completed',$meta->post_id);
                  
                  
              }
            
            
          }else{
          
            $info = 'Notifikace zaplacené faktury';
            $log  = 'Id faktury: '.$invoiceId;
            fapi_log_info($info, $log);
	       
          }
        
        }
        
          
          
      }else{
      
            $info = 'Notifikace zaplacené faktury';
            $log  = 'Nebylo zadáno Id faktury.';
            fapi_log_info($info, $log);

      }
      
