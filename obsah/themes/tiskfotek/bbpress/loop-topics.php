<?php

/**
 * Topics Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php do_action( 'bbp_template_before_topics_loop' ); ?>

<table id="bbp-forum-<?php bbp_forum_id(); ?>" class="bbp-topics table-style2">

	<tr class="bbp-header">

			<th class="bbp-topic-title left-text"><?php _e( 'Topic', 'bbpress' ); ?></th>
			<th class="bbp-topic-voice-count"><?php _e( 'Voices', 'bbpress' ); ?></th>
			<th class="bbp-topic-reply-count"><?php bbp_show_lead_topic() ? _e( 'Replies', 'bbpress' ) : _e( 'Posts', 'bbpress' ); ?></th>
			<th class="bbp-topic-freshness"><?php _e( 'Freshness', 'bbpress' ); ?></th>

	</tr>

		<?php while ( bbp_topics() ) : bbp_the_topic(); ?>

			<?php bbp_get_template_part( 'loop', 'single-topic' ); ?>

		<?php endwhile; ?>

</table><!-- #bbp-forum-<?php bbp_forum_id(); ?> -->

<?php do_action( 'bbp_template_after_topics_loop' ); ?>
