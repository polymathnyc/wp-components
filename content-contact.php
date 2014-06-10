<?php

/*
 * =========================================================
 *
 * Contact Form component
 *
 * =========================================================
 */
	

	// config options

	$columns = "3"; 						// number of columns (2, 3 or 4)

	$text_inputs = (object) array(
	 'firstname' => (object) array(
	      'label' => 'First Name', 			// label displayed to consumer
	      'required' => 'TRUE'				// field required to submit form (TRUE or FALSE)
	  ),
	 'lastname' => (object) array(
	      'title' => 'Last Name',			// label displayed to consumer
	      'required' => 'TRUE'				// field required to submit form (TRUE or FALSE)
	  ),
	);

	$text_areas = (object) array(
	 'message' => (object) array(
	      'label' => 'Message',				// label displayed to consumer
	      'required' => 'TRUE'				// field required to submit form (TRUE or FALSE)
	  )
	);

	$submit_button_text = "SUBMIT"; 		// text to appear on form submit button


 /* ========================================================= */




	 // validate config options

	$error = "";



	// display errors

	if ($error): ?>
		
		<h2 class="error-message"><?php echo $error; ?></h2>
	
	<?php else: 

	//display the form 

	?>
  	
	  	<section class="contact-form-component">
	
			<h2 class="subtitle"></h2>

			<form id ="contactForm" name= "contactForm" class="contactform contactForm span8" method="post" action="">
				<fieldset class="short left">
					<input type="text" placeholder="Your Name" name="fullname" class="fullname" />
					<div class="TxtStatus hide"></div>
				</fieldset>
				<fieldset class="short right">
					<input type="text" placeholder="Your Email" name="email" class="email" />
					<div class="TxtStatus hide"></div>
				</fieldset>
				<fieldset class="long">
					<input type="text" placeholder="Subject" name="subject" />
				</fieldset>
				<textarea placeholder="Message" name="message" class="message"></textarea>
				<div class="TxtStatus hide"></div>
				<div class="spacer"></div>
				<div class="QapTcha"></div>
				<fieldset>
					<input type="submit" name='submitButton' class="submitButton" id="submitButton" value="send »" />
				</fieldset>
			</form>

		</section>

	<?php endif; ?>
