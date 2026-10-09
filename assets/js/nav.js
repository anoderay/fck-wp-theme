/**
 * Mobiler Navigations-Toggle.
 */
( function () {
	var toggle = document.querySelector( '.site-nav__toggle' );
	var nav = document.querySelector( '.site-nav' );

	if ( ! toggle || ! nav ) {
		return;
	}

	toggle.addEventListener( 'click', function () {
		var open = nav.classList.toggle( 'is-open' );
		toggle.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
	} );
} )();
