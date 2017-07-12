<?php
get_header(); 
$blogstyle = theme_option('blogstyle');

$col = '';
$lay = theme_option('blog_sidebar');

if($lay == 'right' || $lay == 'left'){
    $col = '9';
}else{
    $col = '12';
}
get_template_part( 'layout/page-titles/title-archive');
?>
        
<div class="lg-padding">
    <div class="container">
        <div class="row">
            <?php if ( $lay == 'left' ) { ?>
                <?php get_sidebar(); ?>
            <?php } ?>
            <div class="col-md-<?php echo $col; ?>">
                <?php get_template_part( 'layout/blog/blog-'.$blogstyle ); ?>
            </div>
            <?php if ( $lay == 'right' ) { ?>
                <?php get_sidebar(); ?>
            <?php } ?>
        </div>
    </div>
</div>

<?php
get_footer();
