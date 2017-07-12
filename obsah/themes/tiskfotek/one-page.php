<?php 
/*
Template Name: One-Page Template
*/

require_once( 'layout/heads/custom-header.php'); 
while ( have_posts() ) : the_post();
  the_content();
endwhile;


get_footer(); ?>
