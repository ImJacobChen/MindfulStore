<?php

require_once("../includes/init.php");
include(ROOT_PATH . 'includes/partials/header.php'); 

?>
<ul class="search-results">
	<?php if(isset($_GET["q"])) { 
		$query = $_GET["q"];
		echo "<strong>Showing search results for: " . $query . "</strong>";
		$products = get_products_search($query);
		foreach ($products as $product) {
			echo '<li class="list-item">';
		    echo '<a href="' . BASE_URL . 'product?id=' . $product["sku"] . '">';
		    echo '<img src="' . BASE_URL . $product["img"] . '" alt="' . $product["name"] . '">';
		    echo "<div class='item'>";
		    echo "<span class='item-title'><h3>" . $product["name"] . "</h3></span>";
		    echo "<span class='item-price'>" . "£" . $product["price"] . "</span>";
		    echo "<span class='item-description'><p>" . $product["description"] . "</p></span>";
		    echo "</div></a></li>"; 
		}
	} ?>
</ul>
<?php include(ROOT_PATH . 'includes/partials/footer.php'); ?>