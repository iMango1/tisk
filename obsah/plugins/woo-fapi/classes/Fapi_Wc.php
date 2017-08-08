<?php
/**
 * @package   Woo Fapi
 * @author    Vladislav Musílek
 * @license   GPL-2.0+
 * @link      Toret.cz
 * @copyright 2014 Toret.cz
 */

class Fapi_Wc {
    
    /**
     * Construct
     *
     */        
    public function __construct() {
  
        add_action('woocommerce_api_fapi_wc', array($this, 'check_fapi_response') ); 
  
    }
  

    /**
     *
     *
     */        
    public function check_fapi_response(){
  
      
        $invoiceId = isset($_POST['id']) ? (int) $_POST['id'] : null;

        $invoice = null;
        if ($invoiceId) {
        
            //Get login data
            $fapi_email     = get_option('wc_settings_tab_fapi_email');
            $fapi_password  = get_option('wc_settings_tab_fapi_password');
    
            //Get FAPI Client instance
            $fapi = new FAPIClient($fapi_email, $fapi_password);
        
            //Get invoice
            $invoice = $fapi->invoice->get($invoiceId);
        
            //Invoice exist and is paid
            if ($invoice && $invoice['paid']) {
        
                if ($invoice['proforma']) { // pokud se jedná o zálohovou fakturu
          
                    $info = 'Notifikace zaplacené faktury - proforma';
                    $log  = 'Id proforma faktury: '.$invoiceId;
                    $this->log_info($info, $log);
            
            
                    //Get order id by Fapi invoice id
                    $key = 'fapi_invoice_id';
                    global $wpdb;
                        $meta = $wpdb->get_results("SELECT * FROM `".$wpdb->postmeta."` WHERE meta_key='".$wpdb->escape($key)."' AND meta_value='".$wpdb->escape($invoiceId)."'");
                        if (is_array($meta) && !empty($meta) && isset($meta[0])) {
                            $meta = $meta[0];
                        }	
                    $info = 'Notifikace zaplacené objednávky';
                    $log  = 'Id objednávky: '.$meta->post_id;
                    $this->log_info($info, $log);
                    if($meta->post_id){
               
                        //Update order status
                        $order = new WC_Order($meta->post_id);
                        $order->update_status('completed',$meta->post_id);                  
                  
                    }
                        
                }else{
          
                    $info = 'Notifikace zaplacené faktury';
                    $log  = 'Id faktury: '.$invoiceId;
                    $this->log_info($info, $log);
	       
                }
        
            }
          
        }else{
      
            $info = 'Notifikace zaplacené faktury';
            $log  = 'Nebylo zadáno Id faktury.';
            $this->log_info($info, $log);

        }
      
    }
  
  
    /**
     * Write log info
     *
     *
     */           
    private function log_info($info, $log){
   
        $file = FAPIDIR.'notify_log.txt';
        $current = file_get_contents($file);
        $current .= date('D, d M Y H:i:s').' '.$info.PHP_EOL;
        $current .= $log.PHP_EOL;
        file_put_contents($file, $current);
      
    }

}

