<?php
/*
*
*/
include '../config.php';
include '../database.php';
include '../classes/customer.php';
session_start();
if (isset($_SESSION['customer'])) {
	$customer = $_SESSION['customer'];
} else {
	$_SESSION['customer'] = new Customer();
	$customer = $_SESSION['customer'];
}

if (isset($_POST['checkout-type'])) {
	if ($_POST['checkout-type'] == "new-customer-no-sign-up") {									//If it is a new customer and they dont want to sign up
		if (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) { 	//If the email isset and it is a valid email
			$customerEmail = $_POST['email'];
			$_SESSION['customer']->updateDetail('emailAddress', $customerEmail);				//Update customer object with supplied email address
			sendDeliveryAddressForm();															//Send delivery address form to browser
		} elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {						//Else if the email address is not valid
			echo json_encode(array("error" => "Invalid email address"));						//Send JSON 'error' => 'Invalid email address'
		}
	} elseif ($_POST['checkout-type'] == "new-customer-sign-up") {								//Else if its a new customer and they do want to sign up
		#Send the sign up form
	} elseif ($_POST['checkout-type'] == "existing-customer") {									//Else if its an existing customer
		#Validate the customer then send delivery address form with option to use stored address
	}
}

if (isset($_POST['delivery-address'])) {						//If it is the delivery address form thats recieved
	if ($_POST['billing-address'] == 'no') {					//If its not the same as their billing address
		//Sanitize data and add to customer object
		$customer->addDetail('fullname', sanitizeData($_POST['full-name'])); 
		$customer->addDetail('addressLine1', sanitizeData($_POST['address-line-1']));
		$customer->addDetail('townCity', sanitizeData($_POST['town-city']));
		$customer->addDetail('county', sanitizeData($_POST['county']));
		$customer->addDetail('postcode', sanitizeData($_POST['postcode']));
		$customer->addDetail('country', sanitizeData($_POST['country']));
		$customer->addDetail('phoneNumber', sanitizeData($_POST['phone-number']));
		#sendBillingAddressForm();								//Send the browser the billing address form
	} elseif ($_POST['billing-address'] == 'yes') {				//Else if it is the same as their billing address
		//Sanitize data and add to customer object
		$customer->addDetail('fullname', sanitizeData($_POST['full-name'])); 
		$customer->addDetail('addressLine1', sanitizeData($_POST['address-line-1']));
		$customer->addDetail('townCity', sanitizeData($_POST['town-city']));
		$customer->addDetail('county', sanitizeData($_POST['county']));
		$customer->addDetail('postcode', sanitizeData($_POST['postcode']));
		$customer->addDetail('country', sanitizeData($_POST['country']));
		$customer->addDetail('phoneNumber', sanitizeData($_POST['phone-number']));
		//Send the order summary
		sendOrderSummary();										
	}
}




function sendDeliveryAddressForm() {
	echo include("../partials/delivery_address_form.php");
}

function sendSignUpForm() {
	echo include("partials/signUpForm.php");
}

function sendOrderSummary() {
	echo include("partials/orderSummary.php");
}

function sanitizeData($data) {
	return $data = filter_var($data, FILTER_SANITIZE_URL);
}