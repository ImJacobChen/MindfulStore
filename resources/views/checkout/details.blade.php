@extends('app')

@section('content')
	<div id="checkout">
		<h1><u>Checkout</u></h1>

		@if (count($errors) > 0)
			<div id="errors">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
		<form method="POST" action="{{ route('checkout.order') }}">
			<!-- Your Details -->
			<div id="checkout-yourDetails">
				<h2>Your Details</h2>

				<hr>

		    	<label for="name">Full Name</label>
			    <input type="text" name="name" class="u-full-width" placeholder="Full name" />

			    <label for="email">Email</label>
			    <input type="email" name="email" class="u-full-width" placeholder="Email Address" />

			    <label for="phone">Phone Number</label>
			    <input type="text" name="phone" class="u-full-width" placeholder="Phone Number" />
			</div>
			<!-- End Your Details-->

			<!-- Shipping Address -->
			<div id="checkout-shippingAddress">
				<h2>Shipping Address</h2>

				<hr>

				<label for="addressLine1">Address line 1</label>
			    <input type="text" name="addressLine1" class="u-full-width" placeholder="Address Line 1" />

			    <label for="addressLine2">Address line 2</label>
			    <input type="text" name="addressLine2" class="u-full-width" placeholder="Address Line 2" />
			
			    <label for="name">City</label>
			    <input type="text" name="city" class="u-full-width" placeholder="City" />

			    <label for="postalCode">Postal Code</label>
			    <input type="text" name="postalCode" class="u-full-width" placeholder="Postal Code" />
			
			    <label for="country">Country</label>
			    <input type="text" name="country" class="u-full-width" placeholder="Country" />
			</div>	
			<!-- End Shipping Address -->
			
			<!-- Payment -->
			<h2>Payment</h2>

			<hr>
			<div id="checkout-payment">
				<div>
					<h4>Order Summary</h4>
					<table class="u-full-width">
						<thead>
							<tr>
								<th>Your Items</th>
								<th>Specifics</th>
								<th>Price</th>
							</tr>
						</thead>
						<tbody>
						@foreach ($userCartItems as $cartItem)
							<tr>
								<td>{!! Html::image($cartItem->product->img, 'product image', ["class" => "checkout-payment-productImage"]) !!}</td>
								<td>
									{{ $cartItem->name }}
									<br>
									Quantity: {{ $cartItem->qty }}
								</td>
								<td>£{{ $cartItem->price }}</td>
							</tr>
						@endforeach
							<tr>
								<th></th>
								<th></th>
								<th></th>
							</tr>
							<tr>
								<th>Subtotal:</th>
								<th></th>
								<th>£{{ $cartTotal }}</th>
							</tr>
							<tr>
								<th>Delivery</th>
								<th></th>
								<th>
									<select name="delivery" id="deliverySelectInput">
										<option value="standard">Standard Delivery 3-5 Working Days - £1.99</option>
										<option value="express">Express Delivery 1-2 Working Days - £4.99</option>
									</select>
								</th>
							</tr>
							<tr>
								<th>Total</th>
								<th></th>
								<th>£{{ $cartTotal }}</th>
							</tr>
						</tbody>
					</table>
				</div>

				<!-- Braintree DropIn UI -->
				<h4>Pay Here</h4>
				<div id="payment-dropin-container">
						<div id="dropin-container"></div>
				</div>
				<!-- End Your Order -->
			</div>
			<!-- End Payment -->

			{{ csrf_field() }}
			<input id="checkout-placeOrderButton" class="u-full-width" type="submit" value="Place Order">
		</form>
	</div>
	<!-- End Checkout Details -->


	<!-- !! Javascript Form Validation !! -->
	<script type="text/javascript">
		/**
		 * validate form fields
		 * @param  {string} field        the field you want to validate
		 * @param  {array} optionsArray  the validation options
		 * @return {[type]}              [description]
		 */
		function validate(field, optionsArray) {
			var errors = [];
			var input = field.value.trim();
			var parentElement = field.parentElement;
			var parentChildren = parentElement.children;

			if (optionsArray.includes('required')) {
				if (input == "" || input == null) {
					errors.push('This field is required.');
				}
			}
			if (optionsArray.includes('phone')) {
				var reg = new RegExp('^[0-9]+$');
				if (reg.test(input) == false) {
					errors.push('Your phone number must be all numbers.');
				}
			}
			if (optionsArray.includes('email')) {
				var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
				
				if (re.test(input) == false) {
					errors.push('Please enter a valid email address');
				}
			}

			
			if (errors.length > 0) // If there are errors 
			{
				if (field.classList.contains('valid')) {
					field.classList.remove('valid');
				}
				field.classList.add('invalid');

				if (parentElement.querySelector('.checkout-inputFieldErrors')) {
					var ul = parentElement.querySelector('.checkout-inputFieldErrors');
					var text = "";

					for (var i = 0; i < errors.length; i++) {	
						text += "<li>" + errors[i] + "</li>";
					};
					
					ul.innerHTML = text;
				} else {
					var ul = document.createElement("ul");
					ul.className = "checkout-inputFieldErrors";
					var text = "";

					for (var i = 0; i < errors.length; i++) {
						text += "<li>" + errors[i] + "</li>";
					};

					ul.innerHTML = text;
					parentElement.appendChild(ul);

				}

				
			} 
			else // Else if there are no errors
			{
				if (field.classList.contains('invalid')) {
					field.classList.remove('invalid');
				}

				for (var i = 0; i < parentChildren.length; i++) {
					if (parentChildren[i].classList.contains("checkout-inputFieldErrors")) {
						parentChildren[i].remove();
					}
				};

				field.classList.add('valid');
			}
		}
	</script>

	<!-- !! Braintree Scripts !! -->

	<!-- Braintree JS -->
	<script src="https://js.braintreegateway.com/js/braintree-2.24.1.min.js"></script>
	<!-- AJAX request to braintree/token for client token -->
	<script type="text/javascript">
		$.ajax({
			url: '{{ route("braintree.token") }}',
			type: 'get',
			dataType: 'json'
		}).success(function (data) {
			braintree.setup(data.token, 'dropin', {
				container: 'dropin-container',
			});
		});
	</script>
@stop