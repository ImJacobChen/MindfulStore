@extends('app')

@section('content')

@if (isset($s))
	<p>Showing search results for: <strong>{{ $s }}</strong></p>
@endif
<br>
<ul class="search-results">
	@foreach ($products as $product)
		<li class="list-item"><a href="{{ url('/product', $product->id) }}">
				{!! Html::image($product->img, $product->description) !!}
				<span class='item-title'><h3>{{ $product->name }}</h3></span>
				<span class='item-price'>£ {{ $product->price }}</span>
				<span class='item-description'><p>{{ $product->description }}</p></span>
		</a></li>		
	@endforeach
</ul>
@stop