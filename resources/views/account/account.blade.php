@extends('app')

@section('content')
	<h1>Hello, {{ $user->name }}</h1>

	{!! Form::open(['method' => 'GET', 'url' => '/auth/logout']) !!}
		{!! Form::submit('Sign Out', []) !!}
	{!! Form::close() !!}
@stop