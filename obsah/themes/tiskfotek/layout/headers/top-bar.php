<?php 
$top_right = theme_option("topbarright");
$top_left = theme_option("topbarleft");
$show_cart = theme_option("topbar_show_cart");
$cart_pos = theme_option("topbar_cart_position");
$col = '';
$col2 = '';
if ($top_left == "empty"){
   $col = '12';
   $col2= '5';
}else if ($top_right == "empty"){
   $col2 = '12';
   $col='7';
}else{
  $col2 = '5';
  $col='7'; 
}
$langcode = '';
if ( class_exists( 'SitePress' ) ) {
    $langcode = '-'.ICL_LANGUAGE_CODE;
}
?>
<div class="top-bar">
    <div class="container">
            
            <!-- Left Top Bar -->
            <?php if ($top_left !== "empty") { ?>
            
                <div class="left">
                    <?php if ($top_left == "text") { ?>
                        <span class="left top-bar-txt">
                            <?php echo wp_kses(theme_option('top_left_text'.$langcode),it_allowed_tags()); ?>
                        </span>
                    <?php } else if ($top_left == "wpml") { ?>
                        <span class="left">
                        <?php 
                            if(if_wpml_activated()){
                                do_action('icl_language_selector');
                            }else{
                                echo '<span class="menu-message">'. __('Please Install and Activate WPML Plugin','itrays'). '</span>';
                            }
                        ?>
                        </span>
                    <?php } else if ($top_left == "contact") { ?>
                        <ul class="left">
                            <?php if(theme_option("contact_email_top_bar")){ ?>
                            <li><a href="mailto:<?php echo esc_html(theme_option("contact_email")); ?>"><i class="fa fa-envelope"></i><?php echo esc_html(theme_option("contact_email")); ?></a></li>
                            <?php } ?>
                            <?php if(theme_option("contact_phone_top_bar")){ ?>
                            <li><span><i class="fa fa-phone"></i> <?php echo __('Call Us:','itrays') ?> <?php echo esc_attr(theme_option("contact_phone")); ?></span></li>
                            <?php } ?>
                            <?php if(theme_option("contact_address_top_bar")){ ?>
                            <li><span><i class="fa fa-map-marker"></i><?php echo esc_attr(theme_option("contact_address".$langcode)); ?></span></li>
                            <?php } ?>
                        </ul>
                    <?php } else if ($top_left == "socials") { ?>
                        <span class="left"><?php echo display_social_icons(); ?></span>
                    <?php } else if ($top_left == "userlinks") { ?>
                        <span class="left">
                        <?php
                            if ( has_nav_menu( 'top-menu' ) ) {
                                  it_nav_menu( array( 'theme_location' => 'top-menu', 'menu_class' => '', 'container'=>'', 'items_wrap' => '<ul class="top-bar-menu">%3$s</ul>' ) );
                            }else{
                                echo '<span class="menu-message">'.__('Please go to admin panel > Menus > select top- menu and add items to it.','itrays').'</span>';
                            } 
                            ?>
                        </span>
                    <?php } else if ($top_left == "loginregister") { ?>
                        <ul class="left">
                        <?php if ( $user_ID ) : ?>
                            <?php global $user_identity; ?>
                            <li class="login-out"><b><?php echo __('Welcome','itrays') ?></b>, <a href="<?php echo esc_url(get_option('siteurl')); ?>/muj-ucet/"><?php echo $user_identity; ?></a> <a href="<?php echo esc_url(wp_logout_url()); ?>" title="<?php echo __('Log out of this account','itrays') ?>"><?php echo __('Log Out','itrays') ?></a></li>
                        <?php else : ?>
                            
                            <?php if (get_option('users_can_register')) : ?>
                                <li><a href="<?php echo esc_url(get_option('siteurl')); ?>/muj-ucet/"><i class="fa fa-user"></i><?php _e('Register','itrays') ?></a></li>
                            <?php endif; ?>
                            <li><a href="#" class="login-btn"><i class="fa fa-unlock-alt"></i> <?php echo __('Login','itrays') ?></a></li>
                        <?php endif; ?>
                        </ul>
                    <?php } ?>
                    <?php if($show_cart == '1' && $cart_pos == 'left'){ ?>
                        <span class="top-cart right">
                            <?php echo it_topbar_wo_cart(); ?>
                        </span>
                    <?php } ?>
                </div>
            
            <?php } ?>  
            
            
            <!-- Right Top Bar -->                     
            <?php if ($top_right !== "empty") { ?>
            
                <div class="right-bar right">
                    <?php if($show_cart == '1' && $cart_pos == 'right'){ ?>
                        <span class="top-cart left">
                            <?php echo it_topbar_wo_cart(); ?>
                        </span>
                    <?php } ?>
                    <?php if ($top_right == "loginregister") { ?>
                        <ul class="right">
                        <?php if ( $user_ID ) : ?>
                            <?php global $user_identity; ?>
                            <li class="login-out"><b><?php echo __('Welcome','itrays') ?></b>, <a href="<?php echo esc_url(get_option('siteurl')); ?>/muj-ucet/"><?php echo $user_identity; ?></a> <a href="<?php echo esc_url(wp_logout_url(get_site_url())); ?>" title="<?php echo __('Log out of this account','itrays') ?>"><?php echo __('Log Out','itrays') ?></a></li>
                        <?php else : ?>
                            
                            <?php if (get_option('users_can_register')) : ?>
                                <li><a href="<?php echo esc_url(get_option('siteurl')); ?>/prihlaseni/"><i class="fa fa-user"></i><?php _e('Register','itrays') ?></a></li>
                            <?php endif; ?>
                            <li><a href="#" class="login-btn"><i class="fa fa-unlock-alt"></i> <?php echo __('Login','itrays') ?></a></li>
                        <?php endif; ?>
                    </ul>
                    <?php } else if ($top_right == "wpml") { ?>
                        <span class="right">
                        <?php 
                            if(if_wpml_activated()){
                                do_action('icl_language_selector');
                            }else{
                                echo '<span class="menu-message">'. __('Please Install and Activate WPML Plugin','itrays'). '</span>';
                            }
                        ?>
                        </span>
                    <?php } else if ($top_right == "text") { ?>
                        <span class="right top-bar-txt">
                            <?php echo wp_kses(theme_option('top_right_text'.$langcode),it_allowed_tags()); ?>
                        </span>
                    <?php } else if ($top_right == "contact") { ?>
                        <ul class="right">
                            <?php if(theme_option("contact_email_top_bar")){ ?>
                            <li><a href="mailto:<?php echo esc_html(theme_option("contact_email")); ?>"><i class="fa fa-envelope"></i><?php echo esc_html(theme_option("contact_email")); ?></a></li>
                            <?php } ?>
                            <?php if(theme_option("contact_phone_top_bar")){ ?>
                            <li><span><i class="fa fa-phone"></i> <?php echo __('Call Us:','itrays') ?> <?php echo esc_attr(theme_option("contact_phone")); ?></span></li>
                            <?php } ?>
                            <?php if(theme_option("contact_address_top_bar")){ ?>
                            <li><span><i class="fa fa-map-marker"></i><?php echo esc_attr(theme_option("contact_address".$langcode)); ?></span></li>
                            <?php } ?>
                        </ul>
                    <?php } else if ($top_right == "socials") { ?>
                        <span class="right">
                            <?php echo display_social_icons(); ?>
                        </span>
                    <?php } else if ($top_right == "userlinks") { ?>
                        <div class="right top-bar-menu">
                            <?php
                            if ( has_nav_menu( 'top-menu' ) ) {
                                  it_nav_menu( array( 'theme_location' => 'top-menu', 'menu_class' => '', 'container'=>'', 'items_wrap' => '<ul class="top-bar-menu right">%3$s</ul>' ) );
                            }else{
                                echo '<span class="menu-message">'.__('Please go to admin panel > Menus > select top- menu and add items to it.','itrays').'</span>';
                            } 
                            ?>
                        </div>
                    <?php } ?>
                </div>
            
            <?php } ?>
    </div>
</div>
