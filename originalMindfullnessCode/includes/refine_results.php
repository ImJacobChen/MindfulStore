<?php 
include('database.php');
include('config.php');
if (!empty($_GET)) {
    $query = "";
    
    if (isset($_GET['t1']) && (isset($_GET['minprice']) || isset($_GET['maxprice']))) { //If a refine type and price param is set
        //If the type 1 is set grab it and prepare the query, then check if prices are set, if so add them to the query too.
        if (isset($_GET['t1'])) {
            $t[1] = $_GET['t1'];
            $type1 = "'%{$t[1]}%'";
            $query .= "(SELECT * FROM products WHERE type LIKE " . $type1 . ")";
            if (isset($_GET['minprice'])) {
                $minprice = $_GET['minprice'];
                $query = substr_replace($query, " AND price >= " . $minprice . ")", strlen($query)-1);
            }
            if (isset($_GET['maxprice'])) {
                $maxprice = $_GET['maxprice'];
                $query = substr_replace($query, " AND price <= " . $maxprice . ")", strlen($query)-1);
            }
        }
        //If the type 2 is set grab it and prepare the query, then check if prices are set, if so add them to the query too.
        if (isset($_GET['t2'])) {
            $t[2] = $_GET['t2'];
            $type2 = "'%{$t[2]}%'";
            $query .= " UNION (SELECT * FROM products WHERE type LIKE " . $type2 . ")";
            if (isset($_GET['minprice'])) {
                $minprice = $_GET['minprice'];
                $query = substr_replace($query, " AND price >= " . $minprice . ")", strlen($query)-1);
            }
            if (isset($_GET['maxprice'])) {
                $maxprice = $_GET['maxprice'];
                $query = substr_replace($query, " AND price <= " . $maxprice . ")", strlen($query)-1);
            }
        }
        //If the type 3 is set grab it and prepare the query, then check if prices are set, if so add them to the query too.
        if (isset($_GET['t3'])) {
            $t[3] = $_GET['t3'];
            $type3 = "'%{$t[3]}%'";
            $query .= " UNION (SELECT * FROM products WHERE type LIKE " . $type3 . ")";
            if (isset($_GET['minprice'])) {
                $minprice = $_GET['minprice'];
                $query = substr_replace($query, " AND price >= " . $minprice . ")", strlen($query)-1);
            }
            if (isset($_GET['maxprice'])) {
                $maxprice = $_GET['maxprice'];
                $query = substr_replace($query, " AND price <= " . $maxprice . ")", strlen($query)-1);
            }
        }
        //If the type 4 is set grab it and prepare the query, then check if prices are set, if so add them to the query too.
        if (isset($_GET['t4'])) {
            $t[4] = $_GET['t4'];
            $type4 = "'%{$t[4]}%'";
            $query .= " UNION (SELECT * FROM products WHERE type LIKE " . $type4 . ")";
            if (isset($_GET['minprice'])) {
                $minprice = $_GET['minprice'];
                $query = substr_replace($query, " AND price >= " . $minprice . ")", strlen($query)-1);
            }
            if (isset($_GET['maxprice'])) {
                $maxprice = $_GET['maxprice'];
                $query = substr_replace($query, " AND price <= " . $maxprice . ")", strlen($query)-1);
            }
        }
    } elseif (isset($_GET['minprice']) || isset($_GET['maxprice'])) { //if a from price or to price is set
        $query .= "SELECT * FROM products";
        if (isset($_GET['minprice']) && isset($_GET['maxprice'])) { //if a from price and to price is set
            $query .= " WHERE price >= " . $_GET['minprice'] . " AND price <= " . $_GET['maxprice'];
        }
        elseif (isset($_GET['minprice'])) {                         //if a from price is set
            $query .= " WHERE price >= " . $_GET['minprice'];
        } elseif (isset($_GET['maxprice'])) {                        //if a to price is set
            $query .= " WHERE price <= " . $_GET['maxprice'];
        }
    } else {
        //If the type 1 is set grab it and prepare the query, then check if prices are set, if so add them to the query too.
        if (isset($_GET['t1'])) {
            $t[1] = $_GET['t1'];
            $type1 = "'%{$t[1]}%'";
            $query .= "(SELECT * FROM products WHERE type LIKE " . $type1 . ")";
            if (isset($_GET['minprice'])) {
                $minprice = $_GET['minprice'];
                $query = substr_replace($query, " AND price >= " . $minprice . ")", strlen($query)-1);
            }
            if (isset($_GET['maxprice'])) {
                $maxprice = $_GET['maxprice'];
                $query = substr_replace($query, " AND price <= " . $maxprice . ")", strlen($query)-1);
            }
        }
        //If the type 2 is set grab it and prepare the query, then check if prices are set, if so add them to the query too.
        if (isset($_GET['t2'])) {
            $t[2] = $_GET['t2'];
            $type2 = "'%{$t[2]}%'";
            $query .= " UNION (SELECT * FROM products WHERE type LIKE " . $type2 . ")";
            if (isset($_GET['minprice'])) {
                $minprice = $_GET['minprice'];
                $query = substr_replace($query, " AND price >= " . $minprice . ")", strlen($query)-1);
            }
            if (isset($_GET['maxprice'])) {
                $maxprice = $_GET['maxprice'];
                $query = substr_replace($query, " AND price <= " . $maxprice . ")", strlen($query)-1);
            }
        }
        //If the type 3 is set grab it and prepare the query, then check if prices are set, if so add them to the query too.
        if (isset($_GET['t3'])) {
            $t[3] = $_GET['t3'];
            $type3 = "'%{$t[3]}%'";
            $query .= " UNION (SELECT * FROM products WHERE type LIKE " . $type3 . ")";
            if (isset($_GET['minprice'])) {
                $minprice = $_GET['minprice'];
                $query = substr_replace($query, " AND price >= " . $minprice . ")", strlen($query)-1);
            }
            if (isset($_GET['maxprice'])) {
                $maxprice = $_GET['maxprice'];
                $query = substr_replace($query, " AND price <= " . $maxprice . ")", strlen($query)-1);
            }
        }
        //If the type 4 is set grab it and prepare the query, then check if prices are set, if so add them to the query too.
        if (isset($_GET['t4'])) {
            $t[4] = $_GET['t4'];
            $type4 = "'%{$t[4]}%'";
            $query .= " UNION (SELECT * FROM products WHERE type LIKE " . $type4 . ")";
            if (isset($_GET['minprice'])) {
                $minprice = $_GET['minprice'];
                $query = substr_replace($query, " AND price >= " . $minprice . ")", strlen($query)-1);
            }
            if (isset($_GET['maxprice'])) {
                $maxprice = $_GET['maxprice'];
                $query = substr_replace($query, " AND price <= " . $maxprice . ")", strlen($query)-1);
            }
        }
    }
    //If the sort by variable isset get it and add the option to the end of the sql query
    if (isset($_GET['sortby']) && ((isset($_GET['minprice']) || isset($_GET['maxprice'])) || isset($_GET['t1']))) {
        $s = $_GET['sortby'];
        switch ($s) {
            case 'price-low-to-high':
                $query .= " ORDER BY price ASC";
                break;

            case 'price-high-to-low':
                $query .= " ORDER BY price DESC";
                break;

            case 'newest-items-first':
                $query .= " ORDER BY date_added DESC";
                break;

            case 'newest-items-first':
                $query .= " ORDER BY date_added ASC";
                break;
        }
    } elseif (isset($_GET['sortby'])) {
        $s = $_GET['sortby'];
        switch ($s) {
            case 'price-low-to-high':
                $query .= "SELECT * FROM products ORDER BY price ASC";
                break;

            case 'price-high-to-low':
                $query .= "SELECT * FROM products ORDER BY price DESC";
                break;

            case 'newest-items-first':
                $query .= "SELECT * FROM products ORDER BY date_added DESC";
                break;

            case 'newest-items-first':
                $query .= "SELECT * FROM products ORDER BY date_added ASC";
                break;
        }
    }

    try {
        $query = $db->prepare($query);
        $query->execute();
    } catch (Exception $e) {
        echo "Data could not be retrieved from the database.";
    }
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
        

    function get_list_view_html($product) {
        
        $output = "";

        $output = $output . '<li class="list-item">';
        $output = $output . '<a href="' . BASE_URL . 'product?id=' . $product["sku"] . '">';
        $output = $output . '<img src="' . BASE_URL . $product["img"] . '" alt="' . $product["name"] . '">';
        $output = $output . "<span class='item-info>";
        $output = $output . "<span class='item-title'><p>" . $product["name"] . "</p></span>";
        $output = $output . "<span class='item-price'><p>£" . $product["price"] . "</p></span>";
        $output = $output . "</span></a></li>";

        echo $output;
    }

    foreach ($results as $product) {
        get_list_view_html($product);
    }

} else {
    try {
        $query = $db->prepare("SELECT * FROM products");
        $query->execute();
    } catch (Exception $e) {
        echo "Data could not be retrieved from the database.";
    }
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
        

    function get_list_view_html($product) {
        
        $output = "";

        $output = $output . '<li class="list-item">';
        $output = $output . '<a href="' . BASE_URL . 'product?id=' . $product["sku"] . '">';
        $output = $output . '<img src="' . BASE_URL . $product["img"] . '" alt="' . $product["name"] . '">';
        $output = $output . "<span class='item-info>";
        $output = $output . "<span class='item-title'><p>" . $product["name"] . "</p></span>";
        $output = $output . "<span class='item-price'><p>£" . $product["price"] . "</p></span>";
        $output = $output . "</span></a></li>";

        echo $output;
    }

    foreach ($results as $product) {
        get_list_view_html($product);
    }    
}

