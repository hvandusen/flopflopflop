<?php get_header(); ?>
<a href='/'><h1 id='title'>as it stands . la</h1></a><br>
<a href='/exhibitions/'><h1 id='exhibitions'>exhibitions</h1></a>
<div id='content'>
<?php if ( have_posts() ) while ( have_posts() ) : the_post();
	$images = get_field('images');
		if(is_array($images) && !empty($images)){
		foreach($images as $image){
			$url = $image['image']['url'];
			?>

				<img class='exImage' src='<?php echo $url ?>'></img><br>
		<?php }
	}
	?>
</div>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>
