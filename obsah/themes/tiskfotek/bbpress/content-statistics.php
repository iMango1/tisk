<?php

/**
 * Statistics Content Part
 *
 * @package bbPress
 * @subpackage Theme
 */

// Get the statistics
$stats = bbp_get_statistics(); ?>

<table role="main" class="table-style2 margin-top-20">
    <tr>
    <th class="left-text main-color"><?php echo __("What's Going On?","itrays") ?></th>
    </tr>
	<?php do_action( 'bbp_before_statistics' ); ?>
    <tr>
    <td>
    <?php _e("Our users have posted a total of :","itrays") ?><strong><?php echo esc_html( $stats['topic_count'] ); ?></strong> <?php _e( 'Topics', 'bbpress' ); ?> <?php _e("in","itrays") ?> <strong><?php echo esc_html( $stats['forum_count'] ); ?></strong> <?php _e( 'Forums', 'bbpress' ); ?>
    <br>
    
    <?php _e("We have","itrays") ?> <strong><?php echo esc_html( $stats['user_count'] ); ?></strong> <?php _e( 'Registered Users', 'bbpress' ); ?>
    <br>
	
	<?php _e("Number of total replaies on all forums is","itrays") ?> <strong><?php echo esc_html( $stats['reply_count'] ); ?></strong> <?php _e( 'Replies', 'bbpress' ); ?>
	<br>
    
	<?php _e( 'Topic Tags', 'bbpress' ); ?>:<strong><?php echo esc_html( $stats['topic_tag_count'] ); ?></strong>
	<br>
	<?php if ( !empty( $stats['empty_topic_tag_count'] ) ) : ?>

		<dt><?php _e( 'Empty Topic Tags', 'bbpress' ); ?></dt>
		<dd>
			<strong><?php echo esc_html( $stats['empty_topic_tag_count'] ); ?></strong>
		</dd>

	<?php endif; ?>

	<?php if ( !empty( $stats['topic_count_hidden'] ) ) : ?>

		<dt><?php _e( 'Hidden Topics', 'bbpress' ); ?></dt>
		<dd>
			<strong>
				<abbr title="<?php echo esc_attr( $stats['hidden_topic_title'] ); ?>"><?php echo esc_html( $stats['topic_count_hidden'] ); ?></abbr>
			</strong>
		</dd>

	<?php endif; ?>

	<?php if ( !empty( $stats['reply_count_hidden'] ) ) : ?>

		<dt><?php _e( 'Hidden Replies', 'bbpress' ); ?></dt>
		<dd>
			<strong>
				<abbr title="<?php echo esc_attr( $stats['hidden_reply_title'] ); ?>"><?php echo esc_html( $stats['reply_count_hidden'] ); ?></abbr>
			</strong>
		</dd>

	<?php endif; ?>
    </td>
    </tr>
	<?php do_action( 'bbp_after_statistics' ); ?>

</table>

<?php unset( $stats );