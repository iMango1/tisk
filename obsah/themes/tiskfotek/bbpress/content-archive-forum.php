<?php

/**
 * Archive Forum Content Part
 *
 * @package bbPress
 * @subpackage Theme
 */
$langcode = '';
if ( class_exists( 'SitePress' ) ) {
    $langcode = '-'.ICL_LANGUAGE_CODE;
}
?>

<div id="bbpress-forums">

	<?php if ( theme_option('show_welcome_bb') == "1" ) : ?>
        <div class="welcome_bb">
            <?php echo wp_kses(theme_option('welcome_bb'.$langcode),it_allowed_tags()); ?>
        </div>
    <?php endif; ?>
    <?php if ( bbp_allow_search() ) : ?>

		<div class="forum-search">

			<?php bbp_get_template_part( 'form', 'search' ); ?>

		</div>

	<?php endif; ?>

	

	<?php bbp_forum_subscription_link(); ?>
    
	<?php do_action( 'bbp_template_before_forums_index' ); ?>

	<?php if ( bbp_has_forums() ) : ?>

		<?php bbp_get_template_part( 'loop',     'forums'    ); ?>

	<?php else : ?>

		<?php bbp_get_template_part( 'feedback', 'no-forums' ); ?>

	<?php endif; ?>
	<?php do_action( 'bbp_template_after_forums_index' ); ?>
    <?php include_once( 'content-statistics.php' ); ?>
</div>
