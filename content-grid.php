<?php

/*
 * =========================================================
 *
 * Responsive Grid component
 * 2, 3 or 4 column grid of posts from a single category 
 *
 * =========================================================
 */
	

	// config options

	$columns = "3"; 							// number of columns (2, 3 or 4)
	$category= "2";								// category to loop through (category ID)
	$grid_title = "Responsive Grid Component"; 	// Title to display above grid (optional)
	$cell_titles = TRUE; 						// Display post titles in each cell (TRUE or FALSE)
	$pagination = TRUE; 						// Display pagination at bottom of grid (TRUE or FALSE)
	$cells_per_page = "5"; 						// number of cells per page ("-1" for no pagination)


 /* ========================================================= */



	 // validate config options

	$error = "";

	if (($columns != 2) && ($columns != 3) && ($columns != 4)) {
		$error .= "Please specify a valid number of columns (2, 3 or 4)";
	} 

	$term = term_exists(get_category($category)->name, 'category');
	if ($term == 0 || $term == null) {
		$error .= "Please specify a valid Category ID";
	}


	// display errors

	if ($error): ?>
		
		<h2 class="error-message"><?php echo $error; ?></h2>
	
	<?php else: 

	//display the grid 

	?>
  	
	  	<section class="grid-component-wrapper col-<?php echo $columns;?>">
	  		
	  		<?php if ($grid_title): ?>	
	  			<h1 class="grid-title"><?php echo $grid_title; ?></h1>
		    <?php endif;
				
				// query posts

				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$args = array(
					'category' => $category,
					'posts_per_page' => $cells_per_page,
					'paged' => $paged
				);
				query_posts( $args );
				if ( have_posts() ) : ?>
	    			
	    			<ul class="grid-component">

	    				<?php

						// loop through grid cells

						while ( have_posts() ) : the_post(); ?>			
					        <li>
					            <?php if ( has_post_thumbnail() ) : ?>
						            <a href="<?php the_permalink();?>">
						              <?php the_post_thumbnail(); ?>
						            </a>
						        <?php endif; ?>
					            <?php if ( $cell_titles == TRUE ) : ?>
							    <h2> 
					              	<a href="<?php the_permalink();?>"><?php the_title();?></a>
					            </h2>
						        <?php endif; ?>
					         </li>
						<?php endwhile; ?>

					</ul>

					<?php

					// pagination

					if ($pagination == TRUE): ?>

						<div class="grid-pagination">

							<?php 
	
							$big = 999999999; // need an unlikely integer
							
							echo paginate_links( array(
								'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
								'format' => '?paged=%#%',
								'current' => max( 1, get_query_var('paged') ),
								'total' => $wp_query->max_num_pages
							) );
	
							?>

						</div>
					
					<?php endif; 

				endif; ?>

		</section>

	<?php endif; ?>
