<?php
get_header();
global $wp_query;
$curauth = $wp_query->get_queried_object(); 
$auth_info = theme_option('show_auth_info');
$auth_posts = theme_option('show_auth_posts');
$posts_style = theme_option('auth_posts_style');
$content_before = theme_option('auth_content_before');
$content_after = theme_option('auth_content_after');

$col = '';
$lay = theme_option('blog_sidebar');

if($lay == 'right' || $lay == 'left'){
    $col = '9';
}else{
    $col = '12';
}

get_template_part( 'layout/page-titles/title-author');
?>

<div class="lg-padding">
    <div class="container">
        <div class="row">
            <?php if ( $lay == 'left' ) { ?>
                <?php get_sidebar(); ?>
            <?php } ?>
            <div class="col-md-<?php echo $col; ?>">
                <?php if($content_before != ''){ ?>
                    <div class="padd-bottom-30">
                        <?php echo wp_kses($content_before,it_allowed_tags()); ?>
                    </div>
                <?php } ?>
                <?php if($auth_info == '1'){ ?>
                <h3 class="block-head"><?php echo __('About Author','itrays') ?></h3>
                <?php if($curauth->description != ''){ ?>
                <div class="padd-bottom-30">
                    <?php echo $curauth->description; ?>
                </div>
                <?php } ?>
                <div class="padd-bottom-40">
                   <div class="my-img">
                            <div class="my-details">
                                <?php echo get_avatar(get_the_author_meta('user_email', $curauth->post_author), 150); ?>
                                <h4 class="bold main-color my-name fx" data-animate="slideInDown"><?php echo $curauth->first_name; ?> <?php echo $curauth->last_name; ?> <small>(<?php  echo $curauth->nickname; ?>)</small></h4>
                                <ul class="list alt list-bookmark col-md-4">
                                    <li class="fx" data-animate="slideInDown"><b><?php echo __('Email: ','itrays') ?></b><?php echo $curauth->user_email; ?></li>
                                    <li class="fx" data-animate="slideInDown" data-animation-delay="100"><b><?php echo __('Nice Name: ','itrays') ?></b><?php echo $curauth->user_nicename; ?></li>
                                    <li class="fx" data-animate="slideInDown" data-animation-delay="200"><b><?php echo __('Website: ','itrays') ?></b><?php echo $curauth->user_url; ?></li>
                                </ul>
                                <ul class="list alt list-bookmark col-md-4">
                                    <li class="fx" data-animate="slideInDown" data-animation-delay="300"><b><?php echo __('Registered On :','itrays') ?></b><?php echo $curauth->user_registered; ?></li>
                                    <li class="fx" data-animate="slideInDown" data-animation-delay="400"><b><?php echo __('Logged in at: ','itrays') ?></b><?php echo $curauth->user_login; ?></li>
                                    <li class="fx" data-animate="slideInDown" data-animation-delay="500"><b><?php echo __('Author ID: ','itrays') ?></b><?php echo $curauth->ID; ?></li>
                                </ul>
                            </div>
                        </div>
                </div>
                <?php } ?>
                <?php if($auth_posts == '1'){ ?> 
                    <?php if ( have_posts() ) : ?>
                        <h3 class="block-head"><?php echo __('Author Posts','itrays') ?></h3>
                        <div class="blog-posts" id="content">
                            <?php get_template_part( 'layout/blog/blog-'.$posts_style) ?>
                        </div>
                        <?php else: 
                        the_content;
                        endif; ?>
                    <div class="clearfix"></div>
                    <?php it_paging_nav(); ?>
                <?php } ?>
                <?php if($content_after != ''){ ?>
                    <div class="padd-top-30">
                        <?php echo wp_kses($content_after,it_allowed_tags()); ?>
                    </div>
                <?php } ?>
            </div>
            <?php if ( $lay == 'right' ) { ?>
                <?php get_sidebar(); ?>
            <?php } ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>