<?php

if ( post_password_required() )
	return;
?>
<?php if ( theme_option('singlecomment_on') == "1" ) : ?>
<div id="comments" class="comments comments-area">
	<?php if ( have_comments() ) : ?>
		<h3 class="block-head"><?php echo __('Comments','itrays'); ?></h3>
        <p class="hint marginBottom bold"><?php
                printf( _n( 'There is <span class="main-color">1</span> comment on this post', 'There are <span class="main-color">%1$s</span> comments on this post', get_comments_number(), '' ),
                    number_format_i18n( get_comments_number() ) );
            ?></p>
		<ul class="comment-list">
			<?php wp_list_comments('callback=IT_comment_template'); ?>
		</ul>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-below" class="navigation" role="navigation">
			<h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', '' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', '' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', '' ) ); ?></div>
		</nav>
		<?php 
        endif;
		if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.' , 'itrays' ); ?></p>
		<?php endif; ?>

	<?php endif; ?>

	<?php comment_form(); ?>

</div>
<?php endif; ?>