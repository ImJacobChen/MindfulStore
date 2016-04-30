<?php 
	function protected_page() {
		if (logged_in() === false) {
			header('Location:' . BASE_URL . 'index.php?notloggedin');
			exit();
		}
	}

	function logged_in_redirect() {
		if (logged_in() === true) {
			header('Location: index.php');
			exit();
		}
	}
?>