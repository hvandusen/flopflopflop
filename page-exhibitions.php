<?php get_header(); ?>
<style>
			.exhib{
				display:block;
			}
			.list {
				list-style: none;

			}
			#address{
			position: fixed;
    bottom: 0;
	}
			</style>


	    <div id='container'>
       	 <a href='/'><h1 id='title'>as it stands . la</h1></a><br>
	   	 <a href='/exhibitions/'><h1 id='exhibitions'>exhibitions</h1></a>
	   	 	<div id='content'>
					<ul class='list'>
					<?php
					$trackCategory = "";
					$args = array(
						'post_type'=> 'exhibition',
						'orderby'	=> 'menu_order',
						'order'    => 'ASC'
						//#drag and drop
					);
					query_posts( $args );
					//echo '<span class="title">' . the_title() . '</span>';

					while ( have_posts() ) : the_post();
					$start = strtolower(get_field('start_date'));
					$end = strtolower(get_field('end_date'));
							?>
								<a class='exhib'>
									<a href='<?php echo get_permalink(); ?>'><?php echo strtoupper(get_the_title()); ?></a>
									<?php echo $start . '-' . $end; ?>
								</a>
				<?php endwhile; ?>
				</ul>
	     	</div>




<?php get_footer(); ?>
