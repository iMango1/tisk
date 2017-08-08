<?php
/**
 * @package   Woo Smart Emailing
 * @author    Vladislav Musílek
 * @license   GPL-2.0+
 * @link      http://toret.cz
 * @copyright 2014 Toret.cz
 */


if(isset($_POST['control'])){ 
  if(!empty($_POST['licence'])){
    if(trim($_POST['licence'])!=''){  
      wooshop_smart_control_licence($_POST['licence']); 
    }
  }
  wp_redirect(home_url().'/wp-admin/admin.php?page=woo-smart-emailing');
   
}  


/**
 * Save eshop setting
 */  
if(isset($_POST['update'])){
  $smart_option = array();
  
  if(!empty($_POST['token'])){
    $smart_option['token'] = $_POST['token'];
  }
  if(!empty($_POST['user'])){
    $smart_option['user'] = $_POST['user'];
  }
  if(!empty($_POST['use_product_list'])){
    $smart_option['use_product_list'] = $_POST['use_product_list'];
  }
  if(!empty($_POST['list_id'])){
    $smart_option['list_id'] = $_POST['list_id'];
  }
  if(!empty($_POST['language'])){
    $smart_option['language'] = $_POST['language'];
  }
  if(!empty($_POST['checkout_display'])){
    $smart_option['checkout_display'] = $_POST['checkout_display'];
  }
  if(!empty($_POST['checkout_text'])){
    $smart_option['checkout_text'] = $_POST['checkout_text'];
  }
  if(!empty($_POST['checkout_yes'])){
    $smart_option['checkout_yes'] = $_POST['checkout_yes'];
  }
  update_option( 'smart_emailing_option', $smart_option );
  wp_redirect(home_url().'/wp-admin/admin.php?page=woo-smart-emailing');
  
} 

$option = get_option('smart_emailing_option');

$licence_key  = get_option('wooshop-smart-licence-key');
$licence_info = get_option('wooshop-smart-info');
global $lic_smart; 


?>

<div class="wrap">

	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

<div class="t-col-9">
  <div class="toret-box box-info">
    <div class="box-header">
      <h3 class="box-title"><?php _e('Licence',$this->plugin_slug); ?></h3>
    </div>
    <div class="box-body">
      <form method="post" action="" class="setting-form">	
      
      	<?php if(!empty($licence_info)){ ?>
        <p><strong><?php echo $licence_info; ?></strong></p>
        <?php
            delete_option('wooshop-doprava-info');  
          }
        ?>
        <?php if(!empty($lic_smart)){ ?>
        <p><strong>Vaše licence je aktivní.</strong></p>
        <?php
          }
        ?>
      
        <table class="table-bordered">
          <tr>
            <th><?php _e('Licence pluginu',$this->plugin_slug); ?></th>
            <td>
              <input style="width:100%;" type="text" name="licence" value="<?php if(!empty($licence_key)){ echo $licence_key; } ?>">
            </td>
          </tr>
        
        </table>
        <input type="hidden" name="control" value="ok" />
        <input type="submit" class="btn btn-info" value="<?php _e('Ověřit licenci',$this->plugin_slug); ?>" />
      </form>
    </div>
  </div>
</div>
<div class="t-col-9">
  <div class="toret-box box-info">
    <div class="box-header">
      <h3 class="box-title"><?php _e('Nastavení',$this->plugin_slug); ?></h3>
    </div>
    <div class="box-body">
      <form method="post" action="" class="setting-form">	
        <table class="table-bordered">
          <tr>
            <th><?php _e('Api klíč',$this->plugin_slug); ?></th>
            <td>
              <input style="width:100%;" type="text" name="token" value="<?php if(!empty($option['token'])){ echo $option['token']; } ?>">
            </td>
          </tr>
          <tr>
            <th><?php _e('Přihlašovací email',$this->plugin_slug); ?></th>
            <td>
              <input style="width:100%;" type="text" name="user" value="<?php if(!empty($option['user'])){ echo $option['user']; } ?>">
            </td>
          </tr>
          <tr>
            <th><?php _e('Přiřadit do seznamu dle produktu',$this->plugin_slug); ?></th>
            <td>
              <input type="checkbox" name="use_product_list" value="yes" <?php if(!empty($option['use_product_list']) && $option['use_product_list'] == 'yes'){ echo 'checked="checked"'; } ?>>
            </td>
          </tr>
          <tr>
            <th><?php _e('ID seznamu kontaktů',$this->plugin_slug); ?></th>
            <td>
              <input style="width:100%;" type="text" name="list_id" value="<?php if(!empty($option['list_id'])){ echo $option['list_id']; } ?>">
            </td>
          </tr>
          <tr>
            <th><?php _e('Jazyk',$this->plugin_slug); ?></th>
            <td>
              <select name="language">
                <option value="cs_CZ" <?php if(!empty($option['language']) && $option['language'] == 'cs_CZ'){  echo 'selected="selected"';} ?>><?php _e('Čeština',$this->plugin_slug); ?></option>
                <option value="sk_SK" <?php if(!empty($option['language']) && $option['language'] == 'sk_SK'){  echo 'selected="selected"';} ?>><?php _e('Slovenština',$this->plugin_slug); ?></option>
                <option value="en_GB" <?php if(!empty($option['language']) && $option['language'] == 'en_GB'){  echo 'selected="selected"';} ?>><?php _e('Angličtina',$this->plugin_slug); ?></option>
              </select>
            </td>
          </tr>
          <tr>
            <th><?php _e('Zobrazit info na stránce pokladny',$this->plugin_slug); ?></th>
            <td>
              <input type="checkbox" name="checkout_display" value="yes" <?php if(!empty($option['checkout_display']) && $option['checkout_display'] == 'yes'){ echo 'checked="checked"'; } ?>>
            </td>
          </tr>
          <tr>
            <th><?php _e('Text informace',$this->plugin_slug); ?></th>
            <td>
              <input style="width:100%;" type="text" name="checkout_text" value="<?php if(!empty($option['checkout_text'])){ echo $option['checkout_text']; } ?>" placeholder="<?php _e('Souhlasím s odběrem novinek.',$this->plugin_slug); ?>">
            </td>
          </tr>
          <tr>
            <th><?php _e('Zaškrtnout souhlas?',$this->plugin_slug); ?></th>
            <td>
              <input type="checkbox" name="checkout_yes" value="yes" <?php if(!empty($option['checkout_yes']) && $option['checkout_yes'] == 'yes'){ echo 'checked="checked"'; } ?>>
            </td>
          </tr>
        
        </table>
        <input type="hidden" name="update" value="ok" />
        <input type="submit" class="btn btn-info" value="<?php _e('Uložit',$this->plugin_slug); ?>" />
      </form>
      <th><?php _e('Nastavení seznamu dle produktu umožňuje přiřadit kontakt do seznamu, který se vztahuje k produktu. Id seznamu je nutno zadat v detailu produktu a bude vždy vybráno dle posledního produktu v košíku. Toto nastavení je vhodné, pokud prodáváte po jednom kusu produktu.',$this->plugin_slug); ?></th>
    </div>
  </div>
</div>


<div class="clear"></div>

</div>

    
  