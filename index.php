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

$materia_blog_sidebar_side = 'right';

?>
<main class="container">
	<?php

	get_template_part( 'part-title' );

	?>
	<div id="index-container">
		<?php

		if ( is_category() && category_description() ) :
			?>
			<div class="category-description"><?php echo category_description(); ?></div>
			<?php
		endif;

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
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<?php
								the_post_thumbnail();
								?>
							</a>
						</div>
						<?php
					endif;

					?>
					<div class="entry-wrap">
						<h3 class="entry-title">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
								<?php the_title(); ?>
							</a>
						</h3>
						<?php

						if ( 'post' === get_post_type() ) :

							?>
							<div class="entry-meta">
								<?php

								/* Meta: Date */
								?>
								<span class="meta-date post-date updated">
									<?php
									printf(
										// Translators: %s the date of the post
										esc_html__( 'Posted on %s', 'materia-lite' ),
										'<a href="' . esc_url( get_permalink() ) . '" title="' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">' . esc_html( get_the_time( get_option( 'date_format' ) ) ) . '</a>'
									);
									?>
								</span>
								<?php

								/* Meta: Author */
								$materia_author = sprintf(
									'<a class="fn" href="%1$s" title="%2$s" rel="author">%3$s</a>',
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
								<span class="meta-author author vcard">
									<?php
										printf(
											// Translators: %s is the author's name
											esc_html__( 'by %s', 'materia-lite' ),
											wp_kses_post( $materia_author )
										);
									?>
								</span>
								<?php

								/* Meta: Category */
								echo '<span class="meta-category">';
								$materia_cats = array();
								foreach ( ( get_the_category() ) as $materia_category ) :
									$materia_cats[] = '<a href="' . get_category_link( $materia_category->term_id ) . '">' . $materia_category->cat_name . '</a>';
								endforeach;
								$materia_categories = implode( ', ', $materia_cats );
								echo sprintf(
									// Translators: %s is the category name
									esc_html__( 'in %s', 'materia-lite' ),
									wp_kses_post( $materia_categories )
								);
								echo '</span>';

								?>
							</div>
							<?php

						endif;

						if (
						get_post_format()
						|| post_password_required()
						|| 'content' === get_theme_mod( 'materia_blog_index_content' )
						) :
							?>
							<div class="post-content entry-content">
								<?php
								the_content();
						else :
							?>
							<div class="post-content entry-summary">
								<?php
								the_excerpt();
						endif;

						if (
							materia_has_readmore_link()
							|| ( ( comments_open() || '0' !== get_comments_number() ) )
						) :

							?>
							<div class="entry-buttons">
								<?php

								/* Read-more link */
								if ( materia_has_readmore_link() ) :
									echo wp_kses_post( materia_readmore_link( 'flat-button' ) );
								endif;

								/* Meta: Comments */
								if ( ( comments_open() || '0' !== get_comments_number() ) ) :
									comments_popup_link(
										__( 'Comment', 'materia-lite' ),
										__( 'View 1 Comment', 'materia-lite' ),
										__( 'View % Comments', 'materia-lite' ),
										'comment-link flat-button',
										__( 'Comments Off', 'materia-lite' )
									);
								endif;

								?>
							</div>
							<?php
						endif;

						?>
						<br class="clear" />
						</div>
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
								wp_kses_post( __( 'Tagged with %s', 'materia-lite' ) ),
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

			endwhile;

		else : // If there is no post in the loop

			if ( is_search() ) : // Empty search results

				?>
				<h2><?php esc_html_e( 'Not Found', 'materia-lite' ); ?></h2>
				<p>
					<?php
					printf(
						// Translators: %s is the search term
						esc_html__( 'Your search for "%s" did not return any result.', 'materia-lite' ),
						get_search_query()
					);
					?>
					<br />
					<?php esc_html_e( 'Would you like to try another search ?', 'materia-lite' ); ?>
				</p>
				<?php
				get_search_form();

			else : // Empty loop ( this should never happen! )

				?>
				<h2><?php esc_html_e( 'Not Found', 'materia-lite' ); ?></h2>
				<p><?php esc_html_e( 'What you are looking for isn\'t here...', 'materia-lite' ); ?></p>
				<?php

			endif;

		endif;

		?>
		<div class="page_nav">
			<?php echo wp_kses_post( materia_index_page_nav() ); ?>
		</div>

	</div>

	<div id="sidebar-container">
		<?php get_sidebar(); ?>
	</div>

</main>
<?php

get_footer();
