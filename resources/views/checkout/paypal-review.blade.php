@extends('app')

@section('content')
	<?php echo '<pre>' ?>
	{{ print_r($checkoutDetails) }}
	<?php echo '</pre>' ?>

	<?php echo '<pre>' ?>
	{{ print_r($response) }}
	<?php echo '</pre>' ?>
@stop