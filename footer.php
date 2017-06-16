<?php
/**
 *
 * Materia Lite WordPress Theme by Iceable Themes | https://www.iceablethemes.com
 *
 * Copyright 2017 Mathieu Sarrasin - Iceable Media
 *
 * Footer Template
 *
 */

if ( is_active_sidebar( 'footer-sidebar' ) ):
  ?><div id="footer"><div class="container cards"><ul><?php
    dynamic_sidebar( 'footer-sidebar' );
  ?></ul></div></div><?php
endif;

?><div id="sub-footer"><div class="container"><?php
  ?><div class="sub-footer-left"><p><?php

/* You are free to modify or replace this by anything you like as per the terms of the GPL license */ ?>

<?php
	printf( __( 'Copyright &copy; %s %s.', 'materia-lite' ), date( 'Y' ), get_bloginfo( 'name' ) );
	echo ' ';
	printf( __( 'Proudly powered by <a href="%s" title="%s">%s</a>.', 'materia-lite' ),
		esc_url( __( 'https://wordpress.org/', 'materia-lite' ) ),
		esc_attr__( 'Semantic Personal Publishing Platform', 'materia-lite' ),
		__( 'WordPress', 'materia-lite' )
	 );
	echo ' ';
	printf( __( 'Materia design by <a href="%s" title="%s">Iceable Themes</a>.', 'materia-lite' ),
		esc_url( 'https://www.iceablethemes.com' ),
		esc_attr( 'Iceablethemes', 'materia-lite' )
	 );
?>

<?php /* Stop editing here */

  ?></p></div>

<div class="sub-footer-right"><?php
    $footer_menu = array( 'theme_location' => 'footer-menu', 'depth' => 1 );
    wp_nav_menu( $footer_menu );
?></div></div></div><?php // End footer

?></div><?php

wp_footer();

?></body></html>
