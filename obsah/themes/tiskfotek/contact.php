<?php
/*
Template Name: Contact Page
*/
get_header(); 
$c_style = theme_option("contact_style");
$show_map = theme_option("show_googlemap");
$langcode = '';
if ( class_exists( 'SitePress' ) ) {
    $langcode = '-'.ICL_LANGUAGE_CODE;
}

// page title function.
it_title_style();
?>  
<?php if ($show_map == '1') : ?>
    <?php if ($c_style == '3' || $c_style == '4') : ?>
    <div class="padd-vertical-45">
        <?php if ($c_style == '4') : ?>
            <div class="container">
        <?php endif; ?>
            
            <?php it_google_map(); ?>
            
        <?php if ($c_style == '4') : ?>
            </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>
<?php endif; ?>

<div class="md-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-7 contact-form fx" data-animate="fadeInLeft" id="contact">
                <h3 class="block-head"><?php echo __('Get in Touch','itrays') ?></h3>
                <?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
            </div>
            <div class="col-md-5 contact-detalis">
                <h3 class="block-head"><?php echo __('Contact Details','itrays') ?></h3>
                <p class="fx" data-animate="fadeInRight"><?php echo wp_kses(theme_option('contact_decription'.$langcode),it_allowed_tags()); ?></p>
                <div class="divider divider-6"><i class="divid_center fa fa-cloud"></i></div>
                <div class="clearfix"></div>
                
                
                <div class="padding-vertical contact-offices">
                    <div class="row">
                        <?php it_contact_offices(); ?>
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>
</div>

<?php if ($show_map == '1') : ?>
    <?php if ($c_style == '1' || $c_style == '2') : ?>
    <div class="padd-vertical-45">
        <?php if ($c_style == '2') : ?>
            <div class="container">
        <?php endif; ?>
            
            <?php it_google_map(); ?>

        <?php if ($c_style == '2') : ?>
            </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>
<?php endif; ?>

<?php get_footer();
