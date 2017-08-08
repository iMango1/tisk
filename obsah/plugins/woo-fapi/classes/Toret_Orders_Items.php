<?php
/**
 * @package   Woo Fapi
 * @author    Vladislav Musílek
 * @license   GPL-2.0+
 * @link      Toret.cz
 * @copyright 2016 Toret.cz
 */

class Toret_Order_Items {
    
    public $order = null;

    /**
     * Construct
     *
     */        
    public function __construct( $order_id ) {
  
        $this->order = new WC_Order( $order_id );
  
    }

    
    /**
     * Get all products from order into array
     *
     *
     */
    public function get_invoice_lines(){

        $lines = array();

        $products = $this->get_products();
        if( !empty( $products ) ){ $lines = array_merge( $lines, $products ); }

        $shipping = $this->get_shipping();
        if( !empty( $shipping ) ){ $lines = array_merge( $lines, $shipping ); }

        $fees     = $this->get_fees();
        if( !empty( $fees ) ){ $lines = array_merge( $lines, $fees ); }

        $discount = $this->get_discount();
        if( !empty( $discount ) ){ $lines = array_merge( $lines, $discount ); }

        return $lines;

    }
    /**
     * Get all products from order into array
     *
     *
     */
    private function get_products(){

        //Get product lines
        $order_items = $this->order->get_items();
        $items = array();
        
        foreach($order_items as $data){
      
           
            $_tax = new WC_Tax();
            $_product = get_product( $data['variation_id'] ? $data['variation_id'] : $data['product_id'] );
            $rates = array_shift( $_tax->get_rates( $_product->get_tax_class() ) );
            $product_dph = round( array_shift( $rates ) );

            $item = array(
                  'price' => $this->order->get_item_subtotal( $data, true, true ),
                  'name'  => $this->item_name( $data ),
                  'code'  => $data['product_id'],
                  'count' => $data['qty'],
                  'vat'   => $product_dph,
                  'including_vat' => true,
            );

            if ( isset( $data['variation_id'] ) &&  $data['variation_id'] > 0 )
                $product_id = $data['variation_id'];
            else
                $product_id = $data['product_id'];

            $product = wc_get_product( $product_id );
            $virtual = $product->is_virtual();                      
            if( $virtual ){
                $item['electronically_supplied_service'] = true;
            }else{
                $item['electronically_supplied_service'] = false;
            }   

            $items[] = $item;

        }

        return $items;
    }

    /**
     * Get order shipping
     *
     *
     */
    private function get_shipping(){

        $items = array();
        $shipping_tax = 0;
        
        if( (int)$this->order->order_shipping > 0 ){
        
            $shipping_tax = round( ( $this->order->get_shipping_tax() / $this->order->order_shipping ) * 100 );
        
            $shipping_price = $this->order->get_total_shipping() + $this->order->get_shipping_tax();

            if ( $shipping_price > 0 ){
            
                $items[] = array(
                    'price' => round( $shipping_price, $this->get_decimal() ),
                    'name'  => $this->order->get_shipping_method(),
                    'code'  => 'doprava',
                    'count' => 1,
                    'vat'   => (int)$shipping_tax,
                    'electronically_supplied_service' => false,
                    'including_vat' => true,
                );
            }

        }

        return $items;

     
    }  


    /**
     * Get order fees
     *
     *
     */
    private function get_fees(){

        $items = array();

        if ( $this->order->get_fees() ){
            
            foreach ( $this->order->get_fees() as $fee ){
                
                $items[] = array(
                        'name'  => $fee['name'],
                        'code'  => 'fee',
                        'count' => 1,
                        'price' => $fee['line_total'] + $fee['line_tax'],
                        'vat'   => (int)round( ( $fee['line_tax'] / $fee['line_total'] ) * 100 ),
                        'electronically_supplied_service' => false,
                        'including_vat' => true,
                );
            }
        }

        return $items;

    }
    

    /**
     * Get order discount
     *
     *
     */
    private function get_discount(){

        $items = array();

         if ( $this->order->get_total_discount() ){

            $tax_diff = $this->order->get_total_discount( false ) - $this->order->get_total_discount();            

            $items[] = array(
                        'name'  => __('Sleva', 'woo-fapi' ),
                        'code'  => 'fee',
                        'count' => 1,
                        'price' => ( $this->order->get_total_discount( false ) ) * -1,
                        'vat'   => (int)round( ( $tax_diff / $this->order->get_total_discount() ) * 100 ),
                        'electronically_supplied_service' => false,
                        'including_vat' => true,
                );

        }

        return $items;

    }        

    /**
     * Get item name
     *
     */
    private function item_name( $data ){        

        if( !empty( $data['item_meta']['_variation_id'][0] ) ){
            $var = new WC_Product_Variation( $data['item_meta']['_variation_id'][0] );
            return $var->get_title().' '.$var->get_formatted_variation_attributes( true );
        }else{
            return $data['name'];
        }
    }

    /**
     *  Get decimal for CZK 
     *  Not use WooCommerce settings - some plugins manipulating with them
     *
     */
    private function get_decimal(){

        $currency = $this->order->get_order_currency();
        if( $currency != 'CZK' ){  
            return 2;
        }else{
            return 0;
        }

    }


}

