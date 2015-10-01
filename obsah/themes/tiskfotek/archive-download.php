<?php 
get_header(); 
$wid;
if ( theme_option('show_sidebar_edd') == "1" ){
    $wid = 9;
}else{
    $wid = 12;
}
$col = theme_option('columns_edd');

// page title function.
it_title_style();
?>
<div class="md-padding">
    <div class="container">
        <div class="row">
		    <?php if ( theme_option('show_sidebar_edd') == "1" ) : ?>
                <?php if ( theme_option('sidebar_position_edd') == "left" ) : ?>
                    <aside class="sidebar col-md-3">
                        <ul class="sidebar_widgets">
                            <?php dynamic_sidebar( 'sidebar-edd' ); ?>
                        </ul>
                    </aside>
                <?php endif; ?>
            <?php endif; ?>
            <div class="col-md-<?php echo $wid; ?>">
                
                    <?php if (have_posts()) : $i = 1; ?>
			           <div class="downloads-list">
					    <?php while (have_posts()) : the_post(); ?>
			    
						    <div class="col-md-<?php echo $col; ?> fx shop-item" data-animate="fadeInUp">
							    <div class="item-box">
                                    <a class="pro zooms" href="<?php esc_url(the_permalink()); ?>"><i class="fa fa-link"></i></a>
                                    <h3 class="item-title"><a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a></h3>
                                    <div class="item-img">
                                        <a href="<?php esc_url(the_permalink()); ?>">
                                            <?php the_post_thumbnail('product-image'); ?>
                                        </a>
                                    </div>
                                    <div class="item-details">
                                    <p><?php echo it_excerpt() ?></p>
                                    </div>
                                    
                                    <div class="item-bottom down">
                                    
                                        <?php if(function_exists('edd_price')) { ?>
                                                <div class="right">
                                                <?php if(function_exists('edd_price')) { ?>
                                                   
                                                    <?php 
                                                        if(edd_has_variable_prices(get_the_ID())) {
                                                            echo __('Starting at: ','itrays'); edd_price(get_the_ID());
                                                        } else {
                                                            ?>
                                                            <div class="item-price">
                                                            <?php
                                                            edd_price(get_the_ID());
                                                            ?>
                                                            </div> 
                                                            <?php
                                                        }
                                                    ?>
                                                     
                                            <?php } ?>
                                                </div>
                                                
                                                <div class="left">
                                                  <?php if(!edd_has_variable_prices(get_the_ID())) { ?>
                                                    <?php echo edd_get_purchase_link(get_the_ID(), __('Add to Cart','itrays'), 'button'); ?>
                                                <?php } ?>
                                                </div>
                                                
                                                
                                            
                                        <?php } ?>
                                    
                                    </div>
                                </div>
                                </div>
						    <?php $i+=1; ?>

					    <?php endwhile; ?>
			            </div>
                        <div class="clearfix"></div>
					    <?php edd_paging(); ?>
			    
				    <?php else : ?>
			                <div class="not-found">
                                <h2 class="hint"><?php echo __('Not Found','itrays'); ?></h2>
                                <hr class="hr-style3">
                                <p><?php echo __('Sorry, but you are looking for something that is not here.','itrays'); ?></p>
                                <hr class="hr-style3">
                                <div class="srch-box-page"><?php get_search_form(); ?></div>
                                
                                <a class="btn btn-large main-bg" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo __('Back To Home Page','itrays'); ?></a>        
                            </div>
			    
				    <?php endif; ?>
                    
			</div>
            <?php if ( theme_option('show_sidebar_edd') == "1" ) : ?>
                <?php if ( theme_option('sidebar_position_edd') == "right" ) : ?>
                    <aside class="sidebar col-md-3">
                        <ul class="sidebar_widgets">
                            <?php dynamic_sidebar( 'sidebar-edd' ); ?>
                        </ul>
                    </aside>
                <?php endif; ?>
            <?php endif; ?>								
			</div>
		</div>		
	</div>

<?php get_footer(); ?>
