<?php
global $vsechny_nahrane_fotky;
$array = array(
    "foo" => "bar",
    "bar" => "foo",
);

/**
 *
 * IT-RAYS Framework
 *
 * @author IT-RAYS
 * @license Commercial License
 * @link http://www.it-rays.com
 * @copyright 2014 IT-RAYS Themes
 * @package IT-RAYS-Framework
 * @version 1.0.0
 *
 */	
locate_template( 'it-framework/init.php', true );		
add_action( 'init', 'my_setcookie' );
function my_setcookie() {
    global $vsechny_nahrane_fotky;

    // setcookie( 'nahrane-fotky', serialize($vsechny_nahrane_fotky) , time() + 3600 * 8, COOKIEPATH, COOKIE_DOMAIN );
}
add_action( 'wp_login_failed', 'my_front_end_login_fail' );  // hook failed login


/*---------------------------------------------------
add settings page to menu
----------------------------------------------------*/
function add_ceny_parametru() {
//add_menu_page( __( 'Nastavení cen' .'' ), __( 'Nastavení cen' .' ' ), 'manage_options', 'settings', 'page_ceny_parametru');
    add_menu_page( 'Nastavení cen', 'Nastavení cen', 'manage_options', 'ceny_main', 'page_ceny', '
dashicons-feedback');
    add_submenu_page( 'ceny_main', 'Velké formáty', 'Velké formáty', 'manage_options','velke_formaty','page_ceny_velke_formaty' );
    add_submenu_page( 'ceny_main', 'Fixní ceny', 'Fixní ceny', 'manage_options','fotografie','page_ceny_fotografie' );
}

/*---------------------------------------------------
add actions
----------------------------------------------------*/
add_action( 'admin_menu', 'add_ceny_parametru' );
/*---------------------------------------------------
Theme Panel Output
----------------------------------------------------*/
function page_ceny(){
    ?>
    <style>
        label{
            width: 160px;
            display: block;
            float: left;
        }
    </style>
     <div class="wrap">
        <h2><?php _e( ' Nastavení cen parametrů' ) ?></h2>
        <a class="button button-primary" href="admin.php?page=velke_formaty">Velké formáty</a>
        <a class="button button-primary" href="admin.php?page=fotografie">Fixní ceny</a>
     </div>
     <?php
}

function page_ceny_velke_formaty() {
    global $wpdb;
    $results = $wpdb->get_results( 'SELECT * FROM tskf_postmeta WHERE meta_key like "ceny_produktu"', OBJECT );

    $ceny_parametry = unserialize($results[0]->meta_value);
    ?>
    <style>
        label{
            width: 160px;
            display: block;
            float: left;
        }
        .pridat{
            width: 30px;
            height: 30px;
            background-color: rgba(153, 114, 181, 1.0);
            color: #fff;
            text-align: center;
            line-height: 30px;
            cursor: pointer;
        }
    </style>
     <div class="wrap">
        <form method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
        <h2><?php _e( ' Nastavení cen parametrů' ) ?></h2>
        <a class="button button-primary" href="admin.php?page=ceny_main">Zpět na stránku všech parametrů bez uložení</a>
        <?php
        if(isset($_POST["submit"])){
            echo "<pre>",print_r($_POST),"</pre>";
        /*    $wpdb->update( 
	           'tskf_postmeta', 
	           array('meta_value' => serialize($_POST["cena"])), 
               array( 'meta_key' => "ceny_produktu" ), 
	           array('%s') );
            header("Location: admin.php?page=velke_formaty"); */
        }
        $poc = 0; 
        foreach($ceny_parametry as $k => $ceny_parametr){
            $kolo = 0;
            $poc++;
        ?>
             
            <div class="notice blok_parametr <?php echo $poc; ?>" style="padding: 10px">
                <h3 style="margin-bottom: 5px"><?php echo $k; ?></h3>
                <hr>
                <ul>
                <?php foreach($ceny_parametr as $i => $cena){ $kolo++; ?>
                    <li class="roz_<?php echo $kolo; ?>">
                        <label for="cena[<?php echo $k; ?>][<?php echo $i; ?>]">Od obsahu <strong><?php echo $i;?> cm<sup>2</sup></strong> </label>
                        <input maxlength="45" size="15" name="cena[<?php echo $k; ?>][<?php echo $i; ?>]" value="<?php echo $cena; ?>" /><em> Cena za cm<sup>2</sup></em>
                    </li>                    
                    
                <?php }?>
                </ul>
                <div class="pridat <?php echo $poc; ?>">
                    +
                </div>
            </div>

                <script>
            jQuery(document).ready(function(){
                
                var kolo = <?php echo $kolo; ?>;
                
                jQuery(".blok_parametr.<?php echo $poc; ?> .pridat.<?php echo $poc; ?>").click(function(){
                    
                    kolo++;
                    
                    jQuery(".blok_parametr.<?php echo $poc; ?> ul").append('<li class="roz_'+kolo+'><label style="width:300px;">Od obsahu <strong><input type="text" class="rozmer" name="dsad" maxlength="45" size="15"/> cm<sup>2</sup></strong> </label><input maxlength="45" size="15" name="cena[<?php echo $k; ?>][]"/><em> Cena za cm<sup>2</sup></em></li>'); 
                });
                jQuery(".blok_parametr.<?php echo $poc; ?> .roz_<?php echo $kolo+1; ?> .rozmer").keyup(function() {
                    var value = jQuery( this ).val();
                    //$( "p" ).text( value );
                    console.log(value);
                }).keyup();
            
                jQuery(".blok_parametr.<?php echo $poc; ?> .roz_"+kolo+" .rozmer").change(function(){
                    alert("kk");
                });
            });
            </script>
        <?php } 
         submit_button();
         ?>
         </form>
     </div>
     
     
     <?php
}

function page_ceny_fotografie() {
    global $wpdb;
    $v = $wpdb->get_results( 'SELECT * FROM tskf_postmeta WHERE meta_id = 7130', OBJECT );
//_product_addons
    $c_par = unserialize($v[0]->meta_value);
    ?>
    <style>
        label{
            width: 300px;
            display: block;
            float: left;
        }
    </style>
     <div class="wrap">
        <form method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
        <h2><?php _e( ' Nastavení fixních cen' ) ?></h2>
            <a class="button button-primary" href="admin.php?page=ceny_main">Zpět na stránku všech parametrů bez uložení</a>
            
            
        <?php
        if(isset($_POST["submit"])){
            $wpdb->update( 
	           'tskf_postmeta', 
	           array('meta_value' => serialize($_POST["cena"])), 
               array( 'meta_id' => 7130 ), 
	           array('%s'),
	           array( '%d' ) );
            header("Location: admin.php?page=fotografie"); 
            
           // $upravene_ceny = postNaPluginPole($_POST["cena"]);
             //$upravene_ceny = $_POST["cena"];
            
            //echo "<pre>",print_r($upravene_ceny),"</pre>";
        }
    
        ?>
            <?php foreach($c_par as $cislo_celeho_parametru => $cely_parametr){ ?>
            <?php if( ($cely_parametr["name"] != "Náhled") && ($cely_parametr["name"] != "Vlastní formát") &&
                    ($cely_parametr["name"] != "Výběr fotopapíru") && ($cely_parametr["name"] != "Materiál pro velké formáty") &&
                     ($cely_parametr["name"] != "id_objednavky")
                    ){ ?>
            <div class="notice blok_parametr <?php echo $cislo_celeho_parametru; ?>" style="padding: 10px">
                <h3 style="margin-bottom: 5px"><?php echo $cely_parametr["name"]; ?></h3>
                <hr>
                <ul>
                    <?php foreach($cely_parametr["options"] as $cislo_parametru => $parametr_rozmery){ ?> 
                            <?php if( $parametr_rozmery["label"] == "Fotografie" ||
                                    $parametr_rozmery["label"] == "Obraz na plátně" ||
                                    $parametr_rozmery["label"] == "Velké formáty" ||
                                    $parametr_rozmery["label"] == "Fotoobraz" ||
                                    $parametr_rozmery["label"] == "Ostatní" ||
                                    $parametr_rozmery["label"] == "Vlastní rozměry" ||
                                    $parametr_rozmery["label"] == "Žádná deska"){ ?>
                                    
<input type="hidden" name="cena[<?php echo $cislo_celeho_parametru; ?>][name]" value="<?php echo $cely_parametr["name"];?>" />
<input type="hidden" name="cena[<?php echo $cislo_celeho_parametru; ?>][description]" value="<?php echo $cely_parametr["description"];?>" />
<input type="hidden" name="cena[<?php echo $cislo_celeho_parametru; ?>][type]" value="<?php echo $cely_parametr["type"];?>" />
<input type="hidden" name="cena[<?php echo $cislo_celeho_parametru; ?>][position]" value="<?php echo $cely_parametr["position"];?>" /> 

                                  
<input type="hidden" name="cena[<?php echo $cislo_celeho_parametru; ?>][options][<?php echo $cislo_parametru; ?>][label]" value="<?php echo $parametr_rozmery["label"]; ?>" />                        
<input type="hidden" maxlength="30" size="10" name="cena[<?php echo $cislo_celeho_parametru; ?>][options][<?php echo $cislo_parametru; ?>][price]" value="<?php echo $parametr_rozmery["price"]; ?>" />
<input type="hidden" name="cena[<?php echo $cislo_celeho_parametru; ?>][options][<?php echo $cislo_parametru; ?>][min]" value="" />
<input type="hidden" name="cena[<?php echo $cislo_celeho_parametru; ?>][options][<?php echo $cislo_parametru; ?>][max]" value="" /> 
    
               <?php }
                    else{  ?>
    
                     <li>
<input type="hidden" name="cena[<?php echo $cislo_celeho_parametru; ?>][name]" value="<?php echo $cely_parametr["name"];?>" />
<input type="hidden" name="cena[<?php echo $cislo_celeho_parametru; ?>][description]" value="<?php echo $cely_parametr["description"];?>" />
<input type="hidden" name="cena[<?php echo $cislo_celeho_parametru; ?>][type]" value="<?php echo $cely_parametr["type"];?>" />
<input type="hidden" name="cena[<?php echo $cislo_celeho_parametru; ?>][position]" value="<?php echo $cely_parametr["position"];?>" /> 
                      
                       <label for=""><strong><?php echo $parametr_rozmery["label"]; ?></strong></label>
<input type="hidden" name="cena[<?php echo $cislo_celeho_parametru; ?>][options][<?php echo $cislo_parametru; ?>][label]" value="<?php echo $parametr_rozmery["label"]; ?>" />    
                                           
                        
                        
                        <input maxlength="30" size="10" name="cena[<?php echo $cislo_celeho_parametru; ?>][options][<?php echo $cislo_parametru; ?>][price]" value="<?php echo $parametr_rozmery["price"]; ?>" /><em> Kč</em>
                        
                        
<input type="hidden" name="cena[<?php echo $cislo_celeho_parametru; ?>][options][<?php echo $cislo_parametru; ?>][min]" value="" />
<input type="hidden" name="cena[<?php echo $cislo_celeho_parametru; ?>][options][<?php echo $cislo_parametru; ?>][max]" value="" />

<input type="hidden" name="cena[<?php echo $cislo_celeho_parametru; ?>][required]" value="<?php echo $cely_parametr["required"];?>" />
                    </li>
                    <?php } } ?>
                </ul>
            </div>
                
            <?php 
//KONEC IFU
//ZKRYTÉ VAJCA
}else{
        foreach($cely_parametr["options"] as $cislo_parametru => $parametr_rozmery){ 
    ?>
    
                                       
<input type="hidden" name="cena[<?php echo $cislo_celeho_parametru; ?>][name]" value="<?php echo $cely_parametr["name"];?>" />
<input type="hidden" name="cena[<?php echo $cislo_celeho_parametru; ?>][description]" value="<?php echo $cely_parametr["description"];?>" />
<input type="hidden" name="cena[<?php echo $cislo_celeho_parametru; ?>][type]" value="<?php echo $cely_parametr["type"];?>" />
<input type="hidden" name="cena[<?php echo $cislo_celeho_parametru; ?>][position]" value="<?php echo $cely_parametr["position"];?>" /> 

                                  
<input type="hidden" name="cena[<?php echo $cislo_celeho_parametru; ?>][options][<?php echo $cislo_parametru; ?>][label]" value="<?php echo $parametr_rozmery["label"]; ?>" />                        
<input type="hidden" maxlength="30" size="10" name="cena[<?php echo $cislo_celeho_parametru; ?>][options][<?php echo $cislo_parametru; ?>][price]" value="<?php echo $parametr_rozmery["price"]; ?>" />
<input type="hidden" name="cena[<?php echo $cislo_celeho_parametru; ?>][options][<?php echo $cislo_parametru; ?>][min]" value="" />
<input type="hidden" name="cena[<?php echo $cislo_celeho_parametru; ?>][options][<?php echo $cislo_parametru; ?>][max]" value="" /> 
    
    
<input type="hidden" name="cena[<?php echo $cislo_celeho_parametru; ?>][required]" value="<?php echo $cely_parametr["required"];?>" />    
    
    
    <?php
        }
}
                                                                               
                } ?>

            
    
        <?php
        submit_button();
        ?>
         <pre><?php print_r($c_par); ?></pre>
         </form>
     </div>
     <?php
}


function postNaPluginPole($post){
    
    //PŘIDÁNÍ NÁHLEDU
    
    array_unshift($post,"");
    $post[0]["name"] = "Náhled";
    $post[0]["description"] = "";
    $post[0]["type"] = "file_upload";
    $post[0]["position"] = 0;
    $post[0]["options"][0]["label"] = "Upozornění:";
    $post[0]["options"][0]["price"] = "";
    $post[0]["options"][0]["min"] = "";
    $post[0]["options"][0]["max"] = "";
    $post[0]["required"] = 0;
    
    
    
    return $post;
}



function my_front_end_login_fail( $username ) {
   $referrer = $_SERVER['HTTP_REFERER'];  // where did the post submission come from?
   // if there's a valid referrer, and it's not te default log-in screen
   if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {
      wp_redirect( $referrer . '?login=failed' );  // let's append some information (login=failed) to the URL for the theme to use
      exit;
   }
}
add_action( 'admin_head', 'admin_css' );

function admin_css(){ ?>
     <style>
        /* Preload images */
body:after {
  content: url(images/close.png) url(images/loading.gif) url(images/prev.png) url(images/next.png);
  display: none;
}

.lightboxOverlay {
  position: absolute;
  top: 0;
  left: 0;
  z-index: 9999;
  background-color: black;
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=80);
  opacity: 0.8;
  display: none;
}

.lightbox {
  position: absolute;
  left: 0;
  width: 100%;
  z-index: 10000000;
  text-align: center;
  line-height: 0;
  font-weight: normal;
}

.lightbox .lb-image {
  display: block;
  height: auto;
  max-width: inherit;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  -ms-border-radius: 3px;
  -o-border-radius: 3px;
  border-radius: 3px;
}

.lightbox a img {
  border: none;
}

.lb-outerContainer {
  position: relative;
  background-color: white;
  *zoom: 1;
  width: 250px;
  height: 250px;
  margin: 0 auto;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  -ms-border-radius: 4px;
  -o-border-radius: 4px;
  border-radius: 4px;
}

.lb-outerContainer:after {
  content: "";
  display: table;
  clear: both;
}

.lb-container {
  padding: 4px;
}

.lb-loader {
  position: absolute;
  top: 43%;
  left: 0;
  height: 25%;
  width: 100%;
  text-align: center;
  line-height: 0;
}

.lb-cancel {
  display: block;
  width: 32px;
  height: 32px;
  margin: 0 auto;
  background: url(images/loading.gif) no-repeat;
}

.lb-nav {
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  z-index: 10;
}

.lb-container > .nav {
  left: 0;
}

.lb-nav a {
  outline: none;
  background-image: url('data:image/gif;base64,R0lGODlhAQABAPAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==');
}

.lb-prev, .lb-next {
  height: 100%;
  cursor: pointer;
  display: block;
}

.lb-nav a.lb-prev {
  width: 34%;
  left: 0;
  float: left;
  background: url(images/prev.png) left 48% no-repeat;
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=0);
  opacity: 0;
  -webkit-transition: opacity 0.6s;
  -moz-transition: opacity 0.6s;
  -o-transition: opacity 0.6s;
  transition: opacity 0.6s;
}

