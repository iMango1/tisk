<?php

/**
 * Forums Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php do_action( 'bbp_template_before_forums_loop' ); ?>

<table id="forums-list-<?php bbp_forum_id(); ?>" class="bbp-forums table-style2">

	<tr class="bbp-header">

			<th class="bbp-forum-info left-text"><?php _e( 'Forum', 'bbpress' ); ?></th>
			<th class="bbp-forum-topic-count"><?php _e( 'Topics', 'bbpress' ); ?></th>
			<th class="bbp-forum-reply-count"><?php bbp_show_lead_topic() ? _e( 'Replies', 'bbpress' ) : _e( 'Posts', 'bbpress' ); ?></th>
			<th class="bbp-forum-freshness"><?php _e( 'Freshness', 'bbpress' ); ?></th>

	</tr><!-- .bbp-header -->


		<?php while ( bbp_forums() ) : bbp_the_forum(); ?>

			<?php bbp_get_template_part( 'loop', 'single-forum' ); ?>

		<?php endwhile; ?>

<!-- .bbp-body -->

</table><!-- .forums-directory -->

<?php do_action( 'bbp_template_after_forums_loop' ); ?>
