<?php
/**
 * File Upload field
 */
class Product_Addon_Field_File_Upload extends Product_Addon_Field {


	/**
	 * Validate an addon
	 * @return bool pass, or WP_Error
	 */
	public function validate() {
		if ( ! empty( $this->addon['required'] ) ) {
			foreach ( $this->addon['options'] as $option ) {
				$field_name = $this->get_field_name() . '-' . sanitize_title( $option['label'] );

				if ( empty( $_FILES[ $field_name ] ) || empty( $_FILES[ $field_name ]['name'] ) ) {
					return new WP_Error( 'error', sprintf( __( '"%s" is a required field.', 'woocommerce-product-addons' ), $this->addon['name'] ) );
				}
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
        $fotky = $_POST["fotky"];
/*        $nazev_slozky = $_POST["nazev_s"];
        $nazev_fotky = $_POST["nazev_s"];
        $typ_souboru = $_POST["typ_s"];*/
		foreach ( $this->addon['options'] as $option ) {

            $fotka_kousek_url = array();

            foreach ($fotky as $i => $fotka) {
                $fotka_kousek_url[$i] = explode("---", $fotka);
                $fotka_plus_id_objednavky[$i] = $fotka_kousek_url[$i][1];
                $fotky_nazev[$i] = substr($fotka_kousek_url[$i][1],20,strlen($fotka_kousek_url[$i][1]));
              
            }
            
           
            /*
            foreach($jmeno_rozbite as $key => $jmeno_rozbite_jeden){
                
                $field_name[$key]= "/home/web/skakaciatrakce.cz/www/obsah/themes/tiskfotek/nahrani/server/php/files/";
                
               
                $field_name[$key] = $field_name[$key] + "/" + $jmeno_jeden[$key][1];
            
                $k++;
                 
            }
            
            */
                
			if (! empty( $fotky_nazev )) {
                $upload = array();
                
                
                foreach ($fotky_nazev as $i => $fotka_nazev)
                    $upload = $this->handle_upload($fotka_nazev);
                
            //    foreach($fotky as $i => $fotka) // přidané
				if ( empty( $upload['error'] ) && ! empty( $upload ) ) {
                    
					$value  = $upload;
                 
                    
                    
                 
                    $format = $_POST["addon-3032-format"];
                    $fotopapir = $_POST["addon-3032-vyber-fotopapiru"];
                    $material = $_POST["addon-3032-material"];
                    $velikost_fotoobrazu = $_POST["addon-3032-velikost-fotoobrazu"];
                    $deska = $_POST["addon-3032-nalepit-na-desku"];
                    $typ = $_POST["addon-3032-typ"];
                    $pocet = $_POST["quantity"];
                    
                    
                    
    //$pojmenovani = $format.$fotopapir.$material.$velikost_fotoobrazu.$deska.$typ.$pocet."ks__FOTKA-".$_POST["cislo_f"].".".$_POST["typ_s"];
                
                $format_kousek = explode("-", $format);
                $deska_kousek = explode("-", $deska);
                $fotoobraz_kousek = explode("-", $velikost_fotoobrazu);
                
                $deska_bez_cisla = $deska_kousek[0]."-".$deska_kousek[1]."-".$deska_kousek[2];
                $fotoobraz_bez_cisla = $fotoobraz_kousek[0]."-".$fotoobraz_kousek[1]."-".$fotoobraz_kousek[2]."-".$fotoobraz_kousek[3]."-".$fotoobraz_kousek[4]."-".$fotoobraz_kousek[5]."-".$fotoobraz_kousek[6];
                    
if($format_kousek[0] == "fotoobraz")
    $pojmenovani = $format_kousek[0]."__".$pocet."ks__".$fotoobraz_bez_cisla."__FOTKA-".$_POST["cislo_f"].".".$_POST["typ_s"];
else
    $pojmenovani = $format_kousek[0]."__".$pocet."ks__".$deska_bez_cisla."__FOTKA-".$_POST["cislo_f"].".".$_POST["typ_s"];              
                    
                    
                    $cele_url_fotky = "http://objednavky.skakaciatrakce.cz/".$_POST["nazev_s"]."/$pojmenovani";
                    
                    rename("/home/web/skakaciatrakce.cz/objednavky/".$_POST["nazev_s"]."/".$_POST["nazev_f"], "/home/web/skakaciatrakce.cz/objednavky/".$_POST["nazev_s"]."/$pojmenovani");
                    
					$cart_item_data[] = array( //přidané i
						'name' 		=> "Fotky",
						'value'		=> $cele_url_fotky,
						'display'	=> "<img src='$cele_url_fotky' height='80px;'>",
						'price' 	=> $this->get_option_price( $option )
					);
				} else {
		    		return new WP_Error( 'addon-error', $upload['error'] );
		    	}
			} elseif ( isset( $this->value[ sanitize_title( $option['label'] ) ] ) ) {
				$cart_item_data[] = array(
					'name' 		=> $this->get_option_label( $option ),
					'value'		=> $this->value[ sanitize_title( $option['label'] ) ],
					'display'	=> basename( $this->value[ sanitize_title( $option['label'] ) ] ),
					'price' 	=> $this->get_option_price( $option )
				);
			}
		}

		return $cart_item_data;
	}

    
    public function handle_upload( $file ) {
        global $woocommerce, $muj_post;
        
		include_once( ABSPATH . 'wp-admin/includes/file.php' );
		include_once( ABSPATH . 'wp-admin/includes/media.php' );

		//add_filter( 'upload_dir',  array( $this, 'upload_dir' ) );

    $sablona = get_template_directory();
    $obsah_pole = wp_upload_dir();
    $obsah = $obsah["basedir"];
        
        
        $id_zak = get_current_user_id();
        
        mkdir("/home/web/skakaciatrakce.cz/objednavky/$id_objednavky", 0777);
        
        if (!file_exists('/home/web/skakaciatrakce.cz/www/obsah/uploads/product_addons_uploads/'.$id_zak))  
            mkdir("/home/web/skakaciatrakce.cz/www/obsah/uploads/product_addons_uploads/$id_zak", 0777);
        
        $co = "http://www.skakaciatrakce.cz/obsah/themes/tiskfotek/nahrani/server/php/files|$file";
    //    $co = "/home/web/skakaciatrakce.cz/www/obsah/themes/tiskfotek/nahrani/server/php/files|/$file";
        $kam = "/home/web/skakaciatrakce.cz/www/obsah/uploads/product_addons_uploads/$id_zak/$file";
        
        
        $upload = copy($co,$kam);
	
        //	remove_filter( 'upload_dir',  array( $this, 'upload_dir' ) );
        
        unlink("/home/web/skakaciatrakce.cz/www/obsah/themes/tiskfotek/nahrani/server/php/files|/$file");
    //    unlink("/home/web/skakaciatrakce.cz/www/obsah/themes/tiskfotek/nahrani/server/php/files|/thumbnail/$file");        
        
		return $upload;
	}
    /*
    public function get_cart_item_data() {
		$cart_item_data           = array();
		
		foreach ( $this->addon['options'] as $option ) {

			$field_name = $this->get_field_name() . '-' . sanitize_title( $option['label'] );
                
			if ( ! empty( $_FILES[ $field_name ] ) && ! empty( $_FILES[ $field_name ]['name'] ) ) {
                
				//$upload = $this->handle_upload( $_FILES[ $field_name ] );
                echo $_POST[ $field_name ] );
                $upload = $this->handle_upload( $_POST[ $field_name ] );
				if ( empty( $upload['error'] ) && ! empty( $upload['file'] ) ) {
					$value  = woocommerce_clean( $upload['url'] );

					$cart_item_data[] = array(
						'name' 		=> $this->get_option_label( $option ),
						'value'		=> $value,
						'display'	=> basename( $value ),
						'price' 	=> $this->get_option_price( $option )
					);
				} else {
		    		return new WP_Error( 'addon-error', $upload['error'] );
		    	}
			} elseif ( isset( $this->value[ sanitize_title( $option['label'] ) ] ) ) {
				$cart_item_data[] = array(
					'name' 		=> $this->get_option_label( $option ),
					'value'		=> $this->value[ sanitize_title( $option['label'] ) ],
					'display'	=> basename( $this->value[ sanitize_title( $option['label'] ) ] ),
					'price' 	=> $this->get_option_price( $option )
				);
			}
		}

		return $cart_item_data;
	}
    
    */

    
    
	/**
	 * Handle file upload
	 * @param  string $file
	 * @return array
	 */
    
    
    /*
    
    
	public function handle_upload( $file ) {
		include_once( ABSPATH . 'wp-admin/includes/file.php' );
		include_once( ABSPATH . 'wp-admin/includes/media.php' );

		add_filter( 'upload_dir',  array( $this, 'upload_dir' ) );

		$upload = wp_handle_upload( $file, array( 'test_form' => false ) );

		remove_filter( 'upload_dir',  array( $this, 'upload_dir' ) );

		return $upload;
	}

*/
	/**
	 * upload_dir function.
	 *
	 * @access public
	 * @param mixed $pathdata
	 * @return void
	 */
	public function upload_dir( $pathdata ) {
		global $woocommerce;

		if ( empty( $pathdata['subdir'] ) ) {
			$pathdata['path']   = $pathdata['path'] . '/product_addons_uploads/' . md5( $woocommerce->session->get_customer_id() );
			$pathdata['url']    = $pathdata['url']. '/product_addons_uploads/' . md5( $woocommerce->session->get_customer_id() );
			$pathdata['subdir'] = '/product_addons_uploads/' . md5( $woocommerce->session->get_customer_id() );
		} else {
			$subdir             = '/product_addons_uploads/' . md5( $woocommerce->session->get_customer_id() );
			$pathdata['path']   = str_replace( $pathdata['subdir'], $subdir, $pathdata['path'] );
			$pathdata['url']    = str_replace( $pathdata['subdir'], $subdir, $pathdata['url'] );
			$pathdata['subdir'] = str_replace( $pathdata['subdir'], $subdir, $pathdata['subdir'] );
		}
		
		return apply_filters( 'woocommerce_product_addons_upload_dir', $pathdata );
	}	
}
