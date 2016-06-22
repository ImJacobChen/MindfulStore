<!doctype html>

@include('partials/header')

	@if (session('error_message'))
		<div class="flash_message error_message">
			{{ session('error_message') }}
		</div>
	@endif
	@if (session('alert_message'))
		<div class="flash_message alert_message">
			{{ session('alert_message') }}
		</div>
	@endif
	@if (session('success_message'))
		<div class="flash_message success_message">
			{{ session('success_message') }}
		</div>
	@endif
	@if (session('notice_message'))
		<div class="flash_message notice_message">
			{{ session('notice_message') }}
		</div>
	@endif

@yield('content')

@include('partials/footer')
