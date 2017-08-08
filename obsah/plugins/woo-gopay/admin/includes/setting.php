<?php 


add_action( 'admin_init', 'check_woo_gopay_licence' );
add_action( 'init', 'check_woo_gopay_licence' );

/**
 *
 * Check if licence is active
 *
 */   
function check_woo_gopay_licence(){
  $licence_status = get_option('wooshop-gopay-licence');
  if(!empty($licence_status)){
    if($licence_status=='active'){
      global $lic;
      $lic = 'active';  
    }
  }
}

/**
 *
 * Control licence
 *
 */      
function control_woo_gopay_licence($licence){

  $ip = $_SERVER['REMOTE_ADDR'];

    $api_params = array(
				'licence' => $licence,
				'ip' 	    => $ip,
				'url'     => home_url()
			);

			// Call the custom API.
			$response = wp_remote_post( 'http://licence.toret.cz/wp-content/plugins/plc/control.php', array( 'timeout' => 35, 'sslverify' => false, 'body' => $api_params ) );

			// make sure the response came back okay
			if ( is_wp_error( $response ) ){
				return false;
      }
        
        if($response['body']=='ok'){
        update_option('wooshop-gopay-licence','active');
        update_option('wooshop-gopay-info','Vaše licence byla aktivována');
        update_option('wooshop-gopay-licence-key',$licence);
      }elseif($response['body']=='fail'){
        update_option('wooshop-gopay-info','Chyba ověřování, kontaktujte prosím podporu');
      }elseif($response['body']=='double'){
        update_option('wooshop-gopay-info','Licenční klíč byl již použit');
      }
        
}
