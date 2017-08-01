/**
 * Materia Lite WordPress Theme by Iceable Themes | https://www.iceablethemes.com
 * Copyright 2017 Mathieu Sarrasin - Iceable Media
 * Javascripts
 *
 * Dependencies:
 * - HoverIntent
 * - Superfish
 */


/* Adjust mobile menu size */
function icfmenusize(){
	var windowWidth = jQuery(window).width();
	// Close mobile menu if window was resized to more than 767px
	if ( windowWidth > 767 ) {
		icfCloseMobileMenu();
	// Otherwise, resize mobile menu to window's size
	} else {
		jQuery("#icefit-mobile-menu>div").width(windowWidth);
	}
}

function icfOpenMobileMenu() {
	if ( ! jQuery( '#icefit-mobile-menu' ).hasClass('open') ) {
		jQuery( '#icefit-mobile-menu' ).show().addClass('open');
		jQuery( '#icefit-mobile-menu > div' ).animate({ "margin-left": "0" }, 300, function(){
			jQuery("head").append('<style id="mobile-menu" type="text/css">#main-wrap > *, #main-wrap #header-wrap > * {display:none} #main-wrap #header-wrap, #main-wrap #header-wrap #icefit-mobile-menu { display: block }</style>');
		});
	}
}

function icfCloseMobileMenu() {
	if ( jQuery( '#icefit-mobile-menu' ).hasClass('open') ) {
		jQuery( '#icefit-mobile-menu' ).removeClass('open');
		jQuery('head #mobile-menu').remove();
		jQuery( '#icefit-mobile-menu > div' ).animate({ "margin-left": "-100%" }, 300).promise().done(function(){
			jQuery( '#icefit-mobile-menu' ).hide();
		});
	}
}

jQuery(window).resize(function(){
	icfmenusize(); // Update Mobile menu size
});

/* --- (document).ready function wrap --- */

jQuery(document).ready(function($){


	/*--- Responsive Dropdown Menu ---*/
	$('#dropdown-menu').change( function () {
		var url = $('#dropdown-menu').val();
		$(location).attr('href',url);
	});

	/*--- Responsive Mobile Menu ---*/
	$('.icefit-mobile-menu-close, #icefit-mobile-menu .search-form').prependTo('#icefit-mobile-menu .main-nav');

	$('.icefit-mobile-menu-open').click(function() {
		icfOpenMobileMenu();
	});

	$('.icefit-mobile-menu-close').click(function() {
		icfCloseMobileMenu();
	});

	icfmenusize();

	/*--- Hookup Superfish ---*/

	$('ul.sf-menu').superfish({
		delay:	700,	// the delay in milliseconds that the mouse can remain outside a submenu without it closing
		animation:	{opacity:'show',height:'show'},	// an object equivalent to first parameter of jQuery’s .animate() method
		speed:	'normal',	// speed of the animation. Equivalent to second parameter of jQuery’s .animate() method
		autoArrows:	false,	// if true, arrow mark-up generated automatically = cleaner source code at expense of initialisation performance
		dropShadows:	false,	// completely disable drop shadows by setting this to false
	});

	/* Remove empty comment reply link wrappers */
	$('div.reply').filter(function() {
		return $.trim($(this).text()) === '';
	}).remove();

	/*--- End of $(document).ready(function() ---*/

});
