<?php
/**
 *
 * Materia Lite WordPress Theme by Iceable Themes | https://www.iceablethemes.com
 *
 * Copyright 2017 Mathieu Sarrasin - Iceable Media
 *
 * Header Template
 *
 */

?><!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if ( gte IE 9 )|!( IE )]><!--><html <?php language_attributes( 'html' ); ?>><!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
// Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo THEME_DIR_URI; ?>/js/html5.js" type="text/javascript"></script>
<![endif]--><?php

/* The <title> tag is handled by WordPress with title-tag
 * If you add your own title tag here, then make sure to
 * remove_theme_support( 'title-tag' ); to avoid duplication. */ ?>

<?php wp_head();
?></head><?php

?><body <?php body_class(); ?>><?php

/* #main-wrap */
?><div id="main-wrap" class=""><?php

  /* #header */
  ?><div id="header">
    <div class="container"><?php

    if ( get_theme_mod( 'custom_logo' ) ) :

      ?><h1 class="site-title" style="display:none"><?php echo bloginfo( 'name' ); ?></h1><?php

      ?><div id="logo"><a href="<?php echo esc_url( home_url() ); ?>" title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'>
          <?php the_custom_logo(); ?>
      </a></div><?php // End #logo

    else:

      ?><h1 class="site-title">
        <a class="site-title-link" href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo( 'name' ); ?></a>
      </h1><?php

    endif;

    if ( get_bloginfo ( 'description' ) ):
      ?><div id="tagline"><?php bloginfo( 'description' ); ?></div><?php
    endif;

    ?></div>
  </div><?php // End #header


  get_template_part( 'navbar' );

  // Header image
	if ( get_custom_header()->url ) :
		if ( ( is_front_page() && get_theme_mod( 'materia_home_header_image' ) != 'off' )
			|| ( is_page() && !is_front_page() && get_theme_mod( ' materia_pages_header_image' ) != 'off' )
			|| ( is_single() && get_theme_mod( 'materia_single_header_image' ) != 'off' )
			|| ( !is_front_page() && !is_singular() && get_theme_mod( 'materia_blog_header_image' ) != 'off' )
			|| ( is_404() ) ):
				$materia_display_mode				= get_theme_mod( 'materia_header_image_display_mode' );
				$materia_header_image_src		= get_header_image();
				$materia_image_height				= get_custom_header()->height;
				$materia_image_width				= get_custom_header()->width;
			endif;
		endif;


	if ( isset( $materia_header_image_src ) ):
		if ( $materia_header_image_src ):

	  	?><div id="header-image"<?php
	  		if ( $materia_display_mode == 'card' ) echo ' class="container"';
	  		if ( $materia_display_mode == 'full-width' ) echo ' class="full-width" style="background-image: url( '.$materia_header_image_src.' ); height:'.$materia_image_height.'px"';
	  	?>><?php

	  		if ( $materia_display_mode == 'card' ) :
	  			?><img class="cards" src="<?php echo $materia_header_image_src; ?>" height="<?php echo $materia_image_height; ?>" width="<?php echo $materia_image_width; ?>" alt="" /><?php
	  		endif;

	  	?></div><?php

		endif;
	endif;
