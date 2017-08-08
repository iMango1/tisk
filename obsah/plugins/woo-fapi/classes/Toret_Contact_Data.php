<?php
/**
 * @package   Woo Fapi
 * @author    Vladislav Musílek
 * @license   GPL-2.0+
 * @link      Toret.cz
 * @copyright 2016 Toret.cz
 */

class Toret_Contact_Data {
    
    public $order = null;

    public $order_meta = null;

    public $fapi = null;

    /**
     * Construct
     *
     */        
    public function __construct( $order, $order_meta, $fapi ) {
  
        $this->order = $order;
        $this->order_meta = $order_meta;
        $this->fapi = $fapi;
  
    }

    
    /**
     * Get contact id
     * If contact not exists - create new
     * If exists - update contact data
     */
    public function get_contact_id(){

        $cond = array('email' => $this->order_meta['_billing_email'][0], 'single' => '1');
        $check_user = $this->fapi->client->search( $cond ); 
            if( empty( $check_user['id'] ) ){
                $fapi_user_id = $this->new_user( $this->order, $this->order_meta, $this->fapi );                   
            }else{
                $fapi_user_id = $check_user['id'];
                $this->check_user_data($this->order, $this->order_meta, $this->fapi, $check_user);
            } 
     
        if($fapi_user_id === false){
            return false;
        }else{ 
            update_post_meta( $this->order->id, 'fapi_user_id', $fapi_user_id );
            return $fapi_user_id;
        }

    }

    /**
     * New user
     *
     */
    private function new_user( $order, $order_meta, $fapi ){
      
        $new_user = $this->create_user( $order, $order_meta, $fapi );
        
            //Uložit info o selhání při vytvoření uživatele                                                                                      
            if(false === $new_user){
              $this->save_notify(' Objednávka číslo: '.$order_id, 'Chyba při vytváření klienta');    
              $order->add_order_note( 'Nepodařilo se vytvořit klienta ve Fapi, Faktura nebyla stažena!' );
            }else{
                if( !empty( $new_user['id'] ) ){
                    return $new_user['id'];
                }else{
                    return false;
                }
            } 
    }


    /**
     * Create new user
     *
     * @since 1.0.3  
     */        
    private function create_user( $order, $order_meta, $fapi ){
        
        $data = array();
        $data['first_name'] = $order_meta['_billing_first_name'][0];
        $data['last_name']  = $order_meta['_billing_last_name'][0];
        $data['phone']      = $order_meta['_billing_phone'][0];
        $data['email']      = $order_meta['_billing_email'][0];
        
        if(!empty($order_meta['_billing_company'][0])){ 
          $data['company']  = $order_meta['_billing_company'][0];
        }
                
        $ic = $this->get_ic( $order_meta );
        if( $ic != false ){ $data['ic']  = $ic; }

        $dic = $this->get_dic( $order_meta );
        if( $dic != false ){ $data['dic']  = $dic; }

        $address = $order_meta['_billing_address_1'][0];
        if(!empty($order_meta['_billing_address_2'][0])){ 
          $address .= ' '.$order_meta['_billing_address_2'][0]; 
        }
        
        $country    = $order_meta['_billing_country'][0];
        
        $data['address']    = array(
                              'street'  => $address,
                              'city'    => $order_meta['_billing_city'][0],
                              'zip'     => $order_meta['_billing_postcode'][0],
                              'country' => $country
                            );

        
        if ( $order->get_formatted_billing_address() != $order->get_formatted_shipping_address() ){
            $shipping_address = $this->get_shipping_address( $order_meta );
            if( $shipping_address != false ){                    
                $data['shipping_address'] = $shipping_address;              
            }
        }

        $new_user = $this->fapi->client->create($data);
  
        return $new_user;         
    }
  