.lb-nav a.lb-prev:hover {
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100);
  opacity: 1;
}

.lb-nav a.lb-next {
  width: 64%;
  right: 0;
  float: right;
  background: url(images/next.png) right 48% no-repeat;
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=0);
  opacity: 0;
  -webkit-transition: opacity 0.6s;
  -moz-transition: opacity 0.6s;
  -o-transition: opacity 0.6s;
  transition: opacity 0.6s;
}

.lb-nav a.lb-next:hover {
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100);
  opacity: 1;
}

.lb-dataContainer {
  margin: 0 auto;
  padding-top: 5px;
  *zoom: 1;
  width: 100%;
  -moz-border-radius-bottomleft: 4px;
  -webkit-border-bottom-left-radius: 4px;
  border-bottom-left-radius: 4px;
  -moz-border-radius-bottomright: 4px;
  -webkit-border-bottom-right-radius: 4px;
  border-bottom-right-radius: 4px;
}

.lb-dataContainer:after {
  content: "";
  display: table;
  clear: both;
}

.lb-data {
  padding: 0 4px;
  color: #ccc;
}

.lb-data .lb-details {
  width: 85%;
  float: left;
  text-align: left;
  line-height: 1.1em;
}

.lb-data .lb-caption {
  font-size: 13px;
  font-weight: bold;
  line-height: 1em;
}

