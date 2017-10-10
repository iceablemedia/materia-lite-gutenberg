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

if ( is_singular() ) :

	$materia_title = get_the_title();

else :

	/* 404 CONDITIONAL TITLE */
	if ( is_404() ) :
		$materia_title = __( '404: Page Not Found', 'materia-lite' );
	endif;

	/* SEARCH CONDITIONAL TITLE */
	if ( is_search() ) :
		$materia_title = sprintf(
			// Translators: %s is the search term
			esc_html__( 'Search Results for "%s"', 'materia-lite' ),
			get_search_query()
		);
	endif;

	/* ARCHIVE CONDITIONAL TITLE */
	if ( is_archive() ) :
		$materia_title = get_the_archive_title();
	endif;

	/* DEFAULT BLOG INDEX TITLE */
	if ( is_home() && ! is_front_page() ) :
		/* If the blog index is not the front page
		 * then use the "posts page" ( page_for_posts ) title */
		$materia_page_for_posts = get_option( 'page_for_posts' );
		$materia_title = get_the_title( $materia_page_for_posts );
	endif;

endif;

// Breadcrumbs
if ( ! is_front_page() ) :
	?>
	<div id="breadcrumbs"><?php materia_breadcrumbs(); ?></div>
	<?php
endif;

// Display title
if ( $materia_title ) :
	?>
	<h1 class="page-title"><?php echo esc_html( $materia_title ); ?></h1>
	<?php
endif;
