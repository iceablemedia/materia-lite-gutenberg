<?php
/**
 *
 * Materia Lite WordPress Theme by Iceable Themes | https://www.iceablethemes.com
 *
 * Copyright 2017 Mathieu Sarrasin - Iceable Media
 *
 * Page Template
 *
 */

get_header();

$sidebar_side = get_post_meta(get_the_ID(), 'materia_pagesettings_sidebar_side', true);

?><main class="container"><?php

get_template_part( 'page-title' );

?><div id="single-container" class="single-container with-sidebar"><?php

  if(have_posts()):
  while(have_posts()) : the_post();

  ?><div id="page-<?php the_ID(); ?>" <?php post_class( 'entry-wrap' ); ?>><?php

    /* Post thumbnail (Featured Image) */
    if ( '' != get_the_post_thumbnail() ) :
      ?><div class="thumbnail"><?php
            the_post_thumbnail('large', array('class' => ''));
      ?></div><?php
    endif;

      ?><div id="page-container" class="post-content entry-content"><?php

						the_content();

  		?></div><?php

      $materia_link_pages_args = array(
        'before'           => '<br class="clear" /><div class="paged_nav"><span>' . __('Pages:', 'icefit') . '</span>',
        'after'            => '</div>',
        'link_before'      => '<span>',
        'link_after'       => '</span>',
        'next_or_number'   => 'number',
        'nextpagelink'     => __('Next page', 'icefit'),
        'previouspagelink' => __('Previous page', 'icefit'),
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

  else: // Empty loop (this should never happen!)

    ?><h2><?php _e('Not Found', 'icefit'); ?></h2>
    <p><?php _e('What you are looking for isn\'t here...', 'icefit'); ?></p><?php

  endif;

  ?></div><?php // End single container

  ?><div id="sidebar-container"><?php
    get_sidebar();
	?></div><?php

?></main><?php //  End main content

get_footer();
