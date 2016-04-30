<?php 
	require_once('includes/init.php');
	include(ROOT_PATH . 'includes/partials/header.php'); 
?>
<head>
	<script type="text/javascript" src="script.js"></script>
</head>
		<p align="center" style="margin: 20px 0 0 0">Welcome to The Mindfullness Shop</p>

		<div class="product-line">
			<div class="line-title">
				<h1>Artwork</h1>
			</div>
			<div class="line-container">
				<div class="products-container">
					<?php echo get_side_scroller_list_html('artwork'); ?>
				</div>
			</div>
		</div><!--End of Product Line-->

		<div id="image-slider">
			<ul class="slides">
				<li class="slide">
					<img src="images/zen-stones-sand.jpg">
				</li>
				<li class="slide">
					<img src="images/zen-art-desktop-wallpaper-1600x1200.jpg">
				</li>
				<li class="slide">
					<img src="images/zen.jpg">
				</li>
				<li class="slide">
					<img src="images/zen-stones-sand.jpg">
				</li>
			</ul>
			<div class="sliderdots">
				<div class="hidden_dot"></div>
				<div class="sliderdot"></div>
				<div class="sliderdot"></div>
				<div class="sliderdot"></div>
			</div>
		</div><!--End of Image Slider-->

		<div class="product-line">
			<div class="line-title">
				<h1>Ornaments</h1>
			</div>
			<div class="line-container">
				<div class="products-container">
					<?php echo get_side_scroller_list_html('ornament'); ?>
				</div>
			</div>
		</div><!--End of Product Line-->

		<div class="product-line">
			<div class="line-title">
				<h1>Decals</h1>
			</div>
			<div class="line-container">
				<div class="products-container">
					<?php echo get_side_scroller_list_html('decal'); ?>
				</div>
			</div>
		</div><!--End of Product Line-->

		<div class="social-box">
			<h1>The Mindfullness Shop Social</h1>
		</div>

		<?php include('includes/partials/footer.php'); ?>
	</div><!--End of Wrapper-->

</body>