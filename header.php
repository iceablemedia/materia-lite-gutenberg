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
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes( 'html' ); ?>><!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
$favicon = get_theme_mod('materia_favicon');
if ($favicon):
	?><link rel="shortcut icon" href="<?php echo esc_url( $favicon ); ?>" /><?php
endif;
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

    if ( get_theme_mod( 'materia_logo' ) ) :

      ?><h1 class="site-title" style="display:none"><?php echo bloginfo('name'); ?></h1><?php

      ?><div id="logo"><a href="<?php echo esc_url( home_url() ); ?>" title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'>
          <img src="<?php echo esc_url( get_theme_mod( 'materia_logo' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
      </a></div><?php // End #logo

    else:

      ?><h1 class="site-title">
        <a class="site-title-link" href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo('name'); ?></a>
      </h1><?php

    endif;

    if ( get_bloginfo ( 'description' ) ):
      ?><div id="tagline"><?php bloginfo('description'); ?></div><?php
    endif;

    ?></div>
  </div><?php // End #header


  get_template_part( 'navbar' );

  // Header image
	if ( get_custom_header()->url ) :
		if ( ( is_front_page() && get_theme_mod( 'home_header_image' ) != 'off' )
			|| ( is_page() && !is_front_page() && get_theme_mod(' pages_header_image' ) != 'off' )
			|| ( is_single() && get_theme_mod( 'single_header_image' ) != 'off' )
			|| ( !is_front_page() && !is_singular() && get_theme_mod( 'blog_header_image' ) != 'off' )
			|| ( is_404() ) ):
				$display_mode = get_theme_mod( 'header_image_display_mode' );
				$header_image_src = get_header_image();
				$image_height = get_custom_header()->height;
				$image_width = get_custom_header()->width;
				$heading = get_theme_mod( 'header_image_heading' );
				$subheading = get_theme_mod( 'header_image_subheading' );
				$headings_color = get_theme_mod( 'header_image_headings_color', '#ffffff' );
				$link_1_text				= get_theme_mod( 'header_image_button_1_text' );
				$link_1_url					= get_theme_mod( 'header_image_button_1_link' );
				$link_2_text				= get_theme_mod( 'header_image_button_2_text' );
				$link_2_url					= get_theme_mod( 'header_image_button_2_link' );
			endif;
		endif;


  if ( $header_image_src ):

  	?><div id="header-image"<?php
  		if ( $display_mode == 'card' ) echo ' class="container"';
  		if ( $display_mode == 'full-width' ) echo ' class="full-width" style="background-image: url('.$header_image_src.'); height:'.$image_height.'px"';
  	?>><?php

  		if ( $display_mode == 'card' ) :
  			?><img class="cards" src="<?php echo $header_image_src; ?>" height="<?php echo $image_height; ?>" width="<?php echo $image_width; ?>" alt="" /><?php
  		endif;

  		if ( $heading || $subheading || $link_1_text || $link_2_text ):
  			?><div class="head-img-content"><?php
  				if ( $heading ):
  					?><div class="head-img-heading" style="color: <?php echo $headings_color; ?>"><?php echo $heading; ?></div><?php
  				endif;
  				if ( $subheading ):
  					?><div class="head-img-subheading" style="color: <?php echo $headings_color; ?>"><?php echo $subheading; ?></div><?php
  				endif;
  				$button_1 = ( $link_1_text ) ? '<a class="button raised-button button-flat" href="'.$link_1_url.'">'.$link_1_text.'</a>' : '';
  				$button_2 = ( $link_2_text ) ? '<a class="button raised-button default" href="'.$link_2_url.'">'.$link_2_text.'</a>' : '';
  				if ( $button_1 || $button_2 ):
  					?><div class="head-img-button-wrap"><?php echo $button_1, $button_2; ?></div><?php
  				endif;
  			?></div><?php
  		endif;

  	?></div><?php

  endif;
