<?php
/**
 *
 * Materia Lite WordPress Theme by Iceable Themes | https://www.iceablethemes.com
 *
 * Copyright 2017 Mathieu Sarrasin - Iceable Media
 *
 * 404 Page Template
 *
 */

 get_header();

 ?><main class="container"><?php

 get_template_part( 'page-title' );

 ?><div id="single-container" class="single-container with-sidebar"><?php

   ?><div id="page-<?php the_ID(); ?>" <?php post_class( 'entry-wrap type-page' ); ?>><?php

       ?><div id="page-container" class="post-content entry-content"><?php

         ?><h2><?php _e('Page Not Found', 'blackoot-lite'); ?></h2><?php
         ?><p><?php _e('What you are looking for isn\'t here...', 'blackoot-lite'); ?></p><?php
         ?><p><?php _e('Maybe a search will help ?', 'blackoot-lite'); ?></p><?php
         ?><p><?php get_search_form(); ?></p><?php

   		?></div><?php

     ?></div><?php // end page

   ?></div><?php // End single container

   ?><div id="sidebar-container"><?php
     get_sidebar();
 	?></div><?php

 ?></main><?php //  End main content

 get_footer();
