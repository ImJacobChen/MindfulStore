@extends('app')

@section('content')
	<div class="container">
		<h3>Order:  #{{ $order->id }}</h3>

		<div class="row">
			<div class="six columns">
				<h4>Shipping to</h4>
				{{ $order->address->address1 }}<br>
				{{ $order->address->address2 or '' }}<br>
				{{ $order->address->city }}<br>
				{{ $order->address->postal_code }}<br>
				{{ $order->address->country }}<br>
			</div>
			
			<div class="six columns">
				<h4>Your Items</h4>
				@foreach ($order->products as $product)
					<a href="{{ url('/product', $product->id) }}">{{ $product->name }}</a> (x{{ $product->pivot->quantity }})
				@endforeach
			</div>
		</div>
		
		<div class="row">
			<div class="six columns">
				<p>
					Shipping: £1.99<br>
					<strong>Order total: £{{ $order->total }}</strong>
				</p>
			</div>
		</div>
	</div>
@stop