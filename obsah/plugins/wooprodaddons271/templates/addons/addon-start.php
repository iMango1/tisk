
<?php
global $kolotoc;
if(($addon["field-name"] == "3032-nahled")){ ?>
    <div class="pole-blok"  id="fotka-<?php echo $kolotoc; ?>">
        <div class="col-md-2">
            
<?php } if(($addon["field-name"] == "3032-format")) { ?>
        <div class="col-md-8">
            <div class="col-md-4">
<?php } if(($addon["field-name"] == "3032-material")) { ?>
            <div class="col-md-4">
<?php } if(($addon["field-name"] == "3032-typ")) { ?>
            <div class="col-md-4">
<?php } ?>



<div class="<?php if ( 1 == $required ) echo 'required-product-addon'; ?> product-addon product-addon-<?php echo sanitize_title( $name ); ?>">

    
	<?php do_action( 'wc_product_addon_start', $addon ); ?>

	<?php if ( $name ) : ?>
  
        <!--
		<h3 class="addon-name nazev-pole"><?php echo wptexturize( $name ); ?> <?php if ( 1 == $required ) echo '<abbr class="required" title="required">*</abbr>'; ?></h3>
        -->

	<?php endif; ?>

	<?php if ( $description ) : ?>
		<?php echo '<div class="addon-description">' . wpautop( wptexturize( $description ) ) . '</div>'; ?>
	<?php endif; ?>

	<?php do_action( 'wc_product_addon_options', $addon ); ?>
