<?php 
	require_once('../includes/init.php');
	include(ROOT_PATH . 'includes/partials/header.php'); 
	$cart = $_SESSION['cart'];
?>
	<div class="main">
		<ul id="basket">
			<?php if (!$cart->isEmpty()) {
				foreach ($cart as $arr) {
					$item = $arr['item'];
					$output = "<li class='basket-item'>";
					$output .= "<img src='" . BASE_URL . $item->getImg() . "'>";
					$output .= "<div>" . "<span><strong>" . $item->getName() . "</strong></span>";
					$output .= "<span class='basket-price'>" . $arr['qty'] . " @ " . "£" . $item->getPrice() . "</span>";
					$output .= "<span class='basket-edit'><form class='edit-item'>Qty:<input class='basket-qty' type='text' value=" 
							. $arr['qty'] . "><input class='basket-delete' type='button' value='Delete'><input type='hidden' class='basket-item-name' value='" 
							. $item->getId() . "'></form></span>";
					$output .= "</div></li>";
					echo $output;
				}
			} ?>
		</ul>
	</div>

	<div id="basket-subtotal"><strong>Basket Subtotal: </strong><?php 
		$subtotal = 0;
		foreach ($cart as $arr) {
			$item = $arr['item'];
			$subtotal += $item->getPrice() * $arr['qty'];
		}
		echo "£" . $subtotal;
	?></div>

	<a class="checkout-button" href="<?php echo BASE_URL ?>checkout"><button type="submit" class="checkout-button">Proceed to Checkout</button></a>



<?php include (ROOT_PATH . 'includes/partials/footer.php'); ?>

<script type="text/javascript">
	/*
	* Function to add event listeners to the delete buttons which deletes
	* the selected item from the cart and then updates the page to reflect that.
	*/
	function removeItem() {
		var deleteButtons = document.querySelectorAll('.basket-delete');// Get all the delete buttons
		for (i=0; i<deleteButtons.length; i++) {						// Loop through all delete buttons
			deleteButtons[i].addEventListener('click', function() {		// Add a 'click' event listener to each button
				var item = this.nextElementSibling.value;				// Get the next sibling value which = the item code
				if (window.XMLHttpRequest) {	
					// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp = new XMLHttpRequest();
				} else {
					// code for IE6 IE5
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status === 200) {
						var data = JSON.parse(xmlhttp.responseText);											// Store parsed JSON data in var data
						document.getElementById('basket').innerHTML = data.cart;								// Set the basket HTML to the 'cart' response data
						document.getElementById('shopping-cart-count').innerHTML = data.itemcount + ' Item(s)'; // Set the Cart count to the response item count
						removeItem();																			// Recall the remove item function to reset the event listeners on new html
					}
				}
				xmlhttp.open("GET", "../includes/cart_process.php?deleteitem=" + item, true);
				xmlhttp.send();
			}, false);
		}
	}
	
	/*
	* This function will update the individual item quantitys on blur(unfocused) and then
	* Update the cart with the new html and also update the subtotal on the page aswell.
	*/
	function updateQuantity() {
		var quantityBoxes = document.querySelectorAll('.basket-qty');
		for (i=0; i<quantityBoxes.length; i++) {
			quantityBoxes[i].addEventListener('blur', function() {
				var item = this.nextElementSibling.nextElementSibling.value;
				var qty = this.value;
				if (window.XMLHttpRequest) {	
					// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp = new XMLHttpRequest();
				} else {
					// code for IE6 IE5
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status === 200) {
						var data = JSON.parse(xmlhttp.responseText);
						document.getElementById('basket').innerHTML = data.cart;
						document.getElementById('basket-subtotal').innerHTML = "<strong>Basket Subtotal: </strong>" + '£' + data.subtotal;
						updateQuantity();																
					}
				}
				xmlhttp.open("GET", "../includes/cart_process.php?qty=" + qty + "&item=" + item, true);
				xmlhttp.send();
			}, false)
		}
	}
	removeItem();
	updateQuantity();
</script>
</body>