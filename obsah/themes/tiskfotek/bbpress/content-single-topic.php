<?php

/**
 * Single Topic Content Part
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<div id="bbpress-forums">


	<?php do_action( 'bbp_template_before_single_topic' ); ?>

	<?php if ( post_password_required() ) : ?>

		<?php bbp_get_template_part( 'form', 'protected' ); ?>

	<?php else : ?>

		
        

		<?php if ( bbp_show_lead_topic() ) : ?>
          <div class="topic-wrapper">
			<?php bbp_get_template_part( 'content', 'single-topic-lead' ); ?>
          </div>
		<?php endif; ?>
        
        <div class=""><?php bbp_single_topic_description(); ?></div>
        
        <div class="hidden"><?php bbp_topic_tag_list(); ?></div>
        
		<?php if ( bbp_has_replies() ) : ?>

			<?php bbp_get_template_part( 'loop',       'replies' ); ?>

			<?php bbp_get_template_part( 'pagination', 'replies' ); ?>

		<?php endif; ?>
       <a href="#new-post" class="add-new">Reply</a>
            <div class="show-toggle">
		<?php bbp_get_template_part( 'form', 'reply' ); ?>
       </div>
	<?php endif; ?>

	<?php do_action( 'bbp_template_after_single_topic' ); ?>

</div>