.lb-data .lb-number {
  display: block;
  clear: left;
  padding-bottom: 1em;
  font-size: 12px;
  color: #999999;
}

.lb-data .lb-close {
  display: block;
  float: right;
  width: 30px;
  height: 30px;
  background: url(images/close.png) top right no-repeat;
  text-align: right;
  outline: none;
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=70);
  opacity: 0.7;
  -webkit-transition: opacity 0.2s;
  -moz-transition: opacity 0.2s;
  -o-transition: opacity 0.2s;
  transition: opacity 0.2s;
}

.lb-data .lb-close:hover {
  cursor: pointer;
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100);
  opacity: 1;
}

     </style>
<?php
}
//Deklarace IČ A DIČ
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
// Funkce pro deklaraci a přidaní IČ A DIČ do woocomerce 
function custom_override_checkout_fields( $fields ) {
     $fields['billing']['billing_ico'] = array(
    'label'     => __('IČ', 'woocommerce'),
    'placeholder'   => _x('IČ', 'placeholder', 'woocommerce'),
    'required'  => false,
    'class'     => array('form-row-wide'),
    'clear'     => true
     );
 
     $fields['billing']['billing_dic'] = array(
    'label'     => __('DIČ', 'woocommerce'),
    'placeholder'   => _x('DIČ', 'placeholder', 'woocommerce'),
    'required'  => false,
    'class'     => array('form-row-wide'),
    'clear'     => true
     );
    
    $fields['shipping']['shipping_ico'] = array(
    'label'     => __('IČ', 'woocommerce'),
    'placeholder'   => _x('IČ', 'placeholder', 'woocommerce'),
    'required'  => false,
    'class'     => array('form-row-wide'),
    'clear'     => true
     );
 
     $fields['shipping']['shipping_dic'] = array(
    'label'     => __('DIČ', 'woocommerce'),
    'placeholder'   => _x('DIČ', 'placeholder', 'woocommerce'),
    'required'  => false,
    'class'     => array('form-row-wide'),
    'clear'     => true
     );
        
     return $fields;
}
//Deklarace a funkce pro změny pořadí poloí v košíku, aby bylo ič a dič po názvu firmy. Nejdřív seřazení pro fakturu a pak pro případnou doručovací(jinou) adresu.
add_filter("woocommerce_checkout_fields", "order_fields");
function order_fields($fields) {

    $order = array(
        "billing_first_name", 
        "billing_last_name", 
        "billing_company",
        "billing_ico",
        "billing_dic",
        "billing_address_1", 
        "billing_address_2", 
        "billing_postcode", 
        "billing_country", 
        "billing_email", 
        "billing_phone"

    );
    foreach($order as $field)
    {
        $ordered_fields[$field] = $fields["billing"][$field];
    }

    $fields["billing"] = $ordered_fields;
/*   
    $order = array(
        "shipping_first_name", 
        "shipping_last_name", 
        "shipping_company",
        "shipping_ico",
        "shipping_dic",
        "shipping_address_1", 
        "shipping_address_2", 
        "shipping_postcode", 
        "shipping_country", 
        "shipping_email", 
        "shipping_phone"

    );
    foreach($order as $field)
    {
        $ordered_fields[$field] = $fields["shipping"][$field];
    }

    $fields["shipping"] = $ordered_fields; */
    return $fields;

}


/* REGISTRACE A LOGIN PŘEPSANÍ WP-MEMBERS PLUGINU */

/**
 * Login Dialog
 *
 * Loads the login form for user login
 *
 * @since 1.8
 *
 * @uses wpmem_login_form()
 *
 * @param  string $page
 * @param  string $redirect_to
 * @return string $str the generated html for the login form
 */
function wpmem_inc_login( $page="page", $redirect_to = null )
{ 	
	global $wpmem_regchk;

	$str = '';

	if( $page == "page" ){
	     if( $wpmem_regchk!="success" ){

			$arr = get_option( 'wpmembers_dialogs' );
			
			// this shown above blocked content
			$str = '<h4>Sell Sheets  |  Art Files  |  Order Forms</h4>';
			//$str .= '<p>' . __( stripslashes( $arr[0] ), 'wp-members' ) . '</p>';
			
			/**
			 * Filter the post restricted message.
			 *
			 * @since 2.7.3
			 *
			 * @param string $str The post restricted message.
		 	 */
			//$str = apply_filters( 'wpmem_restricted_msg', $str );

		} 	
	} 
	
	/** create the default inputs **/
	$default_inputs = array(
		array(
			'name'   => __( 'Username' ), 
			'type'   => 'text', 
			'tag'    => 'log',
			'class'  => 'form-control',
			'div'    => 'col-sm-8'
		),
		array( 
			'name'   => __( 'Password' ), 
			'type'   => 'password', 
			'tag'    => 'pwd', 
			'class'  => 'form-control',
			'div'    => 'col-sm-8',
		)
	);
	
	/**
	 * Filter the array of login form fields.
	 *
	 * @since 2.9.0
	 *
	 * @param array $default_inputs An array matching the elements used by default.
 	 */
	$default_inputs = apply_filters( 'wpmem_inc_login_inputs', $default_inputs );
	
    $defaults = array( 
		'heading'      => __( 'Stálí zákazníci', 'wp-members' ), 
		'action'       => 'login', 
		'button_text'  => __( 'Log In' ),
		'inputs'       => $default_inputs,
		'redirect_to'  => $redirect_to
	);	

	/**
	 * Filter the arguments to override login form defaults.
	 *
	 * @since 2.9.0
	 *
	 * @param array $args An array of arguments to use. Default null.
 	 */
	$args = apply_filters( 'wpmem_inc_login_args', '' );

	$arr  = wp_parse_args( $args, $defaults );

	$str .= "<div class=\"row\"><div class=\"col-sm-6 prihlaseni\">";
	$str  = $str . wpmem_login_form( $page, $arr );
	$str .= "</div>\n";
	$str .= "<div class=\"col-sm-6 registrace\">";
	$str .= "<h3>Nový zákazník</h3>\n";
	$str .= "<p>Jste zde poprvé a přejete si vytvořit zákaznický účte? Nabízí spousty výhod. Pro vytvoření účtu klikně na tlačítko \"Vytvořit účet\".</p>\n";

	$link = apply_filters( 'wpmem_reg_link', WPMEM_REGURL );
	/*$str  .= '<div style="text-align:center;"><a class="btn btn-primary contact-btn" href="' . $link . '">Vytvořit účet</a></div>'; */
	$str  .= '<div style="text-align:center;"><button class="btn btn-primary contact-btn registrace-tlacitko">Vytvořit účet</button></div>';
    
	$str .= "</div>\n"; 
	$str .= "</div>\n"; 
	return $str; 
}
/**
 * Login Form Dialog
 *
 * Builds the form used for login, change password, and reset password.
 *
 * @since 2.5.1
 *
 * @param  string $page 
 * @param  array  $arr   The elements needed to generate the form (login|reset password|forgotten password)
 * @return string $form  The HTML for the form as a string
 */
