<html lang="en">
<head>
	<title>The Mindfulness Shop</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="/css/basicStyle.css">
	<link rel="stylesheet" type="text/css" href="/css/style.css">
	
	<link rel="stylesheet" type="text/css" href="/css/normalize.css">
	<link rel="stylesheet" type="text/css" href="/css/skeleton.css">
	<!--Import Google Icon Font-->
	<!--link href='https://fonts.googleapis.com/css?family=Quicksand|Material+Icons' rel='stylesheet' type='text/css'-->
	<script src="/js/jquery-2.2.3.min.js"></script>
</head>
<body>
	<div id="user-panel">
		<a id="login-button" href="{{ url('/account') }}">
			{!! Html::image('img/user.png', 'user icon', array('class' => 'user-icon')) !!}
			@if ($user)
				Hello, {{$user->name}}
			@else
				Log in/Sign up
			@endif
		</a>
		<div id="shopping-cart-icon"><a href="{{ url('/basket') }}">
			{!! Html::image('img/shopping-cart.png', 'shopping cart icon') !!}
			<p id="shopping-cart-count">{{ $cartCount }} Item(s)</p>
		</a></div>
	</div>
	<!-- END USER PANEL -->

	<div id="titleBar">
		{!! Html::image('img/search.png', 'search icon', ['class'=>'titleBar-searchButton']) !!}

		<p class="titleBar-title">The Mindfulness Shop</p>

		<a id="titleBar-menuButton" href="#">☰</a>
	</div>
	<!-- END TITLE -->

	<!-- MENU -->
	<div id="menu">
		<ul>
			<a href="{{ url('/') }}"><li>Home</li></a>
			<a href="{{ url('/products') }}"><li>Products</li></a>
			<a href="{{ url('/contact') }}"><li>Contact</li></a>
			<a href="#"><li>About</li></a>
		</ul>
	</div>
	<!--END OF MENU-->

	<div class="search-box">
		{!! Form::open(['method' => 'GET' ,'action' => 'SearchController@search', 'id' => 'search-form']) !!}
			{!! Form::input('search', 's', null, ['id' => 'search-bar', 'class' => 'search-bar', 'placeholder' => 'Search']) !!}
			{!! Form::submit('submit', ['class' => 'search-submit']) !!}
		{!! Form::close() !!}
	</div><!--End of Search Box-->

	<script type="text/javascript">
		/*
		* Function to toggle the menu and button 'active' class.
		*/
		var menu = document.getElementById('menu');
		document.getElementById('titleBar-menuButton').addEventListener('click', function() {
			if (menu.style.display === 'none' || menu.style.display === '') {
				menu.style.display = 'block';
			} else {
				menu.style.display = 'none';
			}
		}, false);

		/*
		* Function to toggle the search bar
		*/
		var searchBar = document.querySelector('.search-box');
		document.querySelector('.titleBar-searchButton').addEventListener('click', function() {
			if (searchBar.style.display === 'none' || searchBar.style.display === '') {
				searchBar.style.display = 'block';
			} else {
				searchBar.style.display = 'none';
			}
		}, false);
	</script>