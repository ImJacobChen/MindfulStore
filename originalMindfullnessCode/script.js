/***************************
		Image Slider
***************************/
$(document).ready(function() {

	//Config
	var width = $('#image-slider').width();
	var animationSpeed = 1000;
	var pause = 4000;
	var currentSlide = 1;

	//cache DOM
	var $imageslider = $('#image-slider');
	var $slides = $imageslider.find('.slides');
	var $slide = $slides.find('.slide');
	var $rightArrow = $('#image-slider').find('.sliderarrowright');
	var $leftArrow = $('#image-slider').find('.sliderarrowleft');
	var $sliderDots = $imageslider.find('.sliderdots');
	var $sliderdot = $sliderDots.find('.sliderdot');
	/**************************************
		Code for the slider on auto run
	**************************************/
	var interval;
	
	//setInterval
		//animate margin-left
		//if it's last slide, go to position 1(0px);
	function startSlider() {
		interval = setInterval(function() {
			if ($sliderDots.children().eq(3).hasClass('activedot')) {
				$sliderDots.children().eq(0).siblings().removeClass('activedot');
				$sliderDots.children().eq(0).addClass('activedot');
			}
			$sliderDots.children('.activedot').removeClass('activedot').next().addClass('activedot');

			$slides.animate({'margin-left': '-='+width}, animationSpeed, function() {
				if(currentSlide === 3) {
					$slides.css('margin-left', 0);
					currentSlide = 1;
				} else {
				currentSlide++;
				}
			});
		}, pause);
	}

	function stopSlider() {
		clearInterval(interval);
	}

	//listen for mouseenter & pause
	//resume on mouse leave
	$imageslider.mouseenter(stopSlider).mouseleave(startSlider);

	//As it only starts on mouseenter otherwise
	startSlider();
	//Starting slider dot
	$sliderdot.first().addClass('activedot');
	/**************************************
		   Code for the slider dots
	**************************************/
	/* - When a slider dot is clicked, show thecorresponding image.
	   - When a slider dot is clicked, add 'active class' to 'this' & remove from siblings */
	$sliderDots.children().eq(1).click(function(){
		currentSlide = 1;
		$slides.animate({'margin-left': 0}, animationSpeed);
		$(this).siblings().removeClass('activedot');
		$(this).addClass('activedot');
	});
	$sliderDots.children().eq(2).click(function(){
		currentSlide = 2;
		$slides.animate({'margin-left': -width*1}, animationSpeed);
		$(this).siblings().removeClass('activedot');
		$(this).addClass('activedot');
	});
	$sliderDots.children().eq(3).click(function(){
		currentSlide = 3;
		$slides.animate({'margin-left': -width*2}, animationSpeed);
		$(this).siblings().removeClass('activedot');
		$(this).addClass('activedot');
	});
});