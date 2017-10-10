<?php
/**
 *
 * Materia Lite WordPress Theme by Iceable Themes | https://www.iceablethemes.com
 *
 * Copyright 2017 Mathieu Sarrasin - Iceable Media
 *
 * Comments template
 *
 */

// Do not delete these lines
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' === basename( $_SERVER['SCRIPT_FILENAME'] ) ) :
	die( 'Please do not load this page directly. Thanks!' );
endif;

if ( post_password_required() ) :
	?>
	<p class="nocomments">
		<?php esc_html_e( 'This post is password protected. Enter the password to view comments.', 'materia-lite' ); ?>
	</p>
	<?php
	return;
endif;

if ( have_comments() ) :

	?>
	<h3 id="comments">
		<?php
		printf(
			// Translators: %1$s is the number of comments, %2$s is the post title
			esc_html( _n( '%1$s Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'materia-lite' ) ),
			esc_html( number_format_i18n( get_comments_number() ) ),
			get_the_title()
		);
		?>
	</h3>

	<ol class="commentlist">
		<?php
		wp_list_comments(
			array(
				'avatar_size' => 64,
				'callback' => 'materia_comment_callback',
			)
		);
		?>
	</ol>
	<?php

	if ( materia_page_has_comments_nav() ) :
		?>
		<div class="comments_nav">
			<?php

			if ( materia_page_has_previous_comments_link() ) :
				?>
				<div class="previous"><?php previous_comments_link( __( 'Older comments', 'materia-lite' ) ); ?></div>
				<?php
			endif;

			if ( materia_page_has_next_comments_link() ) :
				?>
				<div class="next"><?php next_comments_link( __( 'Newer comments', 'materia-lite' ) ); ?></div>
				<?php
			endif;

			?>
		</div>
		<?php
	endif;

else : // If there are no comments yet

	if ( ! comments_open() ) :
		?>
		<p class="nocomments"><?php esc_html_e( 'Comments are closed.', 'materia-lite' ); ?></p>
		<?php
	endif;

endif;

if ( comments_open() ) :
	comment_form();
endif;
