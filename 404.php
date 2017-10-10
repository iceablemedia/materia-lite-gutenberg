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

?>
<main class="container">
	<?php

	get_template_part( 'part-title' );

	?>
	<div id="single-container" class="single-container with-sidebar">
		<div id="page-<?php the_ID(); ?>" <?php post_class( 'entry-wrap type-page' ); ?>>
			<div id="page-container" class="post-content entry-content">

				<h2><?php esc_html_e( 'Page Not Found', 'materia-lite' ); ?></h2>
				<p><?php esc_html_e( 'What you are looking for isn\'t here...', 'materia-lite' ); ?></p>
				<p><?php esc_html_e( 'Maybe a search will help ?', 'materia-lite' ); ?></p>
				<p><?php get_search_form(); ?></p>

			</div>
		</div>
	</div>

	<div id="sidebar-container">
		<?php get_sidebar(); ?>
	</div>

</main>
<?php

get_footer();
