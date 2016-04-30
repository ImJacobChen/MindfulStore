<?php
require 'includes/config.php';
require 'includes/database.php';
require 'includes/products.php';
require 'includes/classes/ShoppingCart.php';
require 'includes/classes/item.php';
require 'includes/classes/customer.php';
require 'includes/functions/general_functions.php';
require 'includes/functions/customers.php';
session_start();

if (logged_in() === true) {
	$session_customer_id = $_SESSION['customer_id'];
	$customer_data = customer_data($session_customer_id, 'customer_id', 'password', 'first_name', 'last_name', 'email_address', 'phone_number');
	if (customer_active($customer_data['email_address']) === false) {
		session_destroy();
		header('Location: ../index.php');
		exit();
	}
}
var_dump($customer_data);

$errors = array();