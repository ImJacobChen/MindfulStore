<?php 
	require_once('../includes/init.php');
	include(ROOT_PATH . 'includes/partials/header.php'); 
	$cart = $_SESSION['cart'];
?>

<div class="checkout-progress">
	<ul>
		<li>
			<img class="checkout-complete" src="../images/icon-clipboard.png">
			<div>Details</div>
		</li>
		<li>
			<img class="checkout-in-progress" src="../images/icon-payment.png">
			<div>Payment</div>
		</li>
		<li>
			<img src="../images/icon-checkered-flag.png">
			<div>Finish</div>
		</li>
	</ul>
</div><!--End of checkout-progress-->

<div class="error-holder">
</div><!--End of error-holder-->

<div class="checkout-main">
</div><!--End of checkout-main-->