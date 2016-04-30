@extends('app')
	
@section('content')

<div class="main">
		<div class="sort-buttons">
			<div id="refine-button">
				<p>Refine Items</p>
				{!! Html::image('img/arrow-down.png', 'arrow down icon') !!}
			</div>
			<div class="sort-button">
				<p>Sort by:</p>
				<form>
					<select id="sort-by">
						<option>-</option>
						<option value="price-low-to-high">Price: Low to High</option>
						<option value="price-high-to-low">Price: High to Low</option>
						<option value="newest-items-first">Newest Items first</option>
						<option value="oldest-items-first">Oldest Items first</option>
					</select>
				</form>
			</div>
		</div>

		<div id="refine-items">
			<h3>Price</h3>
			<form id="price-form" align="center">
				<div id="min-price-div">
					Min: £ <input id="min-price" type="text" value=""><br>
							<input type="range" id="min-price-range" min="0" max="100" step="1">
				</div>
				<div id="max-price-div">
					Max: £ <input id="max-price" type="text" value=""><br>
							<input type="range" id="max-price-range" min="0" max="100" step="1">
				</div> 
			</form>


			<h3>Type</h3>
			<div>
				<ul id='refine-type-list'>
					<li id='refine-type-item'>Ornament</li>
					<li id='refine-type-item'>Artwork</li>
					<li id='refine-type-item'>Stickers</li>
					<li id='refine-type-item'>Decal</li>
				</ul>
			</div>
			{!! Form::submit('Refine+', ['class' => 'refine-submit']) !!}
			<!--input type="button" class="refine-submit" value="Refine+" onclick="refineResults()"-->
		</div>

		<ul id="list">
			@foreach($products as $product)
			<li class="list-item"><a href="{{ url('/product', $product->id) }}">
				{!! Html::image($product->img, $product->name) !!}
				<span class='item-info'>
					<span class='item-title'>
						<p>{{ $product->name }}</p>
					</span>
					<span class='item-price'>
						<p>£ {{ $product->price }}</p>
					</span>
				</span>
			</a></li>
			@endforeach
		</ul><!--End of List-->
	</div>

</div><!--End of Wrapper-->



