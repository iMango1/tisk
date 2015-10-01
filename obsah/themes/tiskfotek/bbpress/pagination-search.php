<?php

/**
 * Pagination for pages of search results 
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php do_action( 'bbp_template_before_pagination_loop' ); ?>

<div class="bbp-pagination">
	<div class="bbp-pagination-count">

		<?php bbp_search_pagination_count(); ?>

	</div>

    <?php
        $pg_pos_bb = theme_option('pager_position_bb');
        if ( theme_option('pager_style_bb') == "1" ) { ?>
            <div class="pager-bbp pager pager-style1 skew-25 <?php echo $pg_pos_bb;?>">
                <?php bbp_search_pagination_links(); ?>
            </div>
        <?php }else if (theme_option('pager_style_bb') == "2"){ ?>
            <div class="pager-bbp pager-style2 <?php echo $pg_pos_bb;?>">
                <?php bbp_search_pagination_links(); ?>
            </div>
        <?php }else if (theme_option('pager_style_bb') == "3"){ ?>
            <div class="pager-bbp pager-style3 <?php echo $pg_pos_bb;?>">
                <?php bbp_search_pagination_links(); ?>
            </div>
        <?php }else if (theme_option('pager_style_bb') == "4"){ ?>
            <div class="pager-bbp pager-style4 <?php echo $pg_pos_bb;?>">
                <?php bbp_search_pagination_links(); ?>
            </div>
        <?php }else if (theme_option('pager_style_bb') == "5"){ ?>
            <div class="pager-bbp pager-style5 <?php echo $pg_pos_bb;?>">
                <?php bbp_search_pagination_links(); ?>
            </div>
        <?php }else if (theme_option('pager_style_bb') == "6"){ ?>
            <div class="pager-bbp pager-style6 <?php echo $pg_pos_bb;?>">
                <?php bbp_search_pagination_links(); ?>
            </div>
        <?php } ?>
    
</div>

<?php do_action( 'bbp_template_after_pagination_loop' ); ?>
