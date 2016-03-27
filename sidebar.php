<?php
	/* Override WP default Sidebar */
?>
<ul class="sidebar">
<?php
if ( ! dynamic_sidebar( 'primary-widget-area' ) ) : ?>
	<li><?php get_search_form(); ?></li>
	<li>
		<h3><?php _e( 'Archives', 'chipsstarter' ); ?></h3>
		<ul>
			<?php wp_get_archives( 'type=monthly' ); ?>
		</ul>
	</li>
<?php endif; // end primary widget area ?>
</ul>