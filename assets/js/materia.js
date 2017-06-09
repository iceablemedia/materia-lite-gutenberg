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
	jQuery("#icefit-mobile-menu>div").width(jQuery(window).width());
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
	jQuery('.icefit-mobile-menu-open').click(function() {
		jQuery( '#icefit-mobile-menu' ).show();
		jQuery( '#icefit-mobile-menu > div' ).animate({ "margin-left": "0" }, 300, function(){
			jQuery("head").append('<style id="mobile-menu" type="text/css">#main-wrap > *, #main-wrap #header-wrap > * {display:none} #main-wrap #header-wrap, #main-wrap #header-wrap #icefit-mobile-menu { display: block }</style>');
		});
	});

	jQuery('.icefit-mobile-menu-close').click(function() {
		jQuery('head #mobile-menu').remove();
		jQuery( '#icefit-mobile-menu > div' ).animate({ "margin-left": "-100%" }, 300).promise().done(function(){
			jQuery( '#icefit-mobile-menu' ).hide();
		});

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
