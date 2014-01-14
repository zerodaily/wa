jQuery(function($){
	$(window).load(function() {
		$('.wpex-widget-featured-posts-slider').flexslider({
			animation: 'fade',
			animationSpeed: 300,
			slideshow: false,
			smoothHeight: true,
			directionNav: true,
			controlNav: false,
			prevText: '<i class="icon-angle-left"></i>',
			nextText: '<i class="icon-angle-right"></i>'
		});
	});
});