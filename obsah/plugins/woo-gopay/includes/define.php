<?php 

/**
 * @package   Toret GoPay
 * @author    Vladislav Musílek
 * @license   GPL-2.0+
 * @link      http://toret.cz
 * @copyright 2016 Toret.cz
 */

class Toret_GoPay_Define {

  /**
   * Pole platebních metod, používaných v GoPay
   *
   *
   */
  static public function gopay_payment_methods(){

      $payment_methods = array(
          'eu_gp_u'   => __('Platební karta', 'woocommerce-gopay'),
          'eu_psc'    => __('Paysafecard', 'woocommerce-gopay'),
          'eu_paypal' => __('PayPal', 'woocommerce-gopay'),
          'SUPERCASH' => __('superCash', 'woocommerce-gopay'),
          'eu_pr_sms' => __('Premium SMS', 'woocommerce-gopay'),
          'cz_mp'     => __('Mobilní platba – M-Platba', 'woocommerce-gopay'),
          'cz_kb'     => __('Platba KB ', 'woocommerce-gopay'),
          'cz_rb'     => __('Platba RB', 'woocommerce-gopay'),
          'cz_mb'     => __('Platba mBank', 'woocommerce-gopay'),
          'cz_fb'     => __('Platba Fio Banky', 'woocommerce-gopay'),
          'cz_csas'   => __('Platba Česká spořitelna', 'woocommerce-gopay'),
          'eu_bank'   => __('Bankovní převod', 'woocommerce-gopay'),
          'eu_gp_w'   => __('GoPay účet', 'woocommerce-gopay')
      );
   
    return apply_filters( 'toret_gopay_payment_methods', $payment_methods );
    
  }

  /**
   * Pole caretních metod, používaných v GoPay
   *
   *
   */
  static public function gopay_card_methods(){

      $cards_methods = array(
        'cz_cs_c'  => __('Česká Spořitelna', 'woocommerce-gopay'),
        'eu_gp_u'  => __('UniCredit Bank', 'woocommerce-gopay'),
        'eu_gp_kb' => __('Komerční Banka', 'woocommerce-gopay'),
        'eu_cg'    => __('Platební karty A', 'woocommerce-gopay'),
        'eu_om'    => __('Platební karty B', 'woocommerce-gopay') 
      );
   
    return $cards_methods;

  }


  /**
   * Pole platebních metod, seřazených podle zadaného pořadí
   * v případě, že je pořadí prázdné, vrátí defaultní pole
   *
   * since 2.0.0
   */
  static public function get_gopay_payment_methods( $gopay_method_order = '' ){

    if( !empty( $gopay_method_order ) ){
   
      $default_payment_methods = self::gopay_payment_methods();

      $payment_methods = array();
      asort( $gopay_method_order );
      
        foreach($gopay_method_order as $key => $item ){
          $payment_methods[$key] = $default_payment_methods[$key]; 
        }
   
    }else{
   
      $payment_methods = self::gopay_payment_methods();
    
    }
   
    return $payment_methods;

  }



  /**
   * Ověření notifikace, pokud se jedná o opakovanou platbu 
   * Dokončení platby pro plugin Subscription
   *
   * since 2.0.0
   */
  static public function check_subscription_payment( $returnedParentPaymentSessionId ){

     global $wpdb;
     $data = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."postmeta WHERE meta_key = '_paymentSessionId' AND meta_value = ".$returnedParentPaymentSessionId."");
    

     if(!empty($data)){
        if(!empty($data[0]->post_id)){
          //If exist post id, create subscribtion
          $parent_order_id = $data[0]->post_id;
          
          $active_plugins = get_option('active_plugins');
            //Check if is subscribtion plugin active 
            if(in_array('woocommerce-subscriptions/woocommerce-subscriptions.php', $active_plugins)){
              //Check if order contains subscribtion
              if(WC_Subscriptions_Order::order_contains_subscription( $parent_order_id )){
                 var_dump($parent_order_id);
                 $order = new WC_Order($parent_order_id);
                 
                  $subscriptions_in_order = WC_Subscriptions_Order::get_recurring_items( $order );
                  $subscription_item      = array_pop( $subscriptions_in_order );
                  $product_id             = WC_Subscriptions_Order::get_items_product_id( $subscription_item );
                  $subscription_key       = WC_Subscriptions_Manager::get_subscription_key( $order->id, $product_id );
                  $subscription           = WC_Subscriptions_Manager::get_subscription( $subscription_key );
                  $is_first_payment       = empty( $subscription['completed_payments'] ) ? true : false;
                 
                  
                  WC_Subscriptions_Manager::process_subscription_payments_on_order( $order );
                  exit(0);
              
              }else{
                 Toret_GoPay_Log::save( 'Objednávka '.$parent_order_id.' neobsahuje předplatné!', 'e', 'notify', 'Kontrola Subscription' );          
              }
          
            }else{
                Toret_GoPay_Log::save( 'Předplatné není aktivní', 'e', 'notify', 'Kontrola Sunscription' ); 
            }
          
        }else{
          //If not, save notify info and redirect
            Toret_GoPay_Log::save( 'Objednávka pro předplatné neexistuje', 'e', 'notify', 'Kontrola Sunscription' ); 
            header("HTTP/1.1 500 Internal Server Error");
            exit(0);
         
        }
     
     }
    exit(0);
  }

  /**
   * Výpočet ceny, při použití pluginu WOOCS
   *
   * @since 2.0.0
   */
  static public function get_woocs_price( $currency, $order_total ){

      $woocs = get_option( 'woocs' );
    
      $rate      = $woocs[$currency]['rate'];
      $sub_price = $order_total;
      
      if( !empty( $rate ) ){ 
          $rate_price = $sub_price * $rate; 
      }else{ 
          $rate_price = $sub_price; 
      }
    
      $decimals   = get_option( 'woocommerce_price_num_decimals' );
      $rate_price = round( $rate_price, $decimals ); 
      $price      = (int)( $rate_price*100 );
       
      //Return price
      return $price;

  }

  /**
   * Nastavení země objednávky GoPay používá třípísmený kód, WooCommerce dvoupísmený
   *
   * @since 2.0.0
   */
  static public function set_order_country( $order_country ){

    if($order_country == 'CZ'){ 
      $country = 'CZE'; 
    }
    elseif($order_country == 'SK'){ 
      $country = 'SVK'; 
    }
    else{
      $get_country_code = new CountriesList();
      $country = $get_country_code->convertIso2to3( $order_country );
    }
      
    return $country;

  }

  
    


}