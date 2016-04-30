<?php 
	require_once('init.php');

	if (!empty($_POST)) {
		$required_fields = ['first-name','last-name','email','confirm-email','password','confirm-password'];
		foreach($_POST as $key => $value) {
			if (empty($value) && in_array($key, $required_fields) === true) {
				$errors[] = 'Please fill out all of the fields';
				break 1;
			}
		}

		if(empty($errors)) {
			if (customer_exists($_POST['email']) === true) {
				$errors[] = "The email '" . $_POST['register-email'] . "' is already in use.";
			}
			if (strlen($_POST["password"]) < 6 && strlen($_POST["password"]) > 32) {
				$errors[] = "Your password must be at least 6 characters and less than 32.";
			}
			if ($_POST['password'] !== $_POST['confirm-password']) {
				$errors[] = "Error, your passwords do not match.";
			}
		}
	}

	if (!empty($_POST) && empty($errors)) {
		$register_data = [
			'first_name' => $_POST['first-name'],
			'last_name' => $_POST['last-name'],
			'email_address' => $_POST['email'],
			'password' => $_POST['password']
		];
		register_customer($register_data);
		header("Location: " . BASE_URL . "register/?success");
		exit();
	} else if (empty($errors) === false) {
		$errorString;
		foreach($errors as $error) {
			$errorString .= $error . "<br>";
		}
		echo $errorString;
	} 

	/**
	 * This function will see if there is already 
	 * a user with the supplied email address.
	 */