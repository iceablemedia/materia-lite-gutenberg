<?php
/**
 *
 * Materia Lite WordPress Theme by Iceable Themes | https://www.iceablethemes.com
 *
 * Copyright 2017 Mathieu Sarrasin - Iceable Media
 *
 * Main Index
 *
 */

get_header();

$blog_sidebar_side = 'right';


?><main class="container"><?php

  get_template_part( 'page-title' );

?><div id="index-container"><?php

  if (is_category() && category_description() ):
  ?><div class="category-description"><?php echo category_description(); ?></div><hr /><?php
  endif;

  if(have_posts()):
  while(have_posts()) : the_post();

  ?><div id="post-<?php the_ID(); ?>" <?php post_class(); ?>><?php

    /* Post thumbnail (Featured Image) */
    if ( '' != get_the_post_thumbnail() ) :
      ?><div class="thumbnail">
          <a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>"><?php
            the_post_thumbnail();
          ?></a><?php
      ?></div><?php
    endif;

    ?><div class="entry-wrap"><?php

      ?><h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php
    		the_title();
    	?></a></h3><?php

      ?><div class="entry-meta"><?php

    		/* Meta: Date */
    		?><span class="meta-date post-date updated"><?php
    			echo sprintf( __('Posted on %s'), '<a href="'.  get_permalink() . '" title="<?php the_title(); ?>" rel="bookmark">' . get_the_time( get_option( 'date_format' ) ) . '</a>' );
        ?></span><?php

    		/* Meta: Author */
    		$author = sprintf( '<a class="fn" href="%1$s" title="%2$s" rel="author">%3$s</a>',
    			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
    			esc_attr( sprintf( __( 'View all posts by %s', 'icefit' ), get_the_author() ) ),
    			get_the_author() );
    		?><span class="meta-author author vcard"><?php
          echo sprintf( __('by %s'), $author ); ?></span><?php

        /* Meta: Category */
        echo '<span class="meta-category">';
        $cats = array();
        foreach((get_the_category()) as $category):
          $cats[] = '<a href="' . get_category_link($category->term_id ) . '">' . $category->cat_name . '</a>';
        endforeach;
        $categories = implode(', ', $cats);
        echo sprintf( __('in %s'), $categories);
        echo '</span>';

      ?></div><?php // End .entry-meta


      if ( get_post_format() || post_password_required()
  				|| "content" == get_theme_mod('materia_blog_index_content') ):
          ?><div class="post-content entry-content"><?php
          the_content();
        else:
          ?><div class="post-content entry-summary"><?php
          the_excerpt();
        endif;

            if ( materia_has_readmore_link() || ( ( comments_open() || get_comments_number()!=0 )
              && $show_meta_comments != 'single' && $show_meta_comments != 'none' ) ):

              ?><div class="entry-buttons"><?php

              /* Read-more link */
              if ( materia_has_readmore_link() ):
                echo materia_readmore_link( 'flat-button' );
              endif;

              /* Meta: Comments */
              if ( ( comments_open() || get_comments_number()!=0 )
                && $show_meta_comments != 'single' && $show_meta_comments != 'none' ):
                comments_popup_link( __( 'Comment', 'icefit' ), __( 'View 1 Comment', 'icefit' ), __( 'View % Comments', 'icefit' ), 'comment-link flat-button', __('Comments Off', 'icefit') );
              endif;

              ?></div><?php
            endif;


            ?><br class="clear" /><?php

  		?></div><?php

    ?></div><?php // end entry-wrap

    /* Meta: Tags */
    if ( $show_meta_tags != 'single' && $show_meta_tags != 'none' && has_tag() ):

      ?><div class="entry-footer"><?php

          echo '<span class="meta-tags">';
          $tags = get_the_tag_list('', ', ', '');
          echo sprintf( __('Tagged with %s'), $tags );
          echo '</span>';

      ?></div><?php // end entry-footer

    endif;


  ?></div><?php // end post

  endwhile;

  else: // If there is no post in the loop

    if ( is_search() ): // Empty search results

    ?><h2><?php _e('Not Found', 'icefit'); ?></h2>
    <p><?php echo sprintf( __('Your search for "%s" did not return any result.', 'icefit'), get_search_query() ); ?><br />
    <?php _e('Would you like to try another search ?', 'icefit'); ?></p>
    <?php get_search_form();

    else: // Empty loop (this should never happen!)

    ?><h2><?php _e('Not Found', 'icefit'); ?></h2>
    <p><?php _e('What you are looking for isn\'t here...', 'icefit'); ?></p><?php

    endif;

  endif;

  // .page_nav
  ?><div class="page_nav"><?php

    echo materia_index_page_nav();

  ?></div><?php // End .page_nav

  ?></div><?php // End #index-container


  ?><div id="sidebar-container"><?php
    get_sidebar();
  ?></div><?php

  ?></main><?php  //  End main content

get_footer();
