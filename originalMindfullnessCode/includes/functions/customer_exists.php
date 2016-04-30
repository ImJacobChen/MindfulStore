<?php
require('../database.php');
require('customers.php');
require('general_functions.php');
/*
 * Summary:      Gets sent an email and checks if it exists
 *				 in the database
 *               
 * Parameters:   
 * Return:       
 */

if (isset($_GET['email'])) {
	if ( customer_exists($_GET['email']) ) {
		echo 'true';
	} else {
		echo 'false';
	}
}
