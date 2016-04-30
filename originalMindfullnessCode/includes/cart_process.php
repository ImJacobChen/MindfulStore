<?php
include 'config.php';
include 'database.php';
include 'classes/ShoppingCart.php';
include 'classes/item.php';
session_start();


if (isset($_GET['sku'])) {	# If the itemsku get variable is set
	$sku = $_GET['sku'];	# set the value to the variable $sku
	
	try {	# Try a database query to find the item with the supplied sku.
		$statement = $db->prepare("SELECT sku, name, price, img FROM products WHERE sku = ? LIMIT 1");
		$statement->bindParam(1, $sku);
		$statement->execute();
		$product = $statement->fetch(PDO::FETCH_ASSOC);
	} catch (Exception $e) {
		echo "Error connecting to the database";
		die();
	}

	$name = str_replace(' ', '', $product['name']);											  // Remove whitespace from the product name so its all 1 word
	$$name = new Item($product['sku'], $product['name'], $product['price'], $product['img']); // Create a new item instance with the db returned data
	$_SESSION['cart']->addItem($$name);														  // Add that item to the session basket
	echo $_SESSION['cart']->count();														  // Return the total items count for the xml request
}

if (isset($_GET['qty']) && isset($_GET['sku'])) {		// If is set item qty and sku
	$qty = intval($_GET['qty']);						// Make sure qty is a number
	$item = intval($_GET['sku']);						// Make sure sku is a number
	if (!isset($qty)) {									// If qty is not not set
		exit();											// Exit
	} else {											// Else
		$cart = $_SESSION['cart'];	
		$cart->updateItem($item, $qty);					// Update Cart
	}
}
if (isset($_GET['qty']) && isset($_GET['item'])) {
	$qty = intval($_GET['qty']);
	$item = intval($_GET['item']);
	if (!isset($qty)) {
		exit();
	} else {	
		$cart = $_SESSION['cart'];
		$cart->updateItem($item, $qty);
		$output = "";
		$subtotal = 0;	
		if (!$cart->isEmpty()) {
			foreach ($cart as $arr) {
				$item = $arr['item'];
				$output .= "<li class='basket-item'>";
				$output .= "<img src='" . BASE_URL . $item->getImg() . "'>";
				$output .= "<div>" . "<span><strong>" . $item->getName() . "</strong></span>";
				$output .= "<span class='basket-price'>" . $arr['qty'] . " @ " . "£" . $item->getPrice() . "</span>";
				$output .= "<span class='basket-edit'><form class='edit-item'>Qty:<input class='basket-qty' type='text' value=" 
						. $arr['qty'] . "><input class='basket-delete' type='button' value='Delete'><input type='hidden' class='basket-item-name' value='" 
						. $item->getId() . "'></form></span>";
				$output .= "</div></li>";
			}
			foreach ($cart as $arr) {
				$item = $arr['item'];
				$subtotal += $item->getPrice() * $arr['qty'];
			}
			echo json_encode(array("cart" => $output, "subtotal" => $subtotal));
		} 
	}
}

// Function to delete an item from the cart on request and send back updated data
if (isset($_GET['deleteitem'])) {			// If the deleteitem get request is set
	$itemId = $_GET['deleteitem'];	
	$cart = $_SESSION['cart'];
	$cart->deleteItem($itemId);				// Delete the item with the supplied id
	$output = "";
	if (!$cart->isEmpty()) {				// If the cart is not empty
		foreach ($cart as $arr) {			// Loop through the cart items
			$item = $arr['item'];
			// Populate $output with the updated cart html
			$output = "<li class='basket-item'>";
			$output .= "<img src='" . BASE_URL . $item->getImg() . "'>";
			$output .= "<div>" . "<span><strong>" . $item->getName() . "</strong></span>";
			$output .= "<span class='basket-price'>" . $arr['qty'] . " @ " . "£" . $item->getPrice() . "</span>";
			$output .= "<span class='basket-edit'><form class='edit-item'>Qty:<input class='basket-qty' type='text' value=" 
					. $arr['qty'] . "><input class='basket-delete' type='button' value='Delete'><input type='hidden' class='basket-item-name' value='" 
					. $item->getId() . "'></form></span>";
			$output .= "</div></li>";
		}
	}
	echo json_encode(array("cart" => $output, "itemcount" => $cart->count()));  // Send the updated cart html to the page along with the new cart count.
}