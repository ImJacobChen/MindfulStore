@extends('app')

@section('content')
	<div id="signupLogin">
		@if (count($errors) > 0)
				<div id="errors">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif
		<div id="signupLogin-loginContainer">
			<h2>Have an account?</h2>
			<hr>
			{!! Form::open(['url' => '/auth/login']) !!}
				<label for="email">What is your email address?</label>
				<input type="email" name="email" class="u-full-width"></input>

				<br>
				<label for="password">Password:</label>
				<input type="password" name="password" class="u-full-width"></input>

				<br>
				<input type="submit" value="Log In" class="u-full-width">
			{!! Form::close() !!}
			
		</div>
		<div id="signupLogin-signupContainer">
			<h2>Create an account.</h2>
			<hr>
			<form>

			</form>
			{!! Form::open(['url' => '/auth/register']) !!}
					<label for="name">What is your name?</label>
					<input type="text" name="name" class="u-full-width"></input>
					<br>
					<label for="email">What is your email address?</label>
					<input type="email" name="email" class="u-full-width"></input>
					<br>
					<label for="password">Password:</label>
					<input type="password" name="password" class="u-full-width"></input>
					<br>
					<label for="password_confirmation">Confirm password:</label>
					<input type="password" name="password_confirmation" class="u-full-width"></input>
					<br>
					<button id='signupLogin-loginButton' type="submit">Create Account</button>
			{!! Form::close() !!}
		</div>
	</div>
@stop