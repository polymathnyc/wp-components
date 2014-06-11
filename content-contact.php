<?php

/*
 * =========================================================
 *
 * Contact Form component
 *
 * =========================================================
 */
	
	/* TODO
	 * add form validation for required fields
	 * validate config options
	 * create captcha (may require session enabling in functions.php)
	 */

	// config options

	$to = "mail@andrewbowles.com"; 							// target email address
	$subject = "Mail from andrewbowles.com";    			// email subject line
	$headers = "From: Andrew Bowles Website contact Form"; 	// email header
	$thank = "Thank you for contacting us.";				// thank you message after form is submitted

	$form_title = "Contact Us"; 				// title to display above form (optional)
	$columns = "3"; 							// number of columns (2, 3 or 4)
	$text_inputs = array(
			array( 
			  "id" => "firstname", 				// will be used as input name and class attributes (spaces prohibited)
	    	  "label" => "First Name",			// label displayed to consumer
	    	  "required" => TRUE 				// field required to submit form (TRUE or FALSE)
	    	),
			array( 
			  "id" => "lastname", 				// will be used as input name and class attributes (spaces prohibited)
	    	  "label" => "Last Name",			// label displayed to consumer
	    	  "required" => TRUE 				// field required to submit form (TRUE or FALSE)
	    	),		
			array( 
			  "id" => "email", 					// will be used as input name and class attributes (spaces prohibited)
	    	  "label" => "Email",				// label displayed to consumer
	    	  "required" => TRUE 				// field required to submit form (TRUE or FALSE)
	    	),	    	
	 );
	$text_areas = array(
			array( 
			  "id" => "message", 				// will be used as input name and class attributes (spaces prohibited)
	    	  "label" => "Message",			// label displayed to consumer
	    	  "required" => TRUE 				// field required to submit form (TRUE or FALSE)
	    	)  	
	 );
	$submit_button_text = "SUBMIT"; 			// text to appear on form submit button


 /* ========================================================= */



	 // validate config options

	$error = "";

	// display errors

	if ($error): ?>
		
		<h2 class="error-message"><?php echo $error; ?></h2>
	
	<?php else: 

		// if form has been posted, analyze it

		if(isset($_POST['submit'])) :

			foreach ($_POST as $key => $value) {
				$msg .= ucfirst ($key) ." : ". $value . "\n";
			}
	
			// send email and display confirmation
	
			mail($to, $subject, $msg, $headers); 

		endif;

		// display form

		?>
  	
	  	<section class="contact-form-component">
	
	  		<?php if ($form_title): ?>	
	  			<h1 class="form-title"><?php echo $form_title; ?></h1>
		    <?php endif; ?>

			<form name= "contact-form" class="contact-form" method="post" action="">
					
				<?php foreach ($text_inputs as $input => $options): ?>
					
					<input type="text" 
						   	placeholder="<?php echo $options['label']; ?>" 
							name="<?php echo $options['id']; ?>" 
							class="<?php echo $options['id']; ?> <?php if ($options['required'] == TRUE){echo 'required';}?> " 
					/>
					<div class="TxtStatus hide"></div>

				<?php endforeach; ?>
			</textarea>
				<?php foreach ($text_areas as $textarea => $options): ?>
					
					<textarea placeholder="<?php echo $options['label']; ?>" 
								name="<?php echo $options['id']; ?>" 
								class="<?php echo $options['id']; ?> <?php if ($options['required'] == TRUE){echo 'required';}?>"
					></textarea>

					<div class="TxtStatus hide"></div>

				<?php endforeach; ?>

				<div class="TxtStatus hide"></div>
				<div class="QapTcha"></div>

				<input type="submit" name="contact-form-submit" class="contact-form-submit" value="<?php echo $submit_button_text;?>" />

			</form>

		</section>

	<?php endif; ?>
