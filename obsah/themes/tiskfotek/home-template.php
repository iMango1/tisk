<?php get_header(); 

/*
Template Name: Home Page Template
*/ 

while ( have_posts() ) : the_post();
the_content();
endwhile;
?>

<?php get_footer(); ?>