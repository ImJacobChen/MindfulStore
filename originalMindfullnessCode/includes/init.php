<?php
require 'config.php';
require 'database.php';
require 'products.php';
require 'classes/ShoppingCart.php';
require 'classes/item.php';
require 'classes/customer.php';
require 'functions/general_functions.php';
require 'functions/customers.php';
session_start();

// Inititalize the session cart
if (isset($_SESSION['cart'])) {
	$cart = $_SESSION['cart'];
} else {
	$cart = new ShoppingCart();
	$_SESSION['cart'] = $cart;
}

// Initialize the session customer
if (isset($_SESSION['customer'])) {
	$customer = $_SESSION['customer'];
} else {
	$customer = new Customer();
	$_SESSION['customer'] = $customer;
}

// If logged in put customer data in $customer_data variable
if (logged_in() === true) {
	$session_customer_id = $_SESSION['customer_id'];
	$customer_data = customer_data($session_customer_id, 'customer_id', 'password', 'first_name', 'last_name', 'email_address', 'phone_number');
	if (customer_active($customer_data['email_address']) === false) {
		session_destroy();
		header('Location: ../index.php');
		exit();
	}
}

$errors = array();