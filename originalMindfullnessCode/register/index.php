<?php 
	require_once('../includes/init.php');
	logged_in_redirect();

	include(ROOT_PATH . 'includes/partials/header.php'); 
?>
<head>
	<script type="text/javascript" src="../includes/notie/notie.js"></script>
</head>

<?php if (isset($_GET['success'])) {
	include(ROOT_PATH . 'includes/partials/registration_success.php');
} else {
	include(ROOT_PATH . 'includes/partials/registration_form.php');
}?>

<?php include(ROOT_PATH . 'includes/partials/footer.php'); ?>

