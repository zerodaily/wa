jQuery(function($){
	$(window).load(function() {
		var $container = $('#post-entries');
		$container.infinitescroll({
			loading: {
				msg: null,
				finishedMsg : null,
				msgText : null,
				msgText: '<div class="infinite-scroll-loader"><i class="icon-spinner icon-spin"></i></div>',
			},
			navSelector  : 'div.infinite-scroll-nav',
			nextSelector : 'div.infinite-scroll-nav div.older-posts a',
			itemSelector : '.post-entry',
		}, function( newElements ) {
			// Start callback
			var $newElems = $( newElements );
			$newElems.imagesLoaded(function() {
				$('.gallery-entry-slider').flexslider({
					animation: 'fade',
					animationSpeed: 500,
					slideshow: true,
					smoothHeight: true,
					controlNav: false,
					prevText: '<i class="icon-angle-left"></i>',
					nextText: '<i class="icon-angle-right"></i>',
					start: function(slider) {
						$('.gallery-entry-slider li').click(function(event){
							event.preventDefault();
							slider.flexAnimate(slider.getTarget("next"));
						});
					}
				});  // end flexslider()
			}); // end imagesLoaded()
			if ( twttr ) { twttr.widgets.load(); }
			$('.wpex-lightbox').magnificPopup({ type: 'image' });
			$(".fitvids").fitVids();
			$('.fitvids-audio').fitVids( { customSelector: "iframe[src^='https://w.soundcloud.com']"} );
			$('.wpex-fadein').css({ opacity: 1 });
		});
	});
});