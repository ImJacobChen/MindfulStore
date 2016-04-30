<?php 
	if (isset($_GET["search"])) {
		$query = $_GET["search"];
		header("location:" . BASE_URL . "search?q=" . $query);
	}
?>
<head>
	<title>The Zen Store</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="<?php echo BASE_URL; ?>css/style.css" type=text/css rel="stylesheet" />
	<link href="<?php echo BASE_URL; ?>css/basicStyle.css" type=text/css rel="stylesheet" />
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Lora|Montserrat|Raleway|Indie+Flower|Josefin+Sans|Quicksand|Josefin+Slab|EB+Garamond|Quattrocento|Philosopher' rel='stylesheet' type='text/css'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</head>

<body>
	<div id="wrapper">

		<!--div id="header">
			<img src="<?php echo BASE_URL; ?>images/aaaaa.jpg">
		</div><!End of Header-->

		<div id="user-panel">
			<a id="login-button" href="#"><img class="user-icon" src="<?php echo BASE_URL . 'images/user.png' ?>">
				<strong> <?php 
				if (isset($customer_data["first_name"])) {
					echo 'Hello, ' . $customer_data["first_name"];
				} else {
					echo 'Log-in/Sign-up';
				}
			?></strong></a>
			<div id="shopping-cart-icon"><a href="<?php echo BASE_URL; ?>basket">
				<img src="<?php echo BASE_URL; ?>images/shopping-cart.png">
				<p id="shopping-cart-count"><?php if(isset($_SESSION["cart"])) {
						echo count($_SESSION['cart']);
					} else {
						echo 0;
					} ?> Item(s)</p>
			</a></div>
		</div><!--End of User Panel-->
		<div id="login-panel">
			<?php if (logged_in() == true) {
				echo 'You are logged in as ' . $customer_data['email_address'];
				echo '<form action="<?php echo BASE_URL ?>logout.php" method="post">';
				echo '<input type="submit" value="Log Out" class="logout button"></form>';
			} else {
				$login_form = "";
				$login_form .= '<form class="login-form">';
				$login_form .= 'Email Address: <input type="text" name="login-email" class="login email"><br>';
				$login_form .= 'Password: <input type="password" name="login-password" class="login password"><br>';
				$login_form .= '<input type="submit" value="Log In"></form>';
				$login_form .= 'Dont have an account? <a href="#">Sign up here</a>';
				echo $login_form;
			} ?>
		</div><!--End of Login Panel-->

		<div id="title">
			<div class="search-button">
				<img src="<?php echo BASE_URL; ?>images/search-113.png">
			</div>
			<div class="logo">
				<h1>The Mindfullness Shop</h1>
			</div>
			<div id="menu-button">
				<a id="nav-toggle" href="#"><span></span></a>
			</div>
		</div><!--End of Title-->

		<div id="menu">
			<ul>
				<a href="<?php echo BASE_URL; ?>"><li>Home</li></a>
				<a href="<?php echo BASE_URL; ?>products"><li>Products</li></a>
				<a href="<?php echo BASE_URL; ?>contact"><li>Contact</li></a>
				<a href="#"><li>About</li></a>
			</ul>
		</div><!--End of Menu-->

		

		<div class="search-box">
			<form id="search-form" method="get" action="" onSubmit="return validateSearch()">
				<input id="search-bar" class="search-bar" type="search" name="search" placeholder="What are you looking for?">
				<input class="search-submit" type="submit" value=" ">
			</form>
		</div><!--End of Search Box-->

		<script type="text/javascript">
			/*
			* Function to toggle the menu and button 'active' class.
			*/
			var navButton = document.querySelector( "#nav-toggle" );
  			var menu = document.getElementById('menu');
			document.getElementById('menu-button').addEventListener('click', function() {
				if (menu.style.display === 'none') {
					menu.style.display = 'block';
					navButton.classList.add( "active" );
				} else {
					menu.style.display = 'none';
					navButton.classList.remove( "active" );
				}
			}, false);

			/*
			* Function to toggle the login panel.
			*/
			var loginButton = document.getElementById('login-button');
			var loginPanel = document.getElementById('login-panel');
			function loginPanelToggle() {
				if (loginPanel.style.display === 'none') {
					loginPanel.style.display = 'block';
				} else {
					loginPanel.style.display = 'none';
				}
			}
			loginButton.addEventListener('click', loginPanelToggle, false);

		   /*
			* Makes sure that the search input is not "" or " "
			*/
			

			/*
			* Function to toggle the search bar
			*/
			var searchBar = document.querySelector('.search-box');
			document.querySelector('.search-button').addEventListener('click', function() {
				if (searchBar.style.display === 'none') {
					searchBar.style.display = 'block';
				} else {
					searchBar.style.display = 'none';
				}
			}, false);

		   /*
			*	This script will collect the ajax to login.php  
			*	with the form data
			*/
			var loginForm = $('.login-form');
			loginForm.on('submit', function(e){
				e.preventDefault();
				var details = loginForm.serialize();
				$.post('login.php', details, function(data) {
					try {									//Try and parse JSON Data
						var newData = $.parseJSON(data);	//Add JSON data to newData
					} catch(error) {
					}
					if (typeof newData != "undefined") {			//If newData exists (the newData if it exists is an error message)
						$('.error-holder').append(newData.error);	//Append the data to error-message
					} else {										//Else
						$('#login-button').html(data);				//Add the recieved data to the main body
					}
				}).fail(function(){
					$('login-panel').append('log in error');
				});
			});
		</script>