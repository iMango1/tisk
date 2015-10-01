<?php 
/*
Template Name: FullScreen Template
*/

require_once( 'layout/heads/fullscreen-header.php'); 
while ( have_posts() ) : the_post();
  the_content();
endwhile;


get_footer(); ?>
