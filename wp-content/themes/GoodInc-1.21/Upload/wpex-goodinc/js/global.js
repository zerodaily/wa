jQuery(function($){
	$(document).ready(function() {
	
		/*back to top link*/
		$('li.toplink a').on('click', function(){
			$('html, body').animate({scrollTop:0}, 'normal');
			return false;
		});
		
		/*comment scroll*/
		$("li.comment-scroll a").click(function(event){		
			event.preventDefault();
			$('html,body').animate({ scrollTop:$(this.hash).offset().top + -70}, 'normal' );
		});
					
		/*responsive videos*/
		$(".fitvids").fitVids();
		$('.fitvids-audio').fitVids( { customSelector: "iframe[src^='https://w.soundcloud.com']"} );
		
		/*lightbox*/
		$('.wpex-lightbox').magnificPopup({ type: 'image' });
		$('.wpex-gallery-lightbox').magnificPopup({
			type: 'image',
			gallery: {
			  enabled: true
			}
		});
		
		/*responsive search*/
		$('span#search-responsive-toggle').bind("click touch", function(){
			if ( $(this).hasClass('active-mobile-search') ) {
				$(this).removeClass('active-mobile-search');
				$('div#mobile-search').slideUp('fast');
			} else {
				$(this).addClass('active-mobile-search');
				$('div#mobile-search').slideDown('fast');
			}
		});
		
		/*responsive menu*/
		var jPM = $.jPanelMenu({
			menu: '.nav-main',
			trigger: '#navigation-responsive-toggle',
			direction: 'left',
			animated: false,
			openPosition: '250px',
			keyboardShortcuts: false,
			beforeOpen: function() {
				$('#jPanelMenu-menu').css({ opacity: 1 });
				$('.nav-main').removeClass('dropdown-nav');
			},
			afterClose: function() {
				$('.nav-main').addClass('dropdown-nav');
			}
		});
		
		jPM.on();
		
		$('#jPanelMenu-menu > li.dropdown-li').click( function() {
			$(this).children('a').toggleClass('active');
			$(this).children('ul').stop(true, true).toggle('show');
		});
		$('#jPanelMenu-menu > li.dropdown-li > a').click( function(e) {
			e.preventDefault();
		});
		
		$(window).resize(function() {
			if ( jPM.isOpen() ) {
				jPM.close();
				$('#jPanelMenu-menu').hide();
				$('.nav-main').addClass('dropdown-nav');
			}
		});
		
	}); // $(document).ready(function()
	
	$(window).load(function() {		
		$('.wpex-fadein').animate({ opacity: 1 });
	});
	
});