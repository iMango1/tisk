<?php $title = wp_title( '', false, '' ); ?>
    <div class="page-title title-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 lft-title center">
                    <div class="title-container">
                        <h1 class="main-bg fx" data-animate="fadeInDown">
                            <?php printf( __( 'Tag Archives: %s', 'twentyfourteen' ), single_tag_title( '', false ) ); ?>
                        </h1>
                        <?php
                            $term_description = term_description();
                            if ( ! empty( $term_description ) ) :
                                printf( '<h4 class="fx" data-animate="fadeInUp">%s</h4>', $term_description );
                            endif;
                        ?>
                    </div>
                </div>
                <?php if(function_exists('bcn_display')){ ?>
                    <div class="breadcrumbs alter-bg fx" data-animate="fadeInUp">
                    <?php bcn_display(); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
