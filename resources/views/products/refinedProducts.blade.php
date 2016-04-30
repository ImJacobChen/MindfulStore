@foreach ($products as $product)
<li class="list-item"><a href="{{ url('/product', $product->id) }}"><span class="item-info">
	{!! Html::image($product->img, $product->name + " image") !!}
	<span class='item-title'><p> {{ $product->name }}</p></span>
	<span class='item-price'><p>£{{ $product->price }}</p></span>
</span></a></li>
@endforeach
