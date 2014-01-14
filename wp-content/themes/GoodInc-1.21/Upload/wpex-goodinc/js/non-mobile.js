jQuery( function($) {
	$(window).load( function() {
		var stickyHeaderTop = $('#navigation-wrap.fixed-scroll').offset().top;
		$(window).scroll(function(){
			if ( $(window).scrollTop() > stickyHeaderTop ) {
				$('#navigation-wrap').addClass( 'fixed-nav' );
				$('#wrap').addClass( 'fixed-nav-padding');
			} else {
				$('#navigation-wrap').removeClass( 'fixed-nav');
				$('#wrap').removeClass( 'fixed-nav-padding');
			}
		});		
	});
});