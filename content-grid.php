<?php

/*
 * =========================================================
 *
 * Responsive Grid component
 * 2 or 3 column grid of posts from a single category 
 *
 * =========================================================
 */
	
	//config 

	$columns = "3"; 						// number of columns (2 or 3)
	$category= "1";							// category to loop through (category ID)
	$grid_title = "Responsive Grid Demo"; 	// Title to display above grid (optional)
	$cell_titles = TRUE; 					// Display post titles in each cell (TRUE or FALSE)
	$cells_per_page = "21"; 				// number of cells per page ("-1" for no pagination)



 /* ========================================================= */




	 // validate config options

	$error = "";

	if (($columns != 2) && ($columns != 3)) {
		$error .= "Please specify a valid number of columns (2 or 3)";
	}
	$columns = strval($columns); 

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
  	
	  	<section class="grid-component-wrapper <?php echo $columns;?>">
	  		
	  		<?php if ($grid_title): ?>	
	  			<h1 class="grid-title"><?php echo $grid_title; ?></h1>
		    <?php endif; ?>
		    
		    <ul class="grid-component">
				<?php
					$args = array(
						'category_name'      => $category,
						'posts_per_page'     => $posts_per_page 
					);
					query_posts( $args );
					if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>			
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
					<?php endwhile; endif; ?>
			</ul>
		</section>

	<?php endelse; ?>
