<?php
/**
 * Support for Gutenberg related features
 *
 * @package materia-lite-gutenberg
 */


/**
 * Enqueue WordPress theme styles within Gutenberg.
 */
function materia_gutenberg_styles() {
	wp_enqueue_style( 'materia-gutenberg', get_theme_file_uri( '/inc/gutenberg/css/gutenberg.min.css' ), false, null, 'all' );
}
add_action( 'enqueue_block_editor_assets', 'materia_gutenberg_styles' );

/**
 * Add Support for Gutenberg features
 */
function materia_gutenberg_setup() {

	// Custom color palette.
	add_theme_support(
		'gutenberg',
		array(
			'colors' => array(
				'#80CBC4',
				'#009688',
				'#00695C',
				'#e0e0e0',
				'#212121',
			),
		)
	);

}
add_action( 'after_setup_theme', 'materia_gutenberg_setup' );

/**
 * Register a dummy custom post type with a template (for demo purpose)
 */
function materia_gutenberg_register_movie_type() {
	$args = array(
		'public'       => true,
		'label'        => 'Movies',
		'show_in_rest' => true,
		'template'     => array(
			array(
				'core/image',
				array(
					'align' => 'right',
				),
			),
			array(
				'core/heading',
				array(
					'placeholder' => 'Add Director',
				),
			),
			array(
				'core/paragraph',
				array(
					'placeholder' => 'Add Synopsis',
				),
			),
			array(
				'core/quote',
				array(
					'placeholder' => 'Add Quote',
				),
			),
		),
	);
	register_post_type( 'movie', $args );
}
add_action( 'init', 'materia_gutenberg_register_movie_type' );
