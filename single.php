<?php get_header(); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<h1><?php the_title(); ?></h1>
	<?php the_content(); ?>
	<?php previous_post_link(); ?>
	<?php next_post_link(); ?>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>