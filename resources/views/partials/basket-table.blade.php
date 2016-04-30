<!-- Requires: Cart::content() & Cart::total() -->

<table>
	<!--Table headings-->
	<tr>
		<th>Your Items</th>
		<th>Remove</th>
		<th>Quantity</th>
		<th>Price</th>
	</tr>

	<!--Table products-->
	@if (isset($userCartItems))
		@foreach ($userCartItems as $cartItem)
		<tr>
			<!-- Table Data == Name -->
			<td>{{ $cartItem['name'] }}</td>
			<!-- Table Data == Remove Item -->
			<td class="remove-column">
				{!! Form::open(['url' => '/basket/remove']) !!}
					{!! Form::hidden('rowid', $cartItem['rowid'], null, ['class' => 'form-field']) !!}
					<input type="submit" class="form-remove" value="remove" style="" />
				{!! Form::close() !!}
			</td>
			<!-- Table Data == Update Quantity -->
			<td>
				{!! Form::open(['url' => '/basket/update']) !!}
					{!! Form::text('quantity', $cartItem['qty'], ['class' => 'form-qty']) !!}
					{!! Form::submit('update', ['class' => 'form-update-qty']) !!}
					{!! Form::hidden('rowid', $cartItem['rowid'], null, ['class' => 'form-field']) !!}
				{!! Form::close() !!}
			</td>
			<!-- Table Data = Price -->
			<td>£{{ $cartItem['price'] }}</td>
		</tr>
		@endforeach
	@endif

	<!--Table subtotal-->
	<tr>
		<td class="subtotal"></td>
		<td class="subtotal">Subtotal</td>
		<td class="subtotal"></td>
		<td class="subtotal">£{{ $cartSubtotal }}</td>
	</tr>
</table>