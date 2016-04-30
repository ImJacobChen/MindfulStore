<?php
/*
* This function gets all of a certain type of items for the homepage side scrollers
*
* @param   string  $product type  the product type
* @return  mixed   html to display on the homepage
*/
function get_side_scroller_list_html($type) {
    require(ROOT_PATH . "includes/database.php");

    try {
        $results = $db->prepare("SELECT img, sku FROM products WHERE type = ?");
        $results->bindParam(1, $type);
        $results->execute();
    } catch (Exception $e) {
        echo "Data could not be retrieved from the database.";
    }

    $products = $results->fetchAll(PDO::FETCH_ASSOC);

    $output = "";
    foreach ($products as $product) {
        $output .= "<a href='". BASE_URL ."product?id=" . $product['sku'] . "'><img src='" . BASE_URL . $product['img'] . "'/></a>";
    }

    return $output;
}

function get_list_view_html($product) {
    
    $output = "";

    $output = $output . '<li class="list-item">';
    $output = $output . '<a href="' . BASE_URL . 'product?id=' . $product["sku"] . '">';
    $output = $output . '<img src="' . BASE_URL . $product["img"] . '" alt="' . $product["name"] . '">';
    $output = $output . "<span class='item-info>";
    $output = $output . "<span class='item-title'><p>" . $product["name"] . "</p></span>";
    $output = $output . "<span class='item-price'><p>£" . $product["price"] . "</p></span>";
    $output = $output . "</span></a></li>";

    return $output;
}

function get_products_recent() {
    $recent = array();
    $all = get_products_all();

    $total_products = count($all);
    $position = 0;
    
    foreach($all as $product) {
        $position = $position + 1;
        if ($total_products - $position < 4) {
            $recent[] = $product;
        }
    }
    return $recent;
}

function get_products_search($s) {
    require(ROOT_PATH . "includes/database.php");
    $s=preg_replace('/[^a-z]/i','',$s);
    $search_term = "%{$s}%";

    try {
        $query = $db->prepare("SELECT * FROM products WHERE name LIKE ?");
        $query->bindParam(1, $search_term);
        $query->execute();
    } catch (Exception $e) {
        echo "Data could not be retrieved from the database.";
    }

    $results = $query->fetchAll(PDO::FETCH_ASSOC);

    return $results;
}

function get_products_count() {
    return count(get_products_all());
}

function get_products_all() {
    require(ROOT_PATH . "includes/database.php");

    try {
        $results = $db->query("SELECT name, price, img, sku, description FROM products");
    } catch (Exception $e) {
        echo "Data could not be retrieved from the database.";
        exit;
    }

    $products = $results->fetchAll(PDO::FETCH_ASSOC);

    return $products;
}

/*
 * Returns an array of product information for the product that matches the sku.
 * Returns a boolean false if no product matches the sku
 * @param   int    $sku    the sku
 * @return  mixed   array   list of product information for the matching product
 *                  bool    false if no matches
*/

function get_products_single($sku) {
    require(ROOT_PATH . "includes/database.php");

    try {
        $results = $db->prepare("SELECT name, price, img, sku, description FROM products WHERE sku = ?");
        $results->bindParam(1, $sku);
        $results->execute();
    } catch (Exception $e) {
        echo "Data could not be retrieved from the database.";
    }

    $product = $results->fetch(PDO::FETCH_ASSOC);

    return $product;
}