<?php if ( ! have_posts() ) : ?>
	<h1><?php _e( 'Not Found', 'chipsstarter' ); ?></h1>
	<p><?php _e( 'No results were found for the requested page.', 'chipsstarter' ); ?></p>
	<?php //get_search_form(); ?>
<?php endif; ?>

<?php while ( have_posts() ) : the_post(); ?>
	<h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( '%s', 'chipsstarter' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	<?php the_content(); ?>
	<?php //comments_popup_link( __( 'Leave a comment', 'chipsstarter' ), __( '1 Comment', 'chipsstarter' ), __( '% Comments', 'chipsstarter' ) ); ?>
	<?php //comments_template( '', true ); ?>
<?php endwhile; ?>

<?php if (  $wp_query->max_num_pages > 1 ) : ?>
	<?php next_posts_link(); ?>
	<?php previous_posts_link(); ?>
<?php endif; ?>