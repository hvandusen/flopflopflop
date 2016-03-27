<?php get_header(); ?>


       	 <a href='/'><h1 id='title'>as it stands . la</h1></a><br>
	   	 <a href='/exhibitions/'><h1 id='exhibitions'>exhibitions</h1></a>
	   	 	<div id='content'>
		        <br><br>
						<div class='upcoming'><?php the_field('main_text');?></div>
						<?php $img = get_field('main_image');?>
	       <img class="poster" src="<?php echo $img['sizes']['large']; ?>" alt='as it stands la gallery anja solonen'></img>
	     </div>
	     




<?php get_footer(); ?>
