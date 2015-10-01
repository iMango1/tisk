<?php $title = wp_title( '', false, '' ); ?>
    <div class="page-title title-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 lft-title center">
                    <div class="title-container">
                        <h4 class="fx" data-animate="fadeInDown">
                        <?php
                            if ( is_day() ) :
                                printf( __( 'Daily Archives', 'itrays' ), get_the_date() );

                            elseif ( is_month() ) :
                                printf( __( 'Monthly Archives', 'itrays' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'itrays' ) ) );

                            elseif ( is_year() ) :
                                printf( __( 'Yearly Archives', 'itrays' ), get_the_date( _x( 'Y', 'yearly archives date format', 'itrays' ) ) );

                            else :
                                _e( 'Archives', 'itrays' );

                            endif;
                        ?>
                        </h4>
                        <h1 class="main-bg fx" data-animate="fadeInUp">
                            <?php
                               if ( is_day() ) :
                                    echo the_time('l, F j, Y');
                                elseif ( is_month() ) :
                                    echo the_time('F Y');
                                elseif ( is_year() ) :
                                    echo the_time('Y');
                                else :
                                    echo single_cat_title( '', false );

                                endif; 
                            ?>
                        </h1>
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

