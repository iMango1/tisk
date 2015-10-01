<?php
    $cust_title = get_post_meta(c_page_ID(),'chck_custom_title',true);
    $cust_title_overlay = get_post_meta(c_page_ID(),'title_bg_overlay',true);
    $chck_video_bg = get_post_meta(c_page_ID(),'chck_video_bg',true);
    $video_mp4 = get_post_meta(c_page_ID(),'video_mp4',true);
    $video_webm = get_post_meta(c_page_ID(),'video_webm',true);
    $video_ogv = get_post_meta(c_page_ID(),'video_ogv',true);
    $cust_title_txt = get_post_meta(c_page_ID(),'custom_title_txt',true);
    $it_page_title = '';
    $subtitl_text = '';
    if($cust_title == '1'){
       if ($cust_title_txt != ''){
           $it_page_title = esc_html($cust_title_txt);  
        }else{
            $it_page_title = it_custom_page_title();
        }
       $subtitl_text = '<h3 class="sub-title fx" data-animate="fadeInUp">'.esc_html(get_post_meta(c_page_ID(),'custom_subtitle',true)).'</h3>'; 
    }else{
       $it_page_title = it_custom_page_title(); 
    }
?>
<div class="page-title title-7">
    <?php
    if($cust_title == '1' && $chck_video_bg == '1'){
        ?>
        <div id="title_video" class="title_video_bg"></div>
        <script type="text/javascript">
            jQuery(document).ready(function() {
                jQuery('#title_video').videoBG({
                    mp4:'<?php echo esc_url($video_mp4); ?>',
                    ogv:'<?php echo esc_url($video_ogv); ?>',
                    webm:'<?php echo esc_url($video_webm); ?>',
                    scale:false,
                    zIndex:1
                });
            });
        </script>
        <?php  
    }
    ?>
    <?php
    if($cust_title == '1' && isset($cust_title_overlay)){
        ?>
        <div class="title-overlay"></div>
        <?php  
    }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12 lft-title center">
                <div class="title-container">
                    <div class="tbl">
                        <div class="tbl"><i class="fa page-icon <?php it_page_title_icon(); ?> main-bg fx" data-animate="fadeInLeft"></i>
                        <h1 class="fx main-bg" data-animate="fadeInRight"><?php echo $it_page_title; ?></h1></div>
                        <?php echo $subtitl_text; ?>
                    </div>
                </div>
            </div>
            <?php if(function_exists('bcn_display')){ ?>
                <div class="breadcrumbs main-bg fx" data-animate="fadeInUp">
                <?php bcn_display(); ?>
                </div>
            <?php } ?>
            <?php echo it_wo_cart(); ?>
        </div>
    </div>
</div>

