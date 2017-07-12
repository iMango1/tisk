<?php

/**
 * User Profile
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

	<?php do_action( 'bbp_template_before_user_profile' ); ?>
    <h3 class="block-head"><?php _e( 'Profile', 'bbpress' ); ?></h3>
	<div id="bbp-user-profile" class="bbp-user-profile">
		
		<div class="bbp-user-section">

			<?php if ( bbp_get_displayed_user_field( 'description' ) ) : ?>

				<p class="bbp-user-description"><?php bbp_displayed_user_field( 'description' ); ?></p>

			<?php endif; ?>
            <ul class="list list-ok alt">
			    <li><?php  printf( __( 'Forum Role: %s',      'bbpress' ), bbp_get_user_display_role()    ); ?></li>
			    <li><?php printf( __( 'Topics Started: %s',  'bbpress' ), bbp_get_user_topic_count_raw() ); ?></li>
			    <li><?php printf( __( 'Replies Created: %s', 'bbpress' ), bbp_get_user_reply_count_raw() ); ?></li>
            </ul>
		</div>
	</div><!-- #bbp-author-topics-started -->

	<?php do_action( 'bbp_template_after_user_profile' ); ?>
