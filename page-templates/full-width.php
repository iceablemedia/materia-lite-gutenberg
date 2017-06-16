<?php
/**
 *
 * Materia Lite WordPress Theme by Iceable Themes | https://www.iceablethemes.com
 *
 * Copyright 2017 Mathieu Sarrasin - Iceable Media
 *
 * Template Name: Full-width Page Template, No Sidebar
 *
 */

get_header();

?><main class="container"><?php

get_template_part( 'page-title' );

?><div id="single-container" class="single-container"><?php

  if( have_posts() ):
  while( have_posts() ) : the_post();

  ?><div id="page-<?php the_ID(); ?>" <?php post_class( 'entry-wrap' ); ?>><?php

    /* Post thumbnail ( Featured Image ) */
    if ( '' != get_the_post_thumbnail() ) :
      ?><div class="thumbnail"><?php
            the_post_thumbnail( 'large', array( 'class' => '' ) );
      ?></div><?php
    endif;

      ?><div id="page-container" class="post-content entry-content"><?php

						the_content();

  		?></div><?php

      $materia_link_pages_args = array(
        'before'           => '<br class="clear" /><div class="paged_nav"><span>' . __( 'Pages:', 'materia-lite' ) . '</span>',
        'after'            => '</div>',
        'link_before'      => '<span>',
        'link_after'       => '</span>',
        'next_or_number'   => 'number',
        'nextpagelink'     => __( 'Next page', 'materia-lite' ),
        'previouspagelink' => __( 'Previous page', 'materia-lite' ),
        'pagelink'         => '%',
        'echo'             => 1
      );
      wp_link_pages( $materia_link_pages_args );

    ?></div><?php // end page


    // Display comments section only if comments are open or if there are comments already.
    if ( comments_open() || get_comments_number()!=0 ):
      ?><div class="comments"><?php
        comments_template( '', true );
      ?></div><?php // end comment section
    endif;

  endwhile;

  else: // Empty loop ( this should never happen! )

    ?><h2><?php _e( 'Not Found', 'materia-lite' ); ?></h2>
    <p><?php _e( 'What you are looking for isn\'t here...', 'materia-lite' ); ?></p><?php

  endif;

  ?></div><?php // End single container

?></main><?php //  End main content

get_footer();
