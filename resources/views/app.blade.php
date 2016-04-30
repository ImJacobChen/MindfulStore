<!doctype html>

@include('partials/header')
	<div id="alert-box">
		<p id="alert-box-alert">
			@if (Session::has('flash_message'))
				{{ Session::get('flash_message') }}
			@endif
		</p>
	</div>
@yield('content')

@include('partials/footer')
