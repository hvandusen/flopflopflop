<?php 
/* Template for displaying Search Results pages. */
get_header(); ?>

<?php if ( have_posts() ) : ?>
	<h1><?php printf( __( 'Search Results for: %s', 'chipsstarter' ), '' . get_search_query() . '' ); ?></h1>
	<?php get_template_part( 'loop', 'search' ); ?>
<?php else : ?>
	<h2>No results</h2>
	<p>There are no results</p>
	<?php get_search_form(); ?>
<?php endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
