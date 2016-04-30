<?php

	define("BASE_URL","/TheMindfullnessShop/");
	define("ROOT_PATH",$_SERVER["DOCUMENT_ROOT"] . "/TheMindfullnessShop/");

	define("DB_HOST", "localhost");
	define("DB_NAME", "thezenstore");
	define("DB_PORT", "3306");
	define("DB_USER", "root");
	define("DB_PASS", "");

	require_once('vendor/autoload.php');

	$stripe = array(
	  "secret_key"      => "sk_test_sTiw9n7bTpe7TRAisA5Q9QO3",
	  "publishable_key" => "pk_test_fW2al2pJh1gtuTzAJqg0kfmc"
	);

	\Stripe\Stripe::setApiKey($stripe['secret_key']);