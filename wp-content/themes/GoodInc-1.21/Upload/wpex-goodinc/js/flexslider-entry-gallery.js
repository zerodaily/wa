jQuery(function($){
	$(window).load(function() {
		$('.gallery-entry-slider').flexslider({
			animation: 'fade',
			animationSpeed: 500,
			slideshow: true,
			smoothHeight: true,
			controlNav: true,
			prevText: '<i class="icon-angle-left"></i>',
			nextText: '<i class="icon-angle-right"></i>',
			start: function(slider) {
				$('.gallery-entry-slider li').click(function(event){
					event.preventDefault();
					slider.flexAnimate(slider.getTarget("next"));
				});
			}
		});
	});
});