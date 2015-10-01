<?php
    $hid_mess = theme_option("login_welcome");
    $l_mess = theme_option("login_welcome_message");
?>

<div class="login-box">
    <a class="close-login" href="#"><i class="fa fa-times"></i></a>
        <div class="container">
            <form name="loginform" id="loginform" action="<?php echo get_option('siteurl'); ?>/spravce" method="post">
            <?php if(!$hid_mess){ ?>
                <p><?php echo wp_kses($l_mess,it_allowed_tags()); ?></p>
            <?php } ?>
            <div class="login-controls">
                <div class="skew-25 input-box left">
                    <input value="" class="txt-box skew25 no-border" type="text" size="20" placeholder="<?php echo __('User name Or Email','itrays'); ?>" tabindex="10" name="log" id="user_login" />
                </div>
                <div class="skew-25 input-box left">
                    <input value="" class="txt-box skew25 no-border" placeholder="<?php echo __('Password','itrays'); ?>" type="password" size="20" tabindex="20" name="pwd" id="user_pass" />
                </div>
                <div class="left-btn skew-25 main-bg">
                    <input name="wp-submit" id="wp-submit" value="<?php echo __('Login','itrays'); ?>" tabindex="100" type="submit" class="btn skew25">
                </div>
                <div class="check-box-box">
                    <input name="rememberme" id="rememberme" value="forever" tabindex="90" class="check-box" type="checkbox"><label><?php echo __('Remember me !','itrays'); ?></label>
                </div>
                <input name="redirect_to" value="<?php echo get_option('siteurl'); ?>" type="hidden">
                <input name="testcookie" value="1" type="hidden">
            </div>        
            </form>                        
        </div>
</div>
