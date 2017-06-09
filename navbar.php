<?php
/**
 *
 * Materia Lite WordPress Theme by Iceable Themes | https://www.iceablethemes.com
 *
 * Copyright 2017 Mathieu Sarrasin - Iceable Media
 *
 * Navbar template
 *
 */

/* #nav-wrap */
?><div id="nav-wrap"><?php

$responsive_menu = 'mobile'; // TODO

if ( $responsive_menu == 'mobile' ):
 ?><span class="icefit-mobile-menu-open"><i class="fa fa-bars"></i></span><?php
endif;

?><div id="navbar" class="container"><?php

  wp_nav_menu( array(
    'container' => 'nav',
    'container_class' => 'navigation main-nav',
    'theme_location' => 'primary',
    'items_wrap' => '<ul id="%1$s" class="%2$s sf-menu">%3$s</ul>',
    'fallback_cb' => 'materia_fallback_menu',
    ) );
 if ( $responsive_menu == 'dropdown' ) materia_dropdown_nav_menu();
 ?></div>

</div><?php // End #nav-wrap

if ( $responsive_menu == 'mobile' ):
  ?><div id="icefit-mobile-menu"><?php
        $before_mobile_menu = '<span class="icefit-mobile-menu-close"><i class="fa fa-times-circle"></i></span>' . get_search_form(false);
        wp_nav_menu( array( 'theme_location' => 'primary', 'items_wrap' => $before_mobile_menu . '<ul id="%1$s" class="%2$s">%3$s</ul>', ) );
    ?></div><?php
  endif;
