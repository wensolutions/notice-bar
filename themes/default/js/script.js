jQuery( function( $ ){
	if( $( '.nb-default-wrap' ).hasClass( 'nb-default-always' ) ){

		$( '.nb-default-inner' ).show();
		
	}
	if( GetCookie('nb_hide_notice_bar_close') == 'close' ){

		$( '.nb-default-inner' ).hide();

	}

	if( GetCookie('nb_hide_notice_bar_toggle') == 'bottom-hide' ){

		$( '.nb-defult-postion-bottom .nb-default-inner' ).hide();
		$( '.nb-arrow-up' ).show();
	}

	if( GetCookie('nb_hide_notice_bar_toggle') == 'top-hide' ){

		$( '.nb-defult-postion-top .nb-default-inner, .nb-defult-postion-top-fixed .nb-default-inner' ).hide();
		$( '.nb-arrow-down' ).show();
	}

	$( 'body' ).on( 'click', '#nb-default-close', function(){

		$(this).parent().slideUp('slow');
		
		// Set cookie
		SetCookie( 'nb_hide_notice_bar_close', 'close', 1 );

	});  
	
	$( 'body' ).on( 'click', ".nb-defult-postion-top .nb-arrow-up", function(){

		$(".nb-default-inner").slideUp('slow');
		$(".nb-arrow-down").slideDown('slow');

		// Set cookie
		SetCookie( 'nb_hide_notice_bar_toggle', 'top-hide', 1 );

	});

	$( 'body' ).on( 'click', ".nb-defult-postion-top .nb-arrow-down", function(){

		$(".nb-default-inner").slideDown('slow');
		$(".nb-arrow-down").slideUp('slow');

		SetCookie( 'nb_hide_notice_bar_toggle', 'top-show', 1 );
	});

	$( 'body' ).on( 'click', ".nb-defult-postion-top-fixed .nb-arrow-up", function(){

		$(".nb-default-inner").slideUp('slow');
		$(".nb-arrow-down").slideDown('slow');

		// Set cookie
		SetCookie( 'nb_hide_notice_bar_toggle', 'top-hide', 1 );

	});

	$( 'body' ).on( 'click', ".nb-defult-postion-top-fixed .nb-arrow-down", function(){

		$(".nb-default-inner").slideDown('slow');
		$(".nb-arrow-down").slideUp('slow');

		SetCookie( 'nb_hide_notice_bar_toggle', 'top-show', 1 );
	});

	$( 'body' ).on( 'click', ".nb-defult-postion-bottom .nb-arrow-down", function(){

		$(".nb-default-inner").slideUp('slow');
		$(".nb-arrow-up").slideDown('slow');

		SetCookie( 'nb_hide_notice_bar_toggle', 'bottom-hide', 1 );
	});

	$( 'body' ).on( 'click', ".nb-defult-postion-bottom .nb-arrow-up", function(){

		$(".nb-default-inner").slideDown('slow');
		$(".nb-arrow-up").slideUp('slow');

		SetCookie( 'nb_hide_notice_bar_toggle', 'bottom-show', 1 );
	});

});