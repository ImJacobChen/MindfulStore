@extends('app')

@section('content')
<div id="checkout-review-wrapper">
	<div id="customer-details">
	<h2>Delivery</h2>
		<div id="delivery-details" class="review-block">
			<!-- Delivery Details -->
			<p><strong>Delivering To:</strong></p>
			{!! $order->getDeliveryDetailsHtml() !!}
			<br>

			<!-- Delivery Contact Details -->
			<p><strong>Delivery Contact Details:</strong></p>
			{!! $order->getDeliveryContactDetailsHtml() !!}
			<br>
		</div>

		<!-- Billing Details -->
		<div id="billing-details" class="review-block">
			<p><strong>Billing Address:</strong></p>
			@if ($order->getOrderDetail('billing-address-same') == "true") 
				<p>Same as Delivery</p>
			@else 
				<!-- Billing Details -->
				{!! $order->getBillingDetailsHtml() !!}
				<br>

				<!-- Billing Contact Details -->
				<p><strong>Billing Contact Details:</strong></p>
				{!! $order->getBillingContactDetailsHtml() !!}
			@endif
		</div>
	</div>

	<div id="order-details">
	<h2>Order</h2>
		@include('partials.basket-table')

		<!-- Delivery Type -->
		<p><strong>Delivery Type:</strong></p>
		{{ $order->getOrderDetail('delivery-type') }}
	</div>

	<div id="payment-details">
	<h2>Payment</h2>
		{!! Form::open(['method' => 'POST' ,'action' => 'CheckoutController@setExpressCheckout']) !!}
			{!! Form::image('https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif', 'submit', ['border'=>'0', 'align'=>'top', 'alt'=>'Check out with PayPal']) !!}
		{!! Form::close() !!}
	</div>
</div>
@stop