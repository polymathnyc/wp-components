<?php

/*
 * =========================================================
 *
 * Custom Nav component
 * navigation bar with optional dropdown menus for child pages 
 *
 * =========================================================
 */
	

	// config options

	$child_menus = TRUE; 		// display child pages in dropdown menus (TRUE or FALSE)
	$exclude = ""; 					// pages to exclude from main menu  (post_ID)


 /* ========================================================= */


	
	//display the nav 

	?>
  	
		<nav class="custom-nav-component">
			
			<ul>
				
				<?php
				
				// get top level pages

				$pages = get_pages("title_li=&sort_order=ASC&sort_column=menu_order&parent=0");
				
				foreach($pages as $page):

					$page_status = "";
					
					$page_URL = get_permalink($page->ID);
					
					if (is_page("$page->post_title")){
						$page_status = 'active';
					}
					
					// check if current page has children

					$is_parent_page = FALSE; 

					$children = get_pages('child_of='.$page->ID);
					if ( (count($children) != 0) && ($child_menus == TRUE) ) {
						$is_parent_page = TRUE;
					}
					
					// display nav item and children

					if ($is_parent_page == TRUE):
									
						$args = array( 
						    'post_parent' => $page->ID,
						    'post_type'   => 'page', 
						    'numberposts' => -1,
						    'post_status' => 'publish',
	  					  	'orderby'     => 'menu_order',
							'order'       => 'ASC'				    

						);
					
						$children = get_children($args);

						// if one child is the current page, mark the parent as active
						foreach ($children as $child):
							if (is_page($child->post_title)){
								$page_status = "active";
							}
						endforeach;
					    
						?>

						<li class="<?php echo $page_status; ?>  custom-nav-parent">
							<a href="<?php echo $page_URL; ?>" class="custom-nav-parent-link"><?php echo $page->post_title; ?></a>
							<ul class=" custom-nav-subnav">
								
								<?php

								foreach ($children as $child):

									$child_URL = get_permalink($child->ID);
									
									$child_status = "";

									if (is_page($child->post_title)){
										$child_status = "active";
									} 

									?>
									
									<li class="<?php echo $child_status; ?>  custom-nav-child">
										<a href="<?php echo $child_URL; ?>"><?php echo $child->post_title;?></a>
									</li>

								<?php endforeach; ?>

							</ul>
						</li>
						
					<?php else: ?>

						<?php // display nav item (without children) ?>
						
 						<li class="<?php echo $page_status; ?> custom-nav-item">
							<a href="<?php echo $page_URL; ?>"><?php echo $page->post_title; ?></a>
						</li>
					
					<?php endif; ?> 
				
				<?php endforeach; ?>
			
			</ul>

		</nav>