    /**
     * Get shippin address
     *
     * @since 1.0.0  
     */        
    private function get_shipping_address($order_meta){
  
        $shipping_adress = array();
    
        if(!empty($order_meta['_shipping_first_name'][0])){
            $shipping_adress['name']    = $order_meta['_shipping_first_name'][0];
        }  
    
        if(!empty($order_meta['_shipping_last_name'][0])){
            $shipping_adress['surname'] = $order_meta['_shipping_last_name'][0];
        }
    
        if(!empty($order_meta['_shipping_address_1'][0])){
            $address = $order_meta['_shipping_address_1'][0];
        
            if(!empty($order_meta['_shipping_address_2'][0])){ 
                $address .= ' '.$order_meta['_shipping_address_2'][0]; 
            }
            $shipping_adress['street'] = $address;  
        }
    
        if(!empty($order_meta['_shipping_city'][0])){
            $shipping_adress['city']     = $order_meta['_shipping_city'][0];
        }   
        if(!empty($order_meta['_shipping_postcode'][0])){
            $shipping_adress['zip']      = $order_meta['_shipping_postcode'][0];
        }
        if(!empty($order_meta['_shipping_country'][0])){
            $shipping_adress['country']  = $order_meta['_shipping_country'][0];
        }

        if(!empty($shipping_adress)){
            return $shipping_adress;
        }else{
            return false;
        }
    } 
  
    /**
     * Check user data
     *    
     * @since 1.0.4
     */
    private function check_user_data($order, $order_meta, $fapi, $check_user){
  
     
        $data = array();
        $data['first_name'] = $order_meta['_billing_first_name'][0];
        $data['last_name']  = $order_meta['_billing_last_name'][0];
        $data['phone']      = $order_meta['_billing_phone'][0];
        $data['email']      = $order_meta['_billing_email'][0];
        
        if(!empty($order_meta['_billing_company'][0])){ 
            $data['company']  = $order_meta['_billing_company'][0];
        }

        $ic = $this->get_ic( $order_meta );
        if( $ic != false ){ $data['ic']  = $ic; }

        $dic = $this->get_dic( $order_meta );
        if( $dic != false ){ $data['dic']  = $dic; }
        
        $address = $order_meta['_billing_address_1'][0];
            if(!empty($order_meta['_billing_address_2'][0])){ 
                $address .= ' '.$order_meta['_billing_address_2'][0]; 
            }  
        $country = $order_meta['_billing_country'][0];    
        
        $data['address']    = array(
                              'street'  => $address,
                              'city'    => $order_meta['_billing_city'][0],
                              'zip'     => $order_meta['_billing_postcode'][0],
                              'country' => $country
                            );

        if ( $order->get_formatted_billing_address() != $order->get_formatted_shipping_address() ){
            $shipping_address = $this->get_shipping_address( $order_meta );
            if( $shipping_address != false ){                    
                $data['shipping_address'] = $shipping_address;              
            }
        }

       $update_user = $this->fapi->client->update($check_user['id'], $data);
  
    }         


    /**
     * Get ic
     *
     */           
    private function get_ic( $meta ){
        $field = '_billing_ic';
        $meta_name = apply_filters( 'fapi_ic_custom_field', $field );

        if(!empty($order_meta[$meta_name][0])){ 
            return $order_meta[$meta_name][0];
        }else{
            return false;
        }

    }

    /**
     * Get dic
     *
     */           
    private function get_dic( $meta ){
        $field = '_billing_dic';
        $meta_name = apply_filters( 'fapi_dic_custom_field', $field );

        if(!empty($order_meta[$meta_name][0])){ 
            return $order_meta[$meta_name][0];
        }else{
            return false;
        }

    }

        

    /**
     * Save notify
     *
     */           
    private function save_notify( $info, $text ){
  
        $file = FAPIDIR.'notify_log.txt';
        $current = file_get_contents($file);
        $current .= date('D, d M Y H:i:s').$info.PHP_EOL;
        $current .= $text.PHP_EOL;
        file_put_contents($file, $current);
  
    }


}