function wpmem_login_form( $page, $arr ) 
{
	// extract the arguments array
	extract( $arr );

	// set up default wrappers
	$defaults = array(
		
		// wrappers
		'heading_before'  => '<h3>',
		'heading_after'   => '</h3>',
		'fieldset_before' => '<div class="form-group">',
		'fieldset_after'  => '</div>',
		'main_div_before' => '<div id="wpmem_login">',
		'main_div_after'  => '</div>',
		'txt_before'      => '[wpmem_txt]',
		'txt_after'       => '[/wpmem_txt]',
		'row_before'      => '',
		'row_after'       => '',
		'buttons_before'  => '<div class="form-group"><div class="col-sm-offset-4 col-sm-8">',
		'buttons_after'   => '</div></div>',
		'link_before'     => '<div class="row"><div class="col-sm-offset-4 col-sm-9">',
		'link_after'      => '</div></div>',
		
		// classes & ids
		'form_id'         => '',
		'form_class'      => 'form-horizontal',
		'button_id'       => '',
		'button_class'    => 'btn btn-primary contact-btn',
		
		// other
		'strip_breaks'    => true,
		'wrap_inputs'     => true,
		'remember_check'  => true,
		'n'               => "\n",
		't'               => "\t",
		'redirect_to'     => ( isset( $_REQUEST['redirect_to'] ) ) ? esc_url( $_REQUEST['redirect_to'] ) : ( ( isset( $redirect_to ) ) ? $redirect_to : get_permalink() )
		
	);
	
	/**
	 * Filter the default form arguments.
	 *
	 * This filter accepts an array of various elements to replace the form defaults. This
	 * includes default tags, labels, text, and small items including various booleans.
	 *
	 * @since 2.9.0
	 *
	 * @param array          An array of arguments to merge with defaults. Default null.
	 * @param string $action The action being performed by the form. login|pwdreset|pwdchange.
 	 */
	$args = apply_filters( 'wpmem_login_form_args', '', $action );
	
	// merge $args with defaults and extract
	extract( wp_parse_args( $args, $defaults ) );
	
	// build the input rows
	foreach ( $inputs as $input ) {
		$label = '<label for="' . $input['tag'] . '" class="col-sm-4 control-label">' . $input['name'] . '</label>';
		$field = wpmem_create_formfield( $input['tag'], $input['type'], '', '', $input['class'], $input['name'] );
		$field_before = ( $wrap_inputs ) ? '<div class="' . $input['div'] . '">' : '';
		$field_after  = ( $wrap_inputs ) ? '</div>' : '';
		$rows[] = array( 
			'row_before'   => $row_before,
			'label'        => $label,
			'field_before' => $field_before,
			'field'        => $field,
			'field_after'  => $field_after,
			'row_after'    => $row_after
		);
	}
	
	/**
	 * Filter the array of form rows.
	 *
	 * This filter receives an array of the main rows in the form, each array element being
	 * an array of that particular row's pieces. This allows making changes to individual 
	 * parts of a row without needing to parse through a string of HTML.
	 *
	 * @since 2.9.0
	 *
	 * @param array  $rows   An array containing the form rows.
	 * @param string $action The action being performed by the form. login|pwdreset|pwdchange.
 	 */
	$rows = apply_filters( 'wpmem_login_form_rows', $rows, $action );
	
	// put the rows from the array into $form
	$form = '';
	foreach( $rows as $row_item ) {
		$row  = ( $row_item['row_before']   != '' ) ? $row_item['row_before'] . $n . $row_item['label'] . $n : $row_item['label'] . $n;
		$row .= ( $row_item['field_before'] != '' ) ? $row_item['field_before'] . $n . $t . $row_item['field'] . $n . $row_item['field_after'] . $n : $row_item['field'] . $n;
		$row .= ( $row_item['row_before']   != '' ) ? $row_item['row_after'] . $n : '';
		$form.= $row;
	}

	// build hidden fields, filter, and add to the form
	//$redirect_to = ( isset( $_REQUEST['redirect_to'] ) ) ? esc_url( $_REQUEST['redirect_to'] ) : get_permalink();
	$hidden = wpmem_create_formfield( 'redirect_to', 'hidden', $redirect_to ) . $n;
	$hidden = $hidden . wpmem_create_formfield( 'a', 'hidden', $action ) . $n;
	$hidden = ( $action != 'login' ) ? $hidden . wpmem_create_formfield( 'formsubmit', 'hidden', '1' ) : $hidden;

	/**
	 * Filter the hidden field HTML.
	 *
	 * @since 2.9.0
	 *
	 * @param string $hidden The generated HTML of hidden fields.
	 * @param string $action The action being performed by the form. login|pwdreset|pwdchange.
 	 */
	$form = $form . apply_filters( 'wpmem_login_hidden_fields', $hidden, $action );

	// build the buttons, filter, and add to the form
	if ( $action == 'login' ) {
		$remember_check = ( $remember_check ) ? $t . wpmem_create_formfield( 'rememberme', 'checkbox', 'forever' ) . '&nbsp;' . __( 'Remember Me' ) . '&nbsp;&nbsp;' . $n : '';
		$buttons =  $remember_check . $t . '<input type="submit" name="Submit" value="' . $button_text . '" class="' . $button_class . '" />' . $n;
	} else {
		$buttons = '<input type="submit" name="Submit" value="' . $button_text . '" class="' . $button_class . '" />' . $n;
	}
	
	/**
	 * Filter the HTML for form buttons.
	 *
	 * The string includes the buttons, as well as the before/after wrapper elements.
	 *
	 * @since 2.9.0
	 *
	 * @param string $buttons The generated HTML of the form buttons.
	 * @param string $action  The action being performed by the form. login|pwdreset|pwdchange.
 	 */
	$form = $form . apply_filters( 'wpmem_login_form_buttons', $buttons_before . $n . $buttons . $buttons_after . $n, $action );

	if ( ( WPMEM_MSURL != null || $page == 'members' ) && $action == 'login' ) { 
		
		/**
		 * Filter the forgot password link.
		 *
		 * @since 2.8.0
		 *
		 * @param string The forgot password link.
	 	 */
		$link = apply_filters( 'wpmem_forgot_link', wpmem_chk_qstr( WPMEM_MSURL ) . 'a=pwdreset' );	
		$str  = __( 'Forgot password?', 'wp-members' ) . '&nbsp;<a href="' . $link . '">' . __( 'Click here to reset', 'wp-members' ) . '</a>';
		$form = $form . $link_before . apply_filters( 'wpmem_forgot_link_str', $str ) . $link_after . $n;
		
	}
	
	if ( ( WPMEM_REGURL != null ) && $action == 'login' ) { 

		/**
		 * Filter the link to the registration page.
		 *
		 * @since 2.8.0
		 *
		 * @param string The registration page link.
	 	 */
	/*	 
		$link = apply_filters( 'wpmem_reg_link', WPMEM_REGURL );
		$str  = __( 'New User?', 'wp-members' ) . '&nbsp;<a href="' . $link . '">' . __( 'Click here to register', 'wp-members' ) . '</a>';
		$form = $form . $link_before . apply_filters( 'wpmem_reg_link_str', $str ) . $link_after . $n;
	*/
	}			
	
	// apply the heading
	$form = $heading_before . $heading . $heading_after . $n . $form;
	
	// apply fieldset wrapper
	$form = $fieldset_before . $n . $form . $fieldset_after . $n;
	
	// apply form wrapper
	$form = '<form action="' . get_permalink() . '" method="POST" id="' . $form_id . '" class="' . $form_class . '">' . $n . $form . '</form>';
	
	// apply anchor
	$form = '<a name="login"></a>' . $n . $form;
	
	// apply main wrapper
	$form = $main_div_before . $n . $form . $n . $main_div_after;
	
	// apply wpmem_txt wrapper
	$form = $txt_before . $form . $txt_after;
	
	// remove line breaks
	$form = ( $strip_breaks ) ? str_replace( array( "\n", "\r", "\t" ), array( '','','' ), $form ) : $form;
	
	/**
	 * Filter the generated HTML of the entire form.
	 *
	 * @since 2.7.4
	 *
	 * @param string $form   The HTML of the final generated form.
	 * @param string $action The action being performed by the form. login|pwdreset|pwdchange.
 	 */
	$form = apply_filters( 'wpmem_login_form', $form, $action );
	
	/**
	 * Filter before the form.
	 *
	 * This rarely used filter allows you to stick any string onto the front of
	 * the generated form.
	 *
	 * @since 2.7.4
	 *
	 * @param string $str    The HTML to add before the form. Default null.
	 * @param string $action The action being performed by the form. login|pwdreset|pwdchange.
 	 */
	$form = apply_filters( 'wpmem_login_form_before', '', $action ) . $form;
	
	return $form;
} // end wpmem_login_form
/**
 * Registration Form Dialog
 *
 * Outputs the form for new user registration and existing user edits.
 *
 * @since 2.5.1
 *
 * @param  string $toggle       (optional) Toggles between new registration ('new') and user profile edit ('edit')
 * @param  string $heading      (optional) The heading text for the form, null (default) for new registration
 * @global string $wpmem_regchk Used to determine if the form is in an error state
 * @global array  $userdata     Used to get the user's registration data if they are logged in (user profile edit)
 * @return string $form         The HTML for the entire form as a string
 */
function wpmem_inc_registration( $toggle = 'new', $heading = '' )
{	
	global $wpmem_regchk, $userdata; 
	
	// set up default wrappers
	$defaults = array(
		
		// wrappers
		'heading_before'  => '<h3>',
		'heading_after'   => '</h3>',
		'fieldset_before' => '',
		'fieldset_after'  => '',
		'main_div_before' => '<div id="wpmem_login formular-registrace">',
		'main_div_after'  => '</div>',
		'txt_before'      => '[wpmem_txt]',
		'txt_after'       => '[/wpmem_txt]',
		'row_before'      => '<div class="form-group col-sm-6">',
		'row_after'       => '</div>',
		'buttons_before'  => '<div class="form-group"><div style="float: right; padding-right: 15px;">',
		'buttons_after'   => '</div></div>',
		
		
		// classes & ids
		'form_id'         => '',
		'form_class'      => 'form-horizontal',
		'button_id'       => '',
		'button_class'    => 'btn btn-primary contact-btn',
		
		// required field tags and text
		'req_mark'         => '<span class="req">*</font>',
		'req_label'        => __( 'Required field', 'wp-members' ),
		'req_label_before' => '<div class="col-sm-12">',
		'req_label_after'  => '</div>',
		
		// buttons
		'show_clear_form'  => true,
		'clear_form'       => __( 'Reset Form', 'wp-members' ),
		'submit_register'  => __( 'Register' ),
		'submit_update'    => __( 'Update Profile', 'wp-members' ),
		
		// other
		'strip_breaks'     => true,
		'use_nonce'        => false,
		'wrap_inputs'      => true,
		'n'                => "\n",
		't'                => "\t",
		
	);
	
	/**
	 * Filter the default form arguments.
	 *
	 * This filter accepts an array of various elements to replace the form defaults. This
	 * includes default tags, labels, text, and small items including various booleans.
	 *
	 * @since 2.9.0
	 *
	 * @param array           An array of arguments to merge with defaults. Default null.
	 * @param string $toggle  Toggle new registration or profile update. new|edit.
 	 */
	$args = apply_filters( 'wpmem_register_form_args', '', $toggle );
	
	// merge $args with defaults and extract
	extract( wp_parse_args( $args, $defaults ) );
	
	// Username is editable if new reg, otherwise user profile is not
	if( $toggle == 'edit' ) {
		// this is the User Profile edit - username is not editable
		$val   = $userdata->user_login;
		$label = '<div class="row"><label for="username" class="col-sm-4 control-label">' . __( 'Username' ) . '</label>';
		$input = '<div class="control-label" style="text-align:left; margin-left: 15px;">'.$val."</div></div>";
		
	} else { 
		// this is a new registration
		$val   = ( isset( $_POST['log'] ) ) ? stripslashes( $_POST['log'] ) : '';
		$label = '<label for="username" class="col-sm-4 control-label">' . __( 'Choose a Username', 'wp-members' ) . $req_mark . '</label>';
		$input = wpmem_create_formfield( 'log', 'text', $val, '', 'form-control', 'Uživatelské jméno*' );

	}
	$field_before = ( $wrap_inputs ) ? '<div class="col-sm-12">' : '';
	$field_after  = ( $wrap_inputs ) ? '</div>': '';
	
	// add the username row to the array
	$rows['username'] = array( 
		'order'        => 0,
		'meta'         => 'username', 
		'type'         => 'text', 
		'value'        => $val,  
		'row_before'   => $row_before,
		'label'        => $label,
		'field_before' => $field_before,
		'field'        => $input,
		'field_after'  => $field_after,
		'row_after'    => $row_after
	);

	/**
	 * Filter the array of form fields.
	 *
	 * The form fields are stored in the WP options table as wpmembers_fields. This
	 * filter can filter that array after the option is retreived before the fields
	 * are parsed. This allows you to change the fields that may be used in the form
	 * on the fly.
	 *
	 * @since 2.9.0
	 *
	 * @param array           The array of form fields.
	 * @param string $toggle  Toggle new registration or profile update. new|edit.
 	 */
	$wpmem_fields = apply_filters( 'wpmem_register_fields_arr', get_option( 'wpmembers_fields' ), $toggle );
	//$wpmem_fields = get_option( 'wpmembers_fields' );
	
	// loop through the remaining fields
	foreach( $wpmem_fields as $field )
	{
		// start with a clean row
		$val = ''; $label = ''; $input = ''; $field_before = ''; $field_after = '';
		
		// skips user selected passwords for profile update
		$pass_arr = array( 'password', 'confirm_password', 'password_confirm' );
		$do_row = ( $toggle == 'edit' && in_array( $field[2], $pass_arr ) ) ? false : true;
		
		// skips tos, makes tos field hidden on user edit page, unless they haven't got a value for tos
		if( $field[2] == 'tos' && $toggle == 'edit' && ( get_user_meta( $userdata->ID, 'tos', true ) ) ) { 
			$do_row = false; 
			$hidden_tos = wpmem_create_formfield( $field[2], 'hidden', get_user_meta( $userdata->ID, 'tos', true ) );
		}
		
		// if the field is set to display and we aren't skipping, construct the row
		if( $field[4] == 'y' && $do_row == true ) {

			// label for all but TOS
			if( $field[2] != 'tos' ) {

				$class = ( $field[3] == 'password' ) ? 'text' : $field[3];
				
				$label = '<label for="' . $field[2] . '" class="col-sm-4 control-label">' . __( $field[1], 'wp-members' );
				$label = ( $field[5] == 'y' ) ? $label . $req_mark : $label;
				$label = $label . '</label>';

			} 

			// gets the field value for both edit profile and submitted reg w/ error
			if( ( $toggle == 'edit' ) && ( $wpmem_regchk != 'updaterr' ) ) { 

				switch( $field[2] ) {
					case( 'description' ):
						$val = htmlspecialchars( get_user_meta( $userdata->ID, 'description', 'true' ) );
						break;

					case( 'user_email' ):
					case( 'confirm_email' ):
						$val = $userdata->user_email;
						break;

					case( 'user_url' ):
						$val = esc_url( $userdata->user_url );
						break;

					default:
						$val = htmlspecialchars( get_user_meta( $userdata->ID, $field[2], 'true' ) );
						break;
				}

			} else {

				$val = ( isset( $_POST[ $field[2] ] ) ) ? $_POST[ $field[2] ] : '';

			}
			
			// does the tos field
			if( $field[2] == 'tos' ) {

				$val = ( isset( $_POST[ $field[2] ] ) ) ? $_POST[ $field[2] ] : ''; 

				// should be checked by default? and only if form hasn't been submitted
				$val   = ( ! $_POST && $field[8] == 'y' ) ? $field[7] : $val;
				$input = wpmem_create_formfield( $field[2], $field[3], $field[7], $val );
				$input = ( $field[5] == 'y' ) ? $input . $req_mark : $input;

				// determine if TOS is a WP page or not...
				$tos_content = stripslashes( get_option( 'wpmembers_tos' ) );
				if ( ( wpmem_test_shortcode( $tos_content, 'wp-members' ) ) ) {	
					$link = do_shortcode( $tos_content );
					$tos_pop = '<a href="' . $link . '" target="_blank">';
				} else { 
					$tos_pop = "<a href=\"#\" onClick=\"window.open('" . WP_PLUGIN_URL . "/wp-members/wp-members-tos.php','mywindow');\">";
				}
				
				/**
				 * Filter the TOS link text.
				 *
				 * @since 2.7.5
				 *
				 * @param string          The link text.
				 * @param string $toggle  Toggle new registration or profile update. new|edit.
				 */
				$input.= apply_filters( 'wpmem_tos_link_txt', sprintf( __( 'Please indicate that you agree to the %s TOS %s', 'wp-members' ), $tos_pop, '</a>' ), $toggle );
				
				// in previous versions, the div class would end up being the same as the row before.
				$field_before = ( $wrap_inputs ) ? '<div class="col-sm-offset-4 col-sm-4">' : '';
				$field_after  = ( $wrap_inputs ) ? '</div>' : '';

			} else {

				// for checkboxes
				if( $field[3] == 'checkbox' ) { 
					$valtochk = $val;
					$val = $field[7]; 
					// if it should it be checked by default (& only if form not submitted), then override above...
					if( $field[8] == 'y' && ( ! $_POST && $toggle != 'edit' ) ) { $val = $valtochk = $field[7]; }
				}

				// for dropdown select
				if( $field[3] == 'select' ) {
					$valtochk = $val;
					$val = $field[7];
				}

				if( ! isset( $valtochk ) ) { $valtochk = ''; }
				
				// for all other input types
				$input = wpmem_create_formfield( $field[2], $field[3], $val , $valtochk, 'form-control', $field[1] );
				
				// determine input wrappers
				$field_before = ( $wrap_inputs ) ? '<div class="col-sm-12">' : '';
				$field_after  = ( $wrap_inputs ) ? '</div>' : '';
			}

		}

		// if the row is set to display, add the row to the form array
		if( $field[4] == 'y' ) {
			$rows[$field[2]] = array(
				'order'        => $field[0],
				'meta'         => $field[2], 
				'type'         => $field[3], 
				'value'        => $val,  
				'row_before'   => $row_before,
				'label'        => $label,
				'field_before' => $field_before,
				'field'        => $input,
				'field_after'  => $field_after,
				'row_after'    => $row_after
			);
		}
	}
	
	
	// if captcha is Really Simple CAPTCHA
	if( WPMEM_CAPTCHA == 2 && $toggle != 'edit' ) {
		$row = wpmem_build_rs_captcha();
		$rows['captcha'] = array(
			'order'        => '',
			'meta'         => '', 
			'type'         => 'text', 
			'value'        => '',  
			'row_before'   => $row_before,
			'label'        => $row['label'],
			'field_before' => ( $wrap_inputs ) ? '<div class="col-sm-offset-4 col-sm-8">' : '',
			'field'        => $row['field'],
			'field_after'  => ( $wrap_inputs ) ? '</div>' : '',
			'row_after'    => $row_after		
		);
	}
	
	

	/**
	 * Filter the array of form rows.
	 *
	 * This filter receives an array of the main rows in the form, each array element being
	 * an array of that particular row's pieces. This allows making changes to individual 
	 * parts of a row without needing to parse through a string of HTML.
	 *
	 * @since 2.9.0
	 *
	 * @param array  $rows    An array containing the form rows. 
	 * @param string $toggle  Toggle new registration or profile update. new|edit.
 	 */
	$rows = apply_filters( 'wpmem_register_form_rows', $rows, $toggle );
	
	// put the rows from the array into $form
	$form = ''; $enctype = '';
	foreach( $rows as $row_item ) {
		$enctype = ( $row_item['type'] == 'file' ) ? "multipart/form-data" : $enctype;
		$row  = ( $row_item['row_before']   != '' ) ? $row_item['row_before'] . $n . $row_item['label'] . $n : $row_item['label'] . $n;
		$row .= ( $row_item['field_before'] != '' ) ? $row_item['field_before'] . $n . $t . $row_item['field'] . $n . $row_item['field_after'] . $n : $row_item['field'] . $n;
		$row .= ( $row_item['row_after']    != '' ) ? $row_item['row_after'] . $n : '';
		$form.= $row;
	}
	
	// do recaptcha if enabled
	if( WPMEM_CAPTCHA == 1 && $toggle != 'edit' ) { // don't show on edit page!
		
		// get the captcha options
		$wpmem_captcha = get_option( 'wpmembers_captcha' ); 
		
		// start with a clean row
		$row = '';
		$row = '<label class="col-sm-4 control-label">Enter CAPTCHA<span class="req">*</span></label>';
		$row.= '<div class="col-sm-8">' . wpmem_inc_recaptcha( $wpmem_captcha['recaptcha'] ) . '</div>';
		
		// add the captcha row to the form
		/**
		 * Filter the HTML for the CAPTCHA row.
		 *
		 * @since 2.9.0
		 *
		 * @param string          The HTML for the entire row (includes HTML tags plus reCAPTCHA).
		 * @param string $toggle  Toggle new registration or profile update. new|edit.
	 	 */
		$form.= apply_filters( 'wpmem_register_captcha_row', $row_before . $row . $row_after, $toggle );
	}

	// create hidden fields
	$var         = ( $toggle == 'edit' ) ? 'update' : 'register';
	$redirect_to = ( isset( $_REQUEST['redirect_to'] ) ) ? esc_url( $_REQUEST['redirect_to'] ) : get_permalink();
	$hidden      = '<input name="a" type="hidden" value="' . $var . '" />' . $n;
	$hidden     .= '<input name="redirect_to" type="hidden" value="' . $redirect_to . '" />' . $n;
	$hidden      = ( isset( $hidden_tos ) ) ? $hidden . $hidden_tos . $n : $hidden;
	
	/**
	 * Filter the hidden field HTML.
	 *
	 * @since 2.9.0
	 *
	 * @param string $hidden The generated HTML of hidden fields.
	 * @param string $toggle Toggle new registration or profile update. new|edit.
 	 */
	$hidden = apply_filters( 'wpmem_register_hidden_fields', $hidden, $toggle );
	
	// add the hidden fields to the form
	$form.= $hidden;
	
	// create buttons and wrapper
	$button_text = ( $toggle == 'edit' ) ? $submit_update : $submit_register;
	$buttons = ( $show_clear_form ) ? '<input name="reset" type="reset" value="' . $clear_form . '" class="' . $button_class . '" /> ' . $n : '';
	$buttons.= '<input name="submit" type="submit" value="' . $button_text . '" class="' . $button_class . '" />' . $n;
	
	/**
	 * Filter the HTML for form buttons.
	 *
	 * The string passed through the filter includes the buttons, as well as the HTML wrapper elements.
	 *
	 * @since 2.9.0
	 *
	 * @param string $buttons The generated HTML of the form buttons.
	 * @param string $toggle  Toggle new registration or profile update. new|edit.
 	 */
	$buttons = apply_filters( 'wpmem_register_form_buttons', $buttons, $toggle );
	
	// add the buttons to the form
	$form.= $buttons_before . $n . $buttons . $buttons_after . $n;

	// add the required field notation to the bottom of the form
	$form.= $req_label_before . $req_mark . $req_label . $req_label_after;
	
	// apply the heading
	/**
	 * Filter the registration form heading.
	 *
	 * @since 2.8.2
	 *
	 * @param string $str
	 * @param string $toggle Toggle new registration or profile update. new|edit.
 	 */
	$heading = ( !$heading ) ? apply_filters( 'wpmem_register_heading', __( 'New User Registration', 'wp-members' ), $toggle ) : $heading;
	$form = $heading_before . $heading . $heading_after . $n . $form;
	
	// apply fieldset wrapper
	$form = $fieldset_before . $n . $form . $n . $fieldset_after;
	
	// apply attribution if enabled
	$form = $form . wpmem_inc_attribution();
	
	// apply nonce
	$form = ( defined( 'WPMEM_USE_NONCE' ) || $use_nonce ) ? wp_nonce_field( 'wpmem-validate-submit', 'wpmem-form-submit' ) . $n . $form : $form;
	
	// apply form wrapper
	$enctype = ( $enctype == 'multipart/form-data' ) ? ' enctype="multipart/form-data"' : '';
	$form = '<form name="form" method="post"' . $enctype . ' action="' . get_permalink() . '" id="' . $form_id . '" class="' . $form_class . '">' . $n . $form. $n . '</form>';
	
    //Leva strana registrace
    $levastrana = '<hr><div class="col-sm-6 registrace-zobrazeni">
			<div class="not-important" id="need_help">
				<h3>Potřebujete pomoc?</h3>
				<p>Nevíte si s něčím rady? Pomůžeme Vám.</p>
				<br>
				<address>
					<div class="row">
						<div class="col-md-6 no-padding">
							<div class="col-md-3 no-padding"><i class="fa fa-envelope fa-3x"></i></div>
							<div class="col-md-9"><strong>E-mail:</strong><br><a href="mailto:info@tiskfotek.eu">info@tiskfotek.eu</a></div>
						</div>
						
						<div class="col-md-6">
							<div class="col-md-3"><i class="fa fa-phone fa-3x"></i></div>
							<div class="col-md-9 padding"><strong>Telefon:</strong><br>+420 776 073 337</div>
						</div>
					</div>
				</address>
			</div>
			
		</div>';
	// apply anchor
	$form = $levastrana . '<a name="register"><div class="col-sm-6 registrace-zobrazeni">' . $n . $form;
	
	// apply main div wrapper
	$form = $main_div_before . $n . $form . $n . $main_div_after . $n;
	
	// apply wpmem_txt wrapper
	$form = $txt_before . $form . $txt_after;
	
	// remove line breaks if enabled for easier filtering later
	$form = ( $strip_breaks ) ? str_replace( array( "\n", "\r", "\t" ), array( '','','' ), $form ) : $form;
	
	/**
	 * Filter the generated HTML of the entire form.
	 *
	 * @since 2.7.4
	 *
	 * @param string $form   The HTML of the final generated form.
	 * @param string $toggle Toggle new registration or profile update. new|edit.
	 * @param array  $rows   The rows array
	 * @param string $hidden The HTML string of hidden fields
 	 */
	$form = apply_filters( 'wpmem_register_form', $form, $toggle, $rows, $hidden );
	
	/**
	 * Filter before the form.
	 *
	 * This rarely used filter allows you to stick any string onto the front of
	 * the generated form.
	 *
	 * @since 2.7.4
	 *
	 * @param string $str    The HTML to add before the form. Default null.
	 * @param string $toggle Toggle new registration or profile update. new|edit.
 	 */
	$form = apply_filters( 'wpmem_register_form_before', '', $toggle ) . $form;

	// return the generated form
	return $form;
} // end wpmem_inc_registration

/**
 * Change Password Dialog
 *
 * Loads the form for changing password.
 *
 * @since 2.0
 *
 * @uses wpmem_login_form()
 *
 * @return string $str the generated html for the change password form
 */
function wpmem_inc_changepassword()
{
	/** create the default inputs **/
	$default_inputs = array(
		array(
			'name'   => __( 'New password' ), 
			'type'   => 'password',
			'tag'    => 'pass1',
			'class'  => 'form-control',
			'div'    => 'col-sm-8'
		),
		array( 
			'name'   => __( 'Confirm new password' ), 
			'type'   => 'password', 
			'tag'    => 'pass2',
			'class'  => 'form-control',
			'div'    => 'col-sm-8'
		)
	);

	/**
	 * Filter the array of change password form fields.
	 *
	 * @since 2.9.0
	 *
	 * @param array $default_inputs An array matching the elements used by default.
 	 */	
	$default_inputs = apply_filters( 'wpmem_inc_changepassword_inputs', $default_inputs );
	
	$defaults = array(
		'heading'      => __('Change Password', 'wp-members'), 
		'action'       => 'pwdchange', 
		'button_text'  => __('Update Password', 'wp-members'), 
		'inputs'       => $default_inputs
	);

	/**
	 * Filter the arguments to override change password form defaults.
	 *
	 * @since 2.9.0
	 *
	 * @param array $args An array of arguments to use. Default null.
 	 */
	$args = apply_filters( 'wpmem_inc_changepassword_args', '' );

	$arr  = wp_parse_args( $args, $defaults );

    $str  = wpmem_login_form( 'page', $arr );
	
	return $str;
}


/**
 * Reset Password Dialog
 *
 * Loads the form for resetting password.
 *
 * @since 2.1
 *
 * @uses wpmem_login_form()
 *
 * @return string $str the generated html fo the reset password form
 */
function wpmem_inc_resetpassword()
{ 
	/** create the default inputs **/
	$default_inputs = array(
		array(
			'name'   => __( 'Username' ), 
			'type'   => 'text',
			'tag'    => 'user', 
			'class'  => 'form-control',
			'div'    => 'col-sm-8'
		),
		array( 
			'name'   => __( 'Email' ), 
			'type'   => 'text', 
			'tag'    => 'email', 
			'class'  => 'form-control',
			'div'    => 'col-sm-8'
		)
	);

	/**
	 * Filter the array of reset password form fields.
	 *
	 * @since 2.9.0
	 *
	 * @param array $default_inputs An array matching the elements used by default.
 	 */	
	$default_inputs = apply_filters( 'wpmem_inc_resetpassword_inputs', $default_inputs );
	
	$defaults = array(
		'heading'      => __( 'Reset Forgotten Password', 'wp-members' ),
		'action'       => 'pwdreset', 
		'button_text'  => __( 'Reset Password' ), 
		'inputs'       => $default_inputs
	);

	/**
	 * Filter the arguments to override reset password form defaults.
	 *
	 * @since 2.9.0
	 *
	 * @param array $args An array of arguments to use. Default null.
 	 */
	$args = apply_filters( 'wpmem_inc_resetpassword_args', '' );

	$arr  = wp_parse_args( $args, $defaults );

    $str  = wpmem_login_form( 'page', $arr );
	
	return $str;
}

add_filter( 'widget_meta_poweredby', 'func' );

function func( $p1 ) {
    // Replace with custom powered by link
    return ' ';
}


