<?php
if(isset($_POST['update'])){
  if(!empty($_POST['licence'])){
    if(trim($_POST['licence'])!=''){  
      control_woo_gopay_licence($_POST['licence']); 
    }
  }
}

if(isset($_GET['delete']) && $_GET['delete']== 'log'){
  Toret_GoPay_Log::delete_logs();
}


$licence_key  = get_option('wooshop-gopay-licence-key');
$licence_info = get_option('wooshop-gopay-info');
global $lic;

?>

<div class="wrap">

	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
  
    <div class="t-col-12">
      <div class="toret-box box-info">
          <div class="box-header">
            <h3 class="box-title"><?php _e('Kurzy',$this->plugin_slug); ?></h3>
          </div>
          <div class="box-body">
            <?php 
              if(!function_exists("mcrypt_encrypt")) {
                echo '<p style="color:red;">Activujte mcrypt knihovnu</p>';
              }
            ?>

            <?php if(!empty($licence_info)){ ?>
            <p><strong><?php echo $licence_info; ?></strong></p>
            <?php
              delete_option('wooshop-gopay-info');  
            }
            ?>
            <?php if(!empty($lic)){ ?>
              <p><strong>Vaše licence je aktivní.</strong></p>
            <?php
            }
            ?>
          <form method="post">
	          <input type="text" name="licence" id="licence" style="width:400px;" value="<?php if(!empty($licence_key)){ echo $licence_key; } ?>" />
            <input type="hidden" name="update" value="ok" />
            <input type="submit" class="button" value="Ověřit licenci" />
          </form>
        </div>
      </div>
    </div>  
    <div class="clear"></div>

    <div class="t-col-12">
      <div class="toret-box box-info">
        <div class="box-header">
          <h3 class="box-title"><?php _e( 'Záznamy', $this->plugin_slug ); ?></h3>
        </div>
        <p><a href="<?php echo admin_url(); ?>admin.php?page=woocommerce-gopay&delete=log" class="btn btn-info" style="margin-left:10px;"><?php _e('Smazat log', 'woocommerce-gopay'); ?></a></p>
        <div class="box-body">
          <table class="table-bordered">
            <tr>
              <th><?php _e('Datum', $this->plugin_slug); ?></th>
              <th><?php _e('Záznam', $this->plugin_slug); ?></th>
              <th><?php _e('Poznámka', $this->plugin_slug); ?></th>
              <th><?php _e('Status', $this->plugin_slug); ?></th>
              <th><?php _e('Kontext', $this->plugin_slug); ?></th>
            </tr>
            <?php 

            $logs = Toret_GoPay_Log::get_all_logs();
            
            if( !empty( $logs ) ){
            foreach( $logs as $item ){ 
            ?>
            <tr>
              <td><?php echo $item->date; ?></td>
              <td class="gopay-table-log"><span><?php echo $item->log; ?></span></td>
              <td><?php echo $item->note; ?></td>
              <td><?php echo $item->status; ?></td>
              <td><?php echo $item->context; ?></td>
            </tr>
            <?php } 
            } ?>
          </table>
        </div>
      </div>
    </div>

</div>
