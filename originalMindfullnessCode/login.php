<?php 
	include 'includes/init.php';
	logged_in_redirect();

	if (empty($_POST) === false) {
		$email = $_POST['login-email'];
		$password = $_POST['login-password'];

		if (empty($email) || empty($password)) {
			$errors[] = 'You need to enter a email address and/or password.';
		} else if (customer_exists($email) === false) {
			$errors[] = 'We cannot find an account with that email address/password combination.';
		} else {
			$login = login($email, $password);
			if ($login === false) {
				$errors[] = "That is an incorrect email address or password.";
			} else {
				$_SESSION["customer_id"] = $login['customer_id'];
				exit();
			}
		}
	} 
	if (!empty($errors)) {
		echo json_encode(array("error" => $errors));
	}
?>