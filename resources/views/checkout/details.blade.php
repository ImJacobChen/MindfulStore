@extends('app')

@section('content')
	<div id="checkoutDetails">
		<h2><u>Checkout</u></h2>

		<!-- ORDER SUMMARY -->
		<div class="checkoutDetails-checkoutChunk checkoutDetails-orderSummaryContainer">
			<h2>Your Order</h2>
			<table>
			<tr>
				<th>Item</th>
				<th>Specifics</th>
				<th>Price</th>
			</tr>
			@foreach ($userCartItems as $cartItem)
				<tr>
					<td>{!! Html::image($cartItem->product->img, 'zen image') !!}</td>
					<td>
						{{ $cartItem->name }}
						<br>
						Quantity: {{ $cartItem->qty }}
					</td>
					<td>£{{ $cartItem->price }}</td>
				</tr>
			@endforeach
				<tr class="checkoutDetails-orderSummaryTableSubtotalRow">
					<td></td>
					<th>Subtotal:</th>
					<th>£{{ $cartTotal }}</th>
				</tr>
			</table>
		</div>
		<!-- END ORDER SUMMARY -->
		
		<!-- DELIVERY INFORMATION -->
		<div class="checkoutDetails-checkoutChunk checkoutDetails-deliveryInformationContainer">
			<h2>Delivery Address</h2>
			
			@if (count($errors) > 0)
				<div id="errors">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif

			{!! Form::open(['method' => 'POST' ,'action' => 'CheckoutController@review', 'name' => 'checkoutDetailsForm']) !!}
			
			<!-- Delivery PostCode -->
			<div>
				{!! Form::label('delivery-postcode', 'Postcode*') !!}
				{!! Form::text('delivery-postcode', null, ['class' => 'delivery-information-field', 'onblur' => 'validate(this, ["required"])']) !!}
			</div>

			<div>
				<!-- Delivery First Name -->
				{!! Form::label('delivery-first-name', 'First name*') !!}
				{!! Form::text('delivery-first-name', null, ['class' => 'delivery-information-field', 'onblur' => 'validate(this, ["required"])']) !!}	
			</div>

			<div>
				<!-- Delivery Last Name -->
				{!! Form::label('delivery-last-name', 'Last name') !!}*
				{!! Form::text('delivery-last-name', null, ['class' => 'delivery-information-field', 'onblur' => 'validate(this, ["required"])']) !!}
			</div>
			
			<div>	
				<!-- Delivery Address Line 1 -->
				{!! Form::label('delivery-address-line-1', 'Address Line 1') !!}*
				{!! Form::text('delivery-address-line-1', null, ['class' => 'delivery-information-field', 'onblur' => 'validate(this, ["required"])']) !!}
			</div>	
			
			<div>	
				<!-- Delivery Address Line 2 -->
				{!! Form::label('delivery-address-line-2', 'Address Line 2') !!}
				{!! Form::text('delivery-address-line-2', null, ['class' => 'delivery-information-field']) !!}
			</div>

			<div>
				<!-- Delivery Town/City -->
				{!! Form::label('delivery-town-city', 'Town/City') !!}*
				{!! Form::text('delivery-town-city', null, ['class' => 'delivery-information-field', 'onblur' => 'validate(this, ["required"])']) !!}
			</div>

			<div>	
				<!-- Delivery Country -->
				{!! Form::label('delivery-country', 'Country') !!}*
				{!! Form::text('delivery-country', null, ['class' => 'delivery-information-field', 'onblur' => 'validate(this, ["required"])']) !!}
			</div>

			<div>	
				<!-- Delivery Phone Number -->
				{!! Form::label('delivery-phone', 'Phone Number') !!}*
				{!! Form::text('delivery-phone', null, ['class' => 'delivery-information-field', 'onblur' => 'validate(this, ["required", "phone"])']) !!}
			</div>

			<div>	
				<!-- Delivery Email Address -->
				{!! Form::label('delivery-email', 'Email Address') !!}*
				{!! Form::email('delivery-email', null, ['class' => 'delivery-information-field', 'onblur' => 'validate(this, ["required", "email"])']) !!}
			</div>
		</div>
		<!-- END DELIVERY INFORMATION -->
		
		<!-- BILLING ADDRESS OPTIONS -->
		<div class="checkoutDetails-checkoutChunk checkoutDetails-billingAddressOptionsContainer">
			<h2>Billing Address</h2>
			<input name="billing-address-same" value="true" type="radio" id="billing-address-same" onclick="showHideForm()" checked="true" />
      		<label for="billing-address-same">Billing address is the same</label>
			<br>
			<input name="billing-address-same" value="false" type="radio" id="billing-address-different" onclick="showHideForm()" />
			<label for="billing-address-different">Billing address is different</label>
		</div>
		<!-- END BILLING ADDRESS OPTIONS -->

		<!-- BILLING ADDRESS FORM -->
		<div class="checkoutDetails-checkoutChunk checkoutDetails-billingInformationContainer">
			<!-- Billing PostCode -->
			<div>
				{!! Form::label('billing-postcode', 'Postcode') !!}
				{!! Form::text('billing-postcode', null, ['class' => 'billing-information-field', 'onblur' => 'validate(this, ["required"])']) !!}
			</div>

			<div>
				<!-- Billing First Name -->
				{!! Form::label('billing-first-name', 'First name') !!}*
				{!! Form::text('billing-first-name', null, ['class' => 'delivery-information-field', 'onblur' => 'validate(this, ["required"])']) !!}
			</div>

			<div>
				<!-- Billing Last Name -->
				{!! Form::label('billing-last-name', 'Last name') !!}*
				{!! Form::text('billing-last-name', null, ['class' => 'delivery-information-field', 'onblur' => 'validate(this, ["required"])']) !!}
			</div>
			
			<div>
				<!-- Billing Address Line 1 -->
				{!! Form::label('billing-address-line-1', 'Address Line 1') !!}*
				{!! Form::text('billing-address-line-1', null, ['class' => 'delivery-information-field', 'onblur' => 'validate(this, ["required"])']) !!}
			</div>
			
			<div>
				<!-- Billing Address Line 2 -->
				{!! Form::label('billing-address-line-2', 'Address Line 2') !!}
				{!! Form::text('billing-address-line-2', null, ['class' => 'delivery-information-field']) !!}
			</div>

			<div>			
				<!-- Billing Town/City -->
				{!! Form::label('billing-town-city', 'Town/City') !!}*
				{!! Form::text('billing-town-city', null, ['class' => 'delivery-information-field', 'onblur' => 'validate(this, ["required"])']) !!}
			</div>

			<div>
				<!-- Billing Country -->
				{!! Form::label('billing-country', 'Country') !!}*
				{!! Form::text('billing-country', null, ['class' => 'delivery-information-field', 'onblur' => 'validate(this, ["required"])']) !!}
			</div>

			<div>
				<!-- Billing Phone Number -->
				{!! Form::label('billing-phone', 'Phone Number') !!}*
				{!! Form::text('billing-phone', null, ['class' => 'delivery-information-field', 'onblur' => 'validate(this, ["required", "phone"])']) !!}
			</div>

			<div>
				<!-- Billing Email Address -->
				{!! Form::label('billing-email', 'Email Address') !!}*
				{!! Form::email('billing-email', null, ['class' => 'delivery-information-field', 'onblur' => 'validate(this, ["required", "email"])']) !!}
			</div>
		</div>
		<!-- END BILLING ADDRESS FORM -->
		
		<!-- DELIVERY TYPE -->
		<div class="checkoutDetails-checkoutChunk checkoutDetails-deliveryTypeContainer">
			<h2>Delivery Type</h2>
			<input name="delivery-type" type="radio" id="standard" checked="true" />
      		<label for="standard">Standard Saver (£2.99), 3-5 Working Days</label>
			<br>
			<input name="delivery-type" type="radio" id="premium" />
			<label for="premium">Premium Next Day</label>
		</div>
		<!-- END DELIVERY TYPE -->

		<!-- ORDER TOTAL -->
		<div class="checkoutDetails-checkoutChunk checkoutDetails-orderTotalContainer">
			<h2>Order Total</h2>
			<table class="checkoutDetails-orderTotalTable">
				<tr>
					<td>Delivery Price</td>
					<td class="checkoutDetails-orderTotalTable-row2">£1.99</td>
				</tr>
				<tr>
					<td>Order Total</td>
					<td class="checkoutDetails-orderTotalTable-row2">£{{ $cartTotal }}</td>
				</tr>
			</table>
		</div>
		<!-- END ORDER TOTAL -->

		<!-- REVIEW & PAY BUTTON -->
		<div class="checkoutDetails-checkoutChunk checkoutDetails-reviewAndPayButtonContainer">
			{!! Form::submit('Review &#38; Pay', ['class' => 'button checkoutDetails-reviewAndPayButton']) !!}
			{!! Form::close() !!}
		</div>
		<!-- END REVIEW & PAY BUTTON -->
	</div>
	<!-- END CHECKOUT DETAILS -->

	<script type="text/javascript">
		var billingAddressSameButton = document.getElementById('billing-address-same');
		var billingAddressDifferentButton = document.getElementById('billing-address-different');
		var billingAddressForm = document.querySelector('.checkoutDetails-billingInformationContainer');

		function showHideForm() {
			billingAddressSameButton.checked === true ? 
			billingAddressForm.style.display = 'none' : 
			billingAddressForm.style.display = 'block';
		}

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

				if (parentElement.querySelector('.checkoutDetails-inputFieldErrors')) {
					var ul = parentElement.querySelector('.checkoutDetails-inputFieldErrors');
					var text = "";

					for (var i = 0; i < errors.length; i++) {	
						text += "<li>" + errors[i] + "</li>";
					};
					
					ul.innerHTML = text;
				} else {
					var ul = document.createElement("ul");
					ul.className = "checkoutDetails-inputFieldErrors";
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
					if (parentChildren[i].classList.contains("checkoutDetails-inputFieldErrors")) {
						parentChildren[i].remove();
					}
				};

				field.classList.add('valid');
			}
		}
	</script>
@stop