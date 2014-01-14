jQuery(function($){
	$(window).load(function() {
		$('#featured-flexslider').removeClass('flex-loading');
		if(flexLocalize.slideshow == "true") flexLocalize.slideshow = true; else flexLocalize.slideshow = false;
		if(flexLocalize.randomize == "true") flexLocalize.randomize = true; else flexLocalize.randomize = false;	
		if(flexLocalize.slideshowSpeed !== '') flexLocalize.slideshowSpeed = flexLocalize.slideshowSpeed; else flexLocalize.slideshowSpeed = 7000;
		$('#featured-flexslider').flexslider({
			slideshow : flexLocalize.slideshow,
			controlsContainer: ".flex-container",
			randomize : flexLocalize.randomize,
			animation : flexLocalize.animation,
			direction : flexLocalize.direction,
			slideshowSpeed : flexLocalize.slideshowSpeed,
			pauseOnHover: true,
			animationSpeed : 400,
			smoothHeight : true,
			video: true,
			controlNav : true,
			prevText : '<span class=" icon-angle-left"></span>',
			nextText : '<span class="icon-angle-right"></span>'
		});
	});
});