<?php

/*
 * =========================================================
 *
 * Contact Form component
 *
 * =========================================================
 */
	
	/* TODO
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

	// display config errors

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
					
				<?php $input_count = 1; ?>

				<?php foreach ($text_inputs as $input => $options): ?>
					
					<fieldset class="narrow">
						<input type="text" 
							   	placeholder="<?php echo $options['label']; ?>" 
								name="<?php echo $options['id']; ?>" 
								class="<?php echo $options['id']; ?> <?php if ($options['required'] == TRUE){echo 'required';}?> " 
						/>
						<div class="error-message"></div>
					</fieldset>

					<?php 
						if ($input_count % 2 == 0){ 
							echo "<div class='contact-form-clear'></div>";
						}
						$input_count++;
					?>
				<?php endforeach; ?>
			</textarea>
				<?php foreach ($text_areas as $textarea => $options): ?>
					
					<fieldset class="wide">
						<textarea placeholder="<?php echo $options['label']; ?>" 
									name="<?php echo $options['id']; ?>" 
									class="<?php echo $options['id']; ?> <?php if ($options['required'] == TRUE){echo 'required';}?>"
						></textarea>
						<div class="error-message"></div>
					</fieldset>

				<?php endforeach; ?>

				<div class="error-message"></div>
				<div class="QapTcha"></div>

				<input type="submit" name="contact-form-submit" class="contact-form-submit" value="<?php echo $submit_button_text;?>" />

			</form>

		</section>

	<?php endif; 



 /* ========================================================= */

	/* 
	 * Form validation 
	 * requires jQuery
	 * should be moved into footer.php upon implementation
	 */ 

	?>

	<script type="text/javascript">

		$(document).ready(function(){
		
			//$('.QapTcha').QapTcha();

			var contactform = $('.contact-form');
			var submitButton = $('.contact-form-submit');
			var error = false;
			var required = 'This field is required';

			$('.contactform').on('change', '.error', function () {
				$(this).removeClass('error').next('.error-message').fadeOut();
				error = false;
			});
			
			submitButton.click(function(e){
			 	e.preventDefault();
				
				if ( $(".submit").is(":disabled")) {

					// slider hasn't been completed; do nothing
				 
				} else {

				 	$(".contact-form .required").each(function(){
				 		var inputValue = this.value;
						if (inputValue == null || inputValue == "") {
							$(this).addClass('error').css('border-color','red').next('.error-message').html(required).fadeIn();
							error = true;
						}
					});

					//submit form
				 	if (error == false){
				 		contactform.submit();				 
				 	}

				}
				
			});

			$(".contact-form .required").blur(function(){
				$(this).css('border-color','#CCC').next('.error-message').fadeOut();	
				error = false;
			});

		});

	</script>
