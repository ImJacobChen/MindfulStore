@extends('app')

@section('content')
	<div id="product-wrapper">
		@if (Session::has('added_to_basket'))
			<div id="added-to-basket">
				<h3 id="added-to-basket-alert">
					{{ Session::get('added_to_basket') }}
				</h3>
				<a class="proceed-to-basket" href="{{ url('/') }}">Proceed to Basket?</a>
			</div>
		@endif

		<a href="{{ url('products') }}" class="back-to-products">
			<p>← Back to products</p>
		</a>
		<div class="name-and-price">
			<h3>{{ $product->name }}</h3>
			<h4>{{ $product->price }}</h4>
		</div>
		<div class="product-image">
			<img src="/{{$product->img}}" alt="$product->description">
		</div>

		<form id="product-form" action="add-to-basket" method="post">
			<div class="attribute-boxes">
				<div class="attribute-box attribute-box-left">Quantity: <select name="quantity" class="product-quantity form-field">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
				</select></div>

				<div class="attribute-box attribute-box-right"></div>
			</div>
			
			<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
			{!! Form::hidden('product_id', $product->id, null, ['class' => 'form-field']) !!}
			{!! Form::hidden('product_name', $product->name, null, ['class' => 'form-field']) !!}
			{!! Form::hidden('product_price', $product->price, null, ['class' => 'form-field']) !!}
			{!! Form::submit('Add to Basket +', ['id' => 'add-to-basket']) !!}
		</form>
	</div>

	<div id="accordion">
		<h3>Product Description</h3>
		<div class="description">
			<p>{{ $product->description }}</p>
		</div>

		<h3>Delivery</h3>
		<div class="description">
			<p>UK Standard: £3.99 or FREE over £60! Delivered within 3-5 days
			<br><br>
			UK Next Day: £4.99 or FREE over £150! Order before 9pm Sunday to Friday, 8pm Saturday to receive the following day.
			<br><br>
			UK Next Day Evening: £7.99 - Order before midnight to receive your order between 6-10pm the following day | Place your order between midnight and 1am for same day delivery between 6pm and 10pm
			<br><br>
			International Standard: From £4.99. Delivered within 10 working days (Price dependent on Country)
			<br><br>
			International Tracked Express: From £8 - Delivered within 6 working days. Tracked service for orders outside EU (Price dependent on Country).</p>
		</div>

		<h3>Returns</h3>
		<div class="description">
			<p>Return your items to store for FREE (excluding our Dublin, Harrods,French & Italian stores).
			<br><br>
			If you are a UK customer then you’ll find a FREE returns sticker inside your package. Please put this on the outside of your unwanted item(s) when sending back. 
			<br><br>
			If you are a customer from outside the UK then please use a carrier that will give you a ‘Certificate of Postage’ as the package is your responsibility until we receive it. Please note, free returns is only valid to UK customers.
			<br><br>
			Please return your unwanted goods within 28 days of receipt for a full refund. We will however exchange any unwanted returns and re-send them without any further charge.</p>
		</div>
	</div>
	</div><!--End of Wrapper-->
	<script>
		// jQuery accordion function adds functionality to the item descriptions.
		$( "#accordion" ).accordion({
			heightStyle: 'content'
		});
	</script>
@stop