<?php
get_header(); 
$blogstyle = theme_option('blogstyle');
get_template_part( 'layout/page-titles/title-tag');
$col = '';
$lay = theme_option('blog_sidebar');

if($lay == 'right' || $lay == 'left'){
    $col = '9';
}else{
    $col = '12';
}
$dir ='';
if($lay == 'right'){
   $dir =' lft'; 
}else if($lay == 'left'){
   $dir =' rit'; 
}
?>
        
<div class="lg-padding">
    <div class="container">
        <div class="row">
            <?php if ( $lay == 'left' ) { ?>
                <?php get_sidebar(); ?>
            <?php } ?>
            <div class="col-md-<?php echo $col; ?><?php echo $dir; ?>">
                <?php if ( have_posts() ) : ?>
                    <div class="blog-posts" id="content">
                        <?php get_template_part( 'layout/blog/blog-'.$blogstyle) ?>
                    </div>
                    <?php else: 
                    the_content;
                    endif; ?>
                <div class="clearfix"></div>
                <?php it_paging_nav(); ?>
            </div>
            <?php if ( $lay == 'right' ) { ?>
                <?php get_sidebar(); ?>
            <?php } ?>
        </div>
    </div>
</div>

<?php
get_footer();