<script>
	var query = "";
	/*
	* Toggles the 'selected' class for the refine items type
	*/ 
	var toggleClass = function () {
		this.classList.toggle('selected');
	};

	/*
	* Add the toggle class event listener to all refine type items
	*/
	var listItem = document.querySelectorAll('#refine-type-item');
	for (i=0; i<listItem.length; i++) {
		listItem[i].addEventListener('click', toggleClass, false);
	}

	/*
	*	Functions to match the price sliders and price text inputs on change
	*/
	var minPriceText = document.getElementById('min-price');
	var maxPriceText = document.getElementById('max-price');
	var minPriceSlider = document.getElementById('min-price-range');
	var maxPriceSlider = document.getElementById('max-price-range');
	function minTextChange() {
		minPriceSlider.value = minPriceText.value;
	}
	function minSliderChange() {
		minPriceText.value = minPriceSlider.value;
	}
	function maxTextChange() {
		maxPriceSlider.value = maxPriceText.value;
	}
	function maxSliderChange() {
		maxPriceText.value = maxPriceSlider.value;
	}
	minPriceText.addEventListener('change', minTextChange, false);
	maxPriceText.addEventListener('change', maxTextChange, false);
	minPriceSlider.addEventListener('change', minSliderChange, false);
	maxPriceSlider.addEventListener('change', maxSliderChange, false);

	/*
	* The following code will allow the refine items section to toggle
	*/
	var refineItemsButton = document.getElementById('refine-button');
	var refineItemsPanel = document.getElementById('refine-items');
	var refineButtonArrow = refineItemsButton.querySelector('img');
	function toggleRefineItemsPanel() {
		if (refineItemsPanel.style.display === 'none') {
			refineItemsPanel.style.display = 'block';
			refineButtonArrow.style.webkitTransform = 'rotate(-180deg)'; 
			refineButtonArrow.style.mozTransform    = 'rotate(-180deg)'; 
			refineButtonArrow.style.msTransform     = 'rotate(-180deg)'; 
			refineButtonArrow.style.oTransform      = 'rotate(-180deg)'; 
			refineButtonArrow.style.transform       = 'rotate(-180deg)'; 
		} else {
			refineItemsPanel.style.display = 'none';
			refineButtonArrow.style.webkitTransform = 'rotate(0deg)'; 
			refineButtonArrow.style.mozTransform    = 'rotate(0deg)'; 
			refineButtonArrow.style.msTransform     = 'rotate(0deg)'; 
			refineButtonArrow.style.oTransform      = 'rotate(0deg)'; 
			refineButtonArrow.style.transform       = 'rotate(0deg)'; 
		}
	}
	refineItemsButton.addEventListener('click', toggleRefineItemsPanel, false);


	$(document).on('click', '.refine-submit', function(e){
		refineResults();
		refineItemsPanel.style.display = 'none';
	});
	/* **********************************************
	* Function to ajax call the refine items results
	*
	*
	*
	*
	* **********************************************/
	function refineResults() {
		/*
		* The following code gathers the 'type' refine options and builds a string which it adds to the query
		*/
		var listItemParent = document.getElementById('refine-type-list');  //List ul
		var listItem = document.querySelectorAll('#refine-type-item');	   //List li's
		var refineArguments = [];										   //Arguments Array		  

		for (i=0; i<listItem.length; i++) {								   //Loop through list items
			if (listItem[i].classList.contains('selected')) {			   //If the list item has 'selected' class
				refineArguments.push(listItem[i].innerHTML);			   //Add the list item name to refineArgs array
			}
		}

		/*
		* The following code gets the selected 'sort by' option.
		*/
		var sortBy = document.getElementById('sort-by').value;			   //Get the sortby value

		/*
		* The following code handles the refine by 'price' elements
		*/
		var minPrice = document.getElementById('min-price').value;
		var maxPrice = document.getElementById('max-price').value;
		var priceForm = document.getElementById('price-form');
		var minPriceDiv = document.getElementById('min-price-div');
		var maxPriceDiv = document.getElementById('max-price-div');
		var minPriceData = "";
		var maxPriceData = "";

		/*
		*	This section makes sure that there is an for the Min Price input and that the input is a valid number.
		*   If it isnt a valid number it will append an error to the corresponding box.
		*/
		if (isNaN(parseInt(minPrice))) {												//If from price is not a number
			if (minPrice != "") {														//If the minimum price has a value
				if (minPriceDiv.querySelectorAll("p").length === 0) {					//If there is no elements with class maximum-price-error
					var errorMessage = document.createElement('p');						//Create an error message element
					minPriceDiv.appendChild(errorMessage);								//Append the message to the price form
					errorMessage.innerHTML = 'Please enter a valid minimum price.';		//Set the message text
					console.log(priceForm.querySelector("p"));
				}
			}
		} else {																//Else
			if (minPriceDiv.querySelectorAll("p").length === 1) { 				//If there is an error message in the element
				minPriceDiv.querySelector('p').remove();						//Remove that element
			}
		}
		/*
		*	This section makes sure that there is an for the Max Price input and that the input is a valid number.
		*   If it isnt a valid number it will append an error to the corresponding box.
		*/
		if (isNaN(parseInt(maxPrice))) {												//If the to price is not a number
			if (maxPrice != "") {														//If the minimum price has a value
				if (maxPriceDiv.querySelectorAll("p").length === 0) {					//If there is no error message
					var errorMessage = document.createElement('p');						//Create an error message element
					maxPriceDiv.appendChild(errorMessage);								//Append the message to the price form
					errorMessage.innerHTML = 'Please enter a valid maximum price.';		//Set the message text
				}					
			}
		} else {																//Else
			if (maxPriceDiv.querySelectorAll("p").length === 1) { 				//If there is a error message in the element
				maxPriceDiv.querySelector('p').remove();						//Remove the error message
			}		
										//Add the to price to the price query
		}
		
		//if (priceQuery.length > 5) {							//If the price query string length > 5 we know it contains a valid argument
		//	query += priceQuery;								//Add the price query to the full query
		//}
		$.ajax({
			url: '/products/refine',
			data: { minPrice, maxPrice, refineArguments, sortBy }
		}).done(function(data) {
			$('#list').html(data);
		});
	}
</script>
@stop