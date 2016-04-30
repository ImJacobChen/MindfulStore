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
			{!! Form::open(['url' => '/auth/login', 'class' => 'z-depth-1']) !!}
					{!! Form::label('email', 'What is your email address?') !!}
					{!! Form::email('email', null, ['class' => '']) !!}
					<br>
					{!! Form::label('password', 'Password:') !!}
					{!! Form::password('password', null, ['class' => '']) !!}
					<br>
					<button id='signupLogin-signupButton' class="btn waves-effect waves-light blue accent-2" type="submit">Sign In</button>
			{!! Form::close() !!}
		</div>
		<div id="signupLogin-signupContainer">
			<h2>Create an account.</h2>
			{!! Form::open(['url' => '/auth/register', 'class' => 'z-depth-1']) !!}
					{!! Form::label('name', 'What is your name?') !!}
					{!! Form::text('name', null, ['class' => '']) !!}
					<br>
					{!! Form::label('email', 'What is your email address?') !!}
					{!! Form::email('email', null, ['class' => '']) !!}
					<br>
					{!! Form::label('password', 'Password:') !!}
					{!! Form::password('password', null, ['class' => '']) !!}
					<br>
					{!! Form::label('password_confirmation', 'Confirm Password:') !!}
					{!! Form::password('password_confirmation', null, ['class' => '']) !!}
					<br>
					<button id='signupLogin-loginButton' class="btn waves-effect waves-light green" type="submit">Create Account</button>
			{!! Form::close() !!}
		</div>
	</div>
@stop