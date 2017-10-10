<?php
/**
 *
 * Materia Lite WordPress Theme by Iceable Themes | https://www.iceablethemes.com
 *
 * Copyright 2017 Mathieu Sarrasin - Iceable Media
 *
 * Single post
 *
 */

get_header();

?>
<main class="container">

	<?php get_template_part( 'part-title' ); ?>

	<div id="single-container" class="single-container with-sidebar">
		<?php

		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();

				?>
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php

					/* Post thumbnail ( Featured Image ) */
					if ( '' !== get_the_post_thumbnail() ) :
						?>
						<div class="thumbnail">
							<?php the_post_thumbnail(); ?>
						</div>
						<?php
					endif;

					?>
					<div class="entry-wrap">
						<div class="entry-meta">
							<?php

							/* Entry title */
							?>
							<span class="entry-title hatom-feed-info">
								<?php the_title(); ?>
							</span>
							<?php

							/* Meta: Date */
							?>
							<span class="meta-date post-date updated icon-chip link">
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><i class="fa fa-calendar" aria-hidden="true"></i>
									<?php echo esc_html( get_the_time( get_option( 'date_format' ) ) ); ?>
								</a>
							</span>
							<?php

							/* Meta: Author */
							$materia_author = sprintf(
								'<a class="fn" href="%1$s" title="%2$s" rel="author"><i class="fa fa-user" aria-hidden="true"></i>%3$s</a>',
								esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
								esc_attr(
									sprintf(
										// Translators: %s is the author's name
										__( 'View all posts by %s', 'materia-lite' ),
										get_the_author()
									)
								),
								get_the_author()
							);
							?>
							<span class="meta-author author vcard icon-chip link">
								<?php echo wp_kses_post( $materia_author ); ?>
							</span>
							<?php

							/* Meta: Category */
							$materia_cats = array();
							foreach ( ( get_the_category() ) as $materia_category ) :
								$materia_cats[] = '<span class="meta-category icon-chip link"><a href="' . get_category_link( $materia_category->term_id ) . '"><i class="fa fa-tag" aria-hidden="true"></i>' . $materia_category->cat_name . '</a></span>';
							endforeach;
							$materia_categories = implode( '', $materia_cats );
							echo wp_kses_post( $materia_categories );

							?>
						</div>

						<div class="post-content entry-content">
							<?php the_content(); ?>
						</div>
						<?php

						wp_link_pages(
							array(
								'before'           => '<br class="clear" /><div class="paged_nav"><span>' . __( 'Pages:', 'materia-lite' ) . '</span>',
								'after'            => '</div>',
								'link_before'      => '<span>',
								'link_after'       => '</span>',
								'next_or_number'   => 'number',
								'nextpagelink'     => __( 'Next page', 'materia-lite' ),
								'previouspagelink' => __( 'Previous page', 'materia-lite' ),
								'pagelink'         => '%',
								'echo'             => 1,
							)
						);

						?>
					</div>
					<?php

					/* Meta: Tags */
					if ( has_tag() ) :
						?>
						<div class="entry-footer">
							<?php

							echo '<span class="meta-tags">';
							$materia_tags = get_the_tag_list( '', ', ', '' );
							printf(
								// Translators: %s is a list of tags
								esc_html__( 'Tagged with %s', 'materia-lite' ),
								wp_kses_post( $materia_tags )
							);
							echo '</span>';

							?>
						</div>
						<?php
					endif;

					?>
				</div>
				<?php

				materia_article_nav();

				// Display comments section only if comments are open or if there are comments already.
				if ( comments_open() || '0' !== get_comments_number() ) :
					?>
					<div class="comments">
						<?php comments_template( '', true ); ?>
					</div>
					<?php
					materia_article_nav();
				endif;

			endwhile;

		else : // Empty loop ( this should never happen! )

			?>
			<h2><?php esc_html_e( 'Not Found', 'materia-lite' ); ?></h2>
			<p><?php esc_html_e( 'What you are looking for isn\'t here...', 'materia-lite' ); ?></p>
			<?php

		endif;

		?>
	</div>

	<div id="sidebar-container">
		<?php get_sidebar(); ?>
	</div>

</main>
<?php

get_footer();
