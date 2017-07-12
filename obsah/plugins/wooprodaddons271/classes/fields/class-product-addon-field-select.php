<?php
/**
 * Select field
 */
class Product_Addon_Field_Select extends Product_Addon_Field {

	/**
	 * Validate an addon
	 * @return bool pass or fail, or WP_Error
	 */
	public function validate() {
		if ( ! empty( $this->addon['required'] ) ) {
			if ( ! $this->value || sizeof( $this->value ) == 0 ) {
				return new WP_Error( 'error', sprintf( __( '"%s" is a required field.', 'woocommerce-product-addons' ), $this->addon['name'] ) );
			}
		}
		return true;
	}

	/**
	 * Process this field after being posted
	 * @return array on success, WP_ERROR on failure
	 */
	public function get_cart_item_data() {
		$cart_item_data = array();

		if ( empty( $this->value ) ) {
			return false;
		}
        
        global $wpdb;
        
        $results = $wpdb->get_results( 'SELECT * FROM tskf_postmeta WHERE meta_key like "ceny_produktu"', OBJECT );

        $vlastni_cena = unserialize($results[0]->meta_value);

		$chosen_option = '';
		$loop          = 0;

		foreach ( $this->addon['options'] as $option ) {
			$loop++;
			if ( sanitize_title( $option['label'] . '-' . $loop ) == $this->value ) {
                if($this->value == sanitize_title("MAT – Enhanced Mate". '-' . $loop) ){                    
                    $cena = $this->addon["cena_fotopapir"];
                    $vlc = 1;
                    $chosen_option = $option;
                }
                else if($this->value == sanitize_title("MAT – Matte Real". '-' . $loop) ){
                    $cena = $this->addon["cena_fotopapir"];
                    $vlc = 1;
                    $chosen_option = $option;
                }
                else if($this->value == sanitize_title("MAT – Velvet Fine Art". '-' . $loop) ){
                    $cena = $this->addon["cena_fotopapir"];
                    $vlc = 1;
                    $chosen_option = $option;
                }
                else if($this->value == sanitize_title("LESK – Glacier". '-' . $loop) ){
                    $cena = $this->addon["cena_fotopapir"];
                    $vlc = 1;
                    $chosen_option = $option;
                }
                else if($this->value == sanitize_title("LESK – Omnijet". '-' . $loop) ){
                    $cena = $this->addon["cena_fotopapir"];
                    $vlc = 1;
                    $chosen_option = $option;
                }
                else if($this->value == sanitize_title("LESK – Photo Baryt". '-' . $loop) ){
                    $cena = $this->addon["cena_fotopapir"];
                    $vlc = 1;
                    $chosen_option = $option;
                }
                else if($this->value == sanitize_title("LESK – Premium Glossy". '-' . $loop) ){
                    $cena = $this->addon["cena_fotopapir"];
                    $vlc = 1;
                    $chosen_option = $option;
                }
                else if($this->value == sanitize_title("LESK – Premium Luster". '-' . $loop) ){
                    $cena = $this->addon["cena_fotopapir"];
                    $vlc = 1;
                    $chosen_option = $option;
                }
                else if($this->value == sanitize_title("LESK – Smooth Gloss". '-' . $loop) ){
                    $cena = $this->addon["cena_fotopapir"];
                    $vlc = 1;
                    $chosen_option = $option;
                }
                else if($this->value == sanitize_title("POUZE PLÁTNO – LESK Satin canvas". '-' . $loop) ){
                    $cena = $this->addon["cena_fotopapir"];
                    $vlc = 1;
                    $chosen_option = $option;
                }
                else if($this->value == sanitize_title("POUZE PLÁTNO – MAT Exclusive – bez rámu". '-' . $loop) ){
                    $cena = $this->addon["cena_fotopapir"];
                    $vlc = 1;
                    $chosen_option = $option;
                }
                //DESKY
                else if($this->value == sanitize_title("Deska Rayboard 5mm". '-' . $loop) ){
                    $cena = $this->addon["cena_deska"];
                    $vlc = 1;
                    $chosen_option = $option;
                }
                else if($this->value == sanitize_title("Deska Rayboard 10mm". '-' . $loop) ){
                    $cena = $this->addon["cena_deska"];
                    $vlc = 1;
                    $chosen_option = $option;
                }
                else if($this->value == sanitize_title("Žádná deska". '-' . $loop) ){
                    $cena = $this->addon["cena_deska"];
                    $vlc = 1;
                    $chosen_option = $option;
                }
                else{
				    $chosen_option = $option;
                    $vlc = 0;
                }
				break;
			}
		}

		if ( ! $chosen_option ) {
			return false;
		}

        if($vlc == 0){
		  $cart_item_data[] = array(
		  	'name'  => $this->addon['name'],
		  	'value' => $chosen_option['label'],
		  	'price' => $this->get_option_price( $chosen_option )
		  );
        }
        else{
           $cart_item_data[] = array(
		  	'name'  => $this->addon['name'],
		  	'value' => $chosen_option['label'],
		  	'price' => $cena
		  );             
        }
        
		return $cart_item_data;
	}
}