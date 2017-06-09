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

$title = '';

if ( is_singular() ):

  $title = get_the_title();

else:

  /* 404 CONDITIONAL TITLE */
  if (is_404()):
    $title =  __('404: Page Not Found', 'icefit');
  endif;

  /* SEARCH CONDITIONAL TITLE */
  if ( is_search() ):
    $title = sprintf( __('Search Results for "%s"', 'icefit'), get_search_query() );
  endif;

  /* TAG CONDITIONAL TITLE */
  if ( is_tag() ):
    $title = sprintf( __('Tag: %s', 'icefit'), single_tag_title('', false) );
  endif;

  /* CATEGORY CONDITIONAL TITLE */
  if ( is_category() ):
    $title = sprintf( __('Category: %s', 'icefit'), single_cat_title('', false) );
  endif;

  /* ARCHIVES CONDITIONAL TITLE */
  if ( is_day() ):
    $title = sprintf( __('Daily archives: %s', 'icefit'), get_the_time('F jS, Y') );
  endif;

  if ( is_month() ):
    $title = sprintf( __('Monthly archives: %s', 'icefit'), get_the_time('F, Y') );
  endif;

  if ( is_year() ):
    $title = sprintf( __('Yearly archives: %s', 'icefit'), get_the_time('Y') );
  endif;

  /* DEFAULT BLOG INDEX TITLE */
  if ( is_home() && !is_front_page() ):
		/* If the blog index is not the front page
		 * then use the "posts page" (page_for_posts) title */
		$page_for_posts = get_option('page_for_posts');
		$title = get_the_title($page_for_posts);
	endif;

endif;

// Breadcrumbs
if ( !is_front_page() ):
  ?><div id="breadcrumbs"><?php materia_breadcrumbs(); ?></div><?php
endif;

// Display title
if ($title):
  ?><h1 class="page-title"><?php echo $title; ?></h1><?php
endif;
