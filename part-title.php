<?php
/**
 *
 * Materia Lite WordPress Theme by Iceable Themes | https://www.iceablethemes.com
 *
 * Copyright 2017 Mathieu Sarrasin - Iceable Media
 *
 * Page Title & Breadcrumbs
 *
 */

$materia_title = '';

if ( is_singular() ):

  $materia_title = get_the_title();

else:

  /* 404 CONDITIONAL TITLE */
  if ( is_404() ):
    $materia_title =  __( '404: Page Not Found', 'materia-lite' );
  endif;

  /* SEARCH CONDITIONAL TITLE */
  if ( is_search() ):
    $materia_title = sprintf( __( 'Search Results for "%s"', 'materia-lite' ), get_search_query() );
  endif;

  /* TAG CONDITIONAL TITLE */
  if ( is_tag() ):
    $materia_title = sprintf( __( 'Tag: %s', 'materia-lite' ), single_tag_title( '', false ) );
  endif;

  /* CATEGORY CONDITIONAL TITLE */
  if ( is_category() ):
    $materia_title = sprintf( __( 'Category: %s', 'materia-lite' ), single_cat_title( '', false ) );
  endif;

  /* ARCHIVES CONDITIONAL TITLE */
  if ( is_day() ):
    $materia_title = sprintf( __( 'Daily archives: %s', 'materia-lite' ), get_the_time( 'F jS, Y' ) );
  endif;

  if ( is_month() ):
    $materia_title = sprintf( __( 'Monthly archives: %s', 'materia-lite' ), get_the_time( 'F, Y' ) );
  endif;

  if ( is_year() ):
    $materia_title = sprintf( __( 'Yearly archives: %s', 'materia-lite' ), get_the_time( 'Y' ) );
  endif;

  /* DEFAULT BLOG INDEX TITLE */
  if ( is_home() && !is_front_page() ):
		/* If the blog index is not the front page
		 * then use the "posts page" ( page_for_posts ) title */
		$materia_page_for_posts = get_option( 'page_for_posts' );
		$materia_title = get_the_title( $materia_page_for_posts );
	endif;

endif;

// Breadcrumbs
if ( !is_front_page() ):
  ?><div id="breadcrumbs"><?php materia_breadcrumbs(); ?></div><?php
endif;

// Display title
if ( $materia_title ):
  ?><h1 class="page-title"><?php echo $materia_title; ?></h1><?php
endif;
