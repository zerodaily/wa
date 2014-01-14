jQuery(function($){
	$(window).load(function() {
		$('#single-post-slider').flexslider({
			animation: 'fade',
			animationSpeed: 500,
			slideshow: true,
			smoothHeight: true,
			controlNav: false,
			prevText: '<i class="icon-angle-left"></i>',
			nextText: '<i class="icon-angle-right"></i>'
		});
	});
});