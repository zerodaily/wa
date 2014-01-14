jQuery(function($){
	$(document).ready(function(){
		
		if ( $(window).width() > 959 ) {
			$('#posts-carousel-wrap .bxslider').bxSlider({
				responsive: false,
				minSlides: 3,
				maxSlides: 3,
				moveSlides: 3,
				slideWidth: 300,
				slideMargin: 20,
				pager: false,
				auto: true,
				adaptiveHeight: false,
				onSliderLoad: function(){
				  $('#posts-carousel-wrap').removeClass('bx-loading');
				  $('#posts-carousel-wrap li').equalHeights();
				}
			});
		} else {
			$('#posts-carousel-wrap').hide();
		}

	});
});