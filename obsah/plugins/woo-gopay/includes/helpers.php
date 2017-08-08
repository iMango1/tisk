<?php 

/**
 * Save notify log
 *    
 */ 
function gopay_save_notify($line){
  
  $file = WOOGPDIR.'notify_log.txt';
  $current = file_get_contents($file);
  $current .= date('D, d M Y H:i:s').PHP_EOL;
  $current .= $line.PHP_EOL;
  file_put_contents($file, $current);
  
}  

/**
 * Get GoPay server test/production
 *
 */  
function set_gopay_test_config( $gopay_option ){

  if( $gopay_option['test'] == 'yes' ){
	     GopayConfig::init( GopayConfig::TEST );
  }else{
	     GopayConfig::init( GopayConfig::PROD );
  }

} 


/**
 * @package   Toret GoPay
 * @author    Vladislav Musílek
 * @license   GPL-2.0+
 * @link      http://toret.cz
 * @copyright 2016 Toret.cz
 */

class Toret_GoPay_Log {

  /**
   * Uložíme log do databáze
   *
   * @since 2.0.0
   */
  public static function save( $log, $status, $context, $note = '-' ){

    $data = array(
        'date'    => date('D, d M Y H:i:s'),
        'log'     => $log,
        'status'  => $status,
        'context' => $context,
        'note'    => $note
      );

    global $wpdb;
    $insert = $wpdb->insert( $wpdb->prefix.'gopay_log', $data ); 
    return $wpdb->last_query;

  }

  /**
   *
   *
   *
   */
  public static function get_all_logs(){

    global $wpdb;
    
    $data = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix."gopay_log ORDER BY date DESC LIMIT 500" ); 

    return $data;

  }

  public static function delete_logs(){

    global $wpdb;
    
    $wpdb->query('TRUNCATE TABLE '.$wpdb->prefix.'gopay_log');
    

  }


}