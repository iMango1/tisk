<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
<input type="text" value="<?php echo get_search_query(); ?>" name="s" class="txt-box" placeHolder="<?php echo __('Enter search keyword here...','itrays') ?>" />
<button type="submit" class="btn main-bg" data-text="<?php echo __('GO','itrays') ?>"><i class="fa fa-search"></i></button>
</form>