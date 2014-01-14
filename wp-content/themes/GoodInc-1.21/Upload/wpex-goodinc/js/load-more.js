jQuery(function($){
	$(window).load(function() {
		
		/* ajax URL */
		var ajaxUrl = wpexLoadMoreVars.ajaxUrl;
		var loadMoreString = wpexLoadMoreVars.loadMoreString;
		var loadingString = wpexLoadMoreVars.loadingString;
		
		$('div#wpex-load-more').click(function() {
			
			var $this = $(this),
				anchor = $this.children('a'),
				nonce = anchor.val(),
				pagenum = anchor.data('pagenum'),
				maxpage = anchor.data('maxpage'),
				data = {
					action: 'wpex_load_more_query',
					pagenum: pagenum,
					archive_type: anchor.data('archive_type'),
					archive_id: anchor.data('archive_id'),
					archive_month: anchor.data('archive_month'),
					archive_year: anchor.data('archive_year'),
					post_format: anchor.data('post_format'),
					author: anchor.data('author'),
					s: anchor.data('s'),
					security: nonce
				};
				
			anchor.html(loadingString);
				
			$.post( ajaxUrl, data, function(response) {
				content = $(response);
					
					$('div#wpex-load-more a').html(loadMoreString);
					$('div#post-entries').append(content);
					
					$('.wpex-lightbox').magnificPopup({ type: 'image' });
					if ( twttr ) { twttr.widgets.load(); }
					$(".fitvids").fitVids();
					$('.fitvids-audio').fitVids( { customSelector: "iframe[src^='https://w.soundcloud.com']"} );
					$('.wpex-fadein').css({ opacity: 1 });
					
					content.css({ opacity: 0 });
					content.children('img').imagesLoaded(function() {
						content.animate({ opacity: 1 }, 'normal');
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
				
				anchor.data('pagenum', pagenum + 1);
				
				if(pagenum >= maxpage) {
					$this.fadeOut();
				}
				
			});
			
			return false;
			
		});
		
	}); /* END window ready */
}); /* END function */