@extends('app')

@section('content')
<head>
	<script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
</head>
		<p class="quote-box">
			"Drink your tea slowly and reverently, as if it is the axis 
			on which the world earth revolves - slowly, evenly, without
			rushing toward the future, live the actual moment." - Thich Nhat Hanh
		</p>

		<div class="productLine">
			<div class="productLine-title">
				<h3>Artwork</h3>
			</div>
			<div class="productLine-container">
				<div class="productLine-productsContainer">
					@foreach ($artwork as $art)
						<a href="{{ url('/product', $art->id) }}">
						{!! Html::image($art->img, $art->name) !!}
						</a>
					@endforeach
				</div>
			</div>
		</div><!--End of Product Line-->

		
  	<div class="slider">
   		<ul class="slides">
      		<li>
        		{!! Html::image('img/zen.jpg', 'buddha facing the waves') !!}
        		<div class="caption center-align">
          			<h3>Welcome to The Mindful Store!</h3>
          			<h5 class="light grey-text text-lighten-3">Where you can find items for more mindful living.</h5>
        		</div>
      		</li>
    	    <li>
        		<img src="http://lorempixel.com/580/250/nature/2"> <!-- random image -->
        		<div class="caption left-align">
          			<h3>Left Aligned Caption</h3>
          			<h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
        		</div>
      		</li>
      		<li>
        		<img src="http://lorempixel.com/580/250/nature/3"> <!-- random image -->
        		<div class="caption right-align">
            		<h3>Right Aligned Caption</h3>
            		<h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
        		</div>
      		</li>
      		<li>
        		<img src="http://lorempixel.com/580/250/nature/4"> <!-- random image -->
        		<div class="caption center-align">
          			<h3>This is our big Tagline!</h3>
          			<h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
        		</div>
      		</li>
    	</ul>
  	</div>
      

		<div class="productLine">
			<div class="productLine-title">
				<h3>Ornaments</h3>
			</div>
			<div class="productLine-container">
				<div class="productLine-productsContainer">
					@foreach ($ornaments as $ornament)
						<a href="{{ url('/product', $ornament->id) }}">
						{!! Html::image($ornament->img, $ornament->name) !!}
						</a>
					@endforeach
				</div>
			</div>
		</div><!--End of Product Line-->

		<div class="productLine">
			<div class="productLine-title">
				<h3>Decals</h3>
			</div>
			<div class="productLine-container">
				<div class="productLine-productsContainer">
					@foreach ($decals as $decal)
						<a href="{{ url('/product', $decal->id) }}">
						{!! Html::image($decal->img, $decal->name) !!}
						</a>
					@endforeach
				</div>
			</div>
		</div><!--End of Product Line-->

		<div class="social-box">
			<h2>The Mindfullness Social</h2>
		</div>

	</div><!--End of Wrapper-->
	<script type="text/javascript">
	    $(document).ready(function(){
	      $('.slider').slider({full_width: true});
	    });  
	</script>
@stop