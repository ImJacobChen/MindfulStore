<?php
	include 'includes/init.php'; 
	session_destroy();
	header('Location:' . BASE_URL . 'index.php');
?>