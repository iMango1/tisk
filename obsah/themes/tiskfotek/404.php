<?php 
get_header();

// page title function.
it_title_style();
?> 
<div class="lg-padding">
    <div class="container">
        <div class="not-found">
            <p class="hint extraLarge"><?php echo __('The Page You Are Looking for can not Be Found.','itrays') ?></p>
            <hr class="hr-style3">
            <div class="err-404">4<span class="main-color">0</span>4</div>
            <hr class="hr-style3">
            <div class="padd-vertical-30"><?php echo __('You can use the form below to search for what you need.','itrays'); ?>
            <div class="srch-box-page"><?php get_search_form(); ?></div>
            </div>
            <a class="btn btn-large main-bg" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo __('Back To Home Page','itrays'); ?></a>        
        </div>
    </div>
</div>
<?php get_footer(); ?>