<?php 
	require_once('../includes/init.php');
	include(ROOT_PATH . 'includes/partials/header.php'); 
	$cart = $_SESSION['cart'];
?>

<div class="signin-main">
	<div class="error-holder"></div>
	<form class="sign-in">
		<label>Email: </label><input class="signin-email" type="text" name="email">
		<br>
		<input type="radio" name="signin-type" value="new-customer" checked="checked"> I am a new customer (You will create a password later).
		<br>
		<br>
		<input type="radio" name="signin-type" value="existing-customer"> 

		I am an existing customer and my password is: 
		<input class="signin-password" type="password" name="password">

		<input class="signin-submit" type="submit" value="Go">
	</form>
</div><!--End of checkout-main-->

<script type="text/javascript">
   /*
	*	This script will collect the form user data and then 
	*	append the address details form via ajax
	*	on success.
	*/
	var signInForm = $('.sign-in');
	signInForm.on('submit', function(e){
		e.preventDefault();
		var details = signInForm.serialize();
		$.post('../includes/checkout_processes/checkoutProcess.php', details, function(data) {
			try {									//Try and parse JSON Data
				var newData = $.parseJSON(data);	//Add JSON data to newData
			} catch(error) {
			}
			if (typeof newData != "undefined") {			//If newData exists (the newData if it exists is an error message)
				$('.error-holder').append(newData.error);	//Append the data to error-message
			} else {										//Else
				$('.checkout-main').html(data);				//Add the recieved data to the main body
			}
		}).fail(function(){
			$('.checkout-main').append('We could not process your request, please try again.');
		});
	});
</script>

<?php include (ROOT_PATH . 'includes/partials/footer.php'); ?>