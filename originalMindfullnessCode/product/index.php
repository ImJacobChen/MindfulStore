<?php 

require_once('../includes/init.php');

if (isset($_GET["id"])) {
	$product_id = intval($_GET["id"]);
	$product = get_products_single($product_id);
}

if (empty($product)) {
	header("Location: " . BASE_URL . "products/");
	exit();
}

include(ROOT_PATH . 'includes/partials/header.php'); 
?>
	<a href="<?php echo BASE_URL ?>products" class="back-to-products">
		<img src="<?php echo BASE_URL ?>images/circle-arrow-back.png">
		<p>Back to products</p>
	</a>
	<div class="name-and-price">
		<h3><?php echo $product["name"]; ?></h3>
		<h4>£<?php echo $product["price"]; ?></h4>
	</div>
	<div class="product-image">
		<img src="<?php echo BASE_URL . $product["img"]; ?>">
	</div>

	<form id="product-form">
		<div class="attribute-box attribute-box-left">Quantity: <select name="quantity" class="product-quantity form-field">
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="10">10</option>
		</select></div>
		<div class="attribute-box attribute-box-right"></div>

		<input name="product_sku" class="form-field" type="hidden" value="<?php echo $product["sku"] ?>">
		<button type="submit" id="add-to-basket">Add to Basket +</button>
	</form>
	

	<div id="accordion">
		<h3>Product Description</h3>
		<div class="description">
			<p><?php echo $product["description"] ?></p>
		</div>
		<h3>Delivery</h3>
		<div class="description">
			<p>UK Standard: £3.99 or FREE over £60! Delivered within 3-5 days
			<br><br>
			UK Next Day: £4.99 or FREE over £150! Order before 9pm Sunday to Friday, 8pm Saturday to receive the following day.
			<br><br>
			UK Next Day Evening: £7.99 - Order before midnight to receive your order between 6-10pm the following day | Place your order between midnight and 1am for same day delivery between 6pm and 10pm
			<br><br>
			International Standard: From £4.99. Delivered within 10 working days (Price dependent on Country)
			<br><br>
			International Tracked Express: From £8 - Delivered within 6 working days. Tracked service for orders outside EU (Price dependent on Country).</p>
		</div>

		<h3>Returns</h3>
		<div class="description">
			<p>Return your items to store for FREE (excluding our Dublin, Harrods,French & Italian stores).
			<br><br>
			If you are a UK customer then you’ll find a FREE returns sticker inside your package. Please put this on the outside of your unwanted item(s) when sending back. 
			<br><br>
			If you are a customer from outside the UK then please use a carrier that will give you a ‘Certificate of Postage’ as the package is your responsibility until we receive it. Please note, free returns is only valid to UK customers.
			<br><br>
			Please return your unwanted goods within 28 days of receipt for a full refund. We will however exchange any unwanted returns and re-send them without any further charge.</p>
		</div>
	</div>
			

		<?php include(ROOT_PATH . 'includes/partials/footer.php'); ?>	
	</div><!--End of Wrapper-->
	<script>
		// jQuery accordion function adds functionality to the item descriptions.
		$( "#accordion" ).accordion({
			heightStyle: 'content'
		});

		var form = document.getElementById('product-form');
		form.onsubmit = function(event) {
			var inputs = form.querySelectorAll('.form-field');		//Get form field elements
			qty = inputs[0].value;									//Get the value of the first input and set it to quantity
			sku = inputs[1].value									//Get the value of the second input and set it as the itemsku
			query = "qty=" + qty + "&sku=" + sku;					//Build a queryurl with these values
			if (window.XMLHttpRequest) {
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp = new XMLHttpRequest();
			} else {
				// code for IE6 IE5
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status === 200) {
					document.getElementById('shopping-cart-count').innerHTML = xmlhttp.responseText + ' Item(s)';
				}
			}
			xmlhttp.open("GET", "../includes/cart_process.php?" + query, true);
			xmlhttp.send();
			
			event.preventDefault();
		}
	</script>
</body>