/**
 *
 * Materia Lite WordPress Theme by Iceable Themes | https://www.iceablethemes.com
 *
 * Copyright 2017 Mathieu Sarrasin - Iceable Media
 *
 * Theme Customizer sections functions
 *
 */

( function( $ ) {

	// Add Materia Pro upgrade message
	upgrade = $('<a class="materia-customize-pro"></a>')
	.attr('href', "https://www.iceablethemes.com/shop/materia-pro/")
	.attr('target', '_blank')
	.text(materia_customizer_section_l10n.upgrade_pro)
	;
	$('.preview-notice').append(upgrade);
	// Remove accordion click event
	$('.materia-customize-pro').on('click', function(e) {
		e.stopPropagation();
	});

} )( jQuery );
