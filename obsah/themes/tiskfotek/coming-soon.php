<?php
/*
Template Name: Coming Soon Template
*/
$langcode = '';
if ( class_exists( 'SitePress' ) ) {
    $langcode = '-'.ICL_LANGUAGE_CODE;
}
$lghead = theme_option('soon_large_heading'.$langcode);
$desc = theme_option('soon_decription'.$langcode);
$showlinks = theme_option('show_social_links');
$digits = theme_option('show_count_down');
$fb = theme_option('soon_facebook');
$tw = theme_option('soon_twitter');
$ln = theme_option('soon_linkedin');
$gplus = theme_option('soon_google-plus');
$sky = theme_option('soon_skype');
$rss = theme_option('soon_rss');
$ut = theme_option('soon_youtube');
$pghead = theme_option('show_page_head');
$soon_bg = theme_option('soon_bg');
if($pghead == '1'){
    get_header();    
}else{
    get_template_part( 'layout/heads/soon-header');
}

?>
<div class="lg-padding soon_container">
    <div class="container">
        <?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
        <div class="center soon-top">
            <?php if($lghead != ''){ ?>
                <p class="extraBold large-title soon_lg_head"><?php echo wp_filter_post_kses($lghead); ?></p>
            <?php } ?>
            <?php if($desc != ''){ ?>
                <div class="large-paragraph soon_desc"><?php echo wp_kses($desc,it_allowed_tags()); ?></div>
            <?php } ?>
        </div>
        <?php if($digits == '1'){ ?>            
            <div id="holder">
                <div class="count-down">
                    <div class="digits"></div>
                </div>
            </div>
        <?php } ?>
        <?php if($showlinks == '1'){ ?>
            <div class="padd-vertical-40">
                <ul class="larg-socials">
                    <?php if($fb != ''){ ?>
                        <li><a href="<?php echo esc_url($fb); ?>"><i class="fa fa-facebook"></i></a></li>
                    <?php } ?>
                    <?php if($tw != ''){ ?>
                        <li><a href="<?php echo esc_url($tw); ?>"><i class="fa fa-twitter"></i></a></li>
                    <?php } ?>
                    <?php if($ln != ''){ ?>
                        <li><a href="<?php echo esc_url($ln); ?>"><i class="fa fa-linkedin"></i></a></li>
                    <?php } ?>
                    <?php if($gplus != ''){ ?>
                        <li><a href="<?php echo esc_url($gplus); ?>"><i class="fa fa-google-plus"></i></a></li>
                    <?php } ?>
                    <?php if($sky != ''){ ?>
                        <li><a href="<?php echo esc_url($sky); ?>"><i class="fa fa-skype"></i></a></li>
                    <?php } ?>
                    <?php if($rss != ''){ ?>
                        <li><a href="<?php echo esc_url($rss); ?>"><i class="fa fa-rss"></i></a></li>
                    <?php } ?>
                    <?php if($ut != ''){ ?>
                        <li><a href="<?php echo esc_url($ut); ?>"><i class="fa fa-youtube"></i></a></li>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>
    </div>
</div>
<?php get_footer(); ?>
