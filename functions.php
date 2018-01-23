<?php
/**
 *
 * Materia Lite WordPress Theme by Iceable Themes | https://www.iceablethemes.com
 *
 * Copyright 2017 Mathieu Sarrasin - Iceable Media
 *
 * Theme functions
 *
 */

// Theme Constants
define( 'MATERIA_THEME_DIR', get_template_directory() );
define( 'MATERIA_THEME_DIR_URI', get_template_directory_uri() );
define( 'MATERIA_STYLESHEET_DIR', get_stylesheet_directory() );
define( 'MATERIA_STYLESHEET_DIR_URI', get_stylesheet_directory_uri() );
$materia_the_theme = wp_get_theme();
define( 'MATERIA_THEME_VERSION', $materia_the_theme->get( 'Version' ) );

/**
 * Load Gutenberg features support functions
 */
require_once 'inc/gutenberg/gutenberg.php';

/*
 * Setup and registration functions
 */
function materia_setup() {

	/* Translation support
	 * Translations can be added to the /languages directory.
	 * A .pot template file is included to get you started
	 */
	load_theme_textdomain( 'materia-lite', MATERIA_THEME_DIR . '/languages' );

	// Content Width
	global $content_width;
	if ( ! isset( $content_width ) ) :
		$content_width = 856;
	endif;

	/* Custom logo support */
	add_theme_support( 'custom-logo' );

	/* Feed links support */
	add_theme_support( 'automatic-feed-links' );

	/* Register menus */
	register_nav_menu( 'primary', 'Navigation menu' );
	register_nav_menu( 'footer-menu', 'Footer menu' );

	/* Title tag support */
	add_theme_support( 'title-tag' );

	/* Post Thumbnails Support */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 920, 300, true );

	/* Custom header support */
	add_theme_support(
		'custom-header',
		array(
			'header-text' => false,
			'width' => 1920,
			'height' => 400,
			'flex-width' => true,
			'flex-height' => true,
		)
	);

	/* Custom background support */
	add_theme_support(
		'custom-background',
		array(
			'default-color' => 'ededed',
			'default-image' => '',
		)
	);

	/* Support HTML5 markup for the search forms, comment forms, comment lists, gallery, and caption. */
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

}
add_action( 'after_setup_theme', 'materia_setup' );

/* Adjust $content_width depending on the page being displayed */
function materia_content_width() {
	global $content_width;
	if ( is_page_template( 'page-full-width.php' ) ) :
		$content_width = 1216;
	endif;
}
add_action( 'template_redirect', 'materia_content_width' );

/*
 * Register Sidebar and Footer widgetized areas
 */
function materia_widgets_init() {

	register_sidebar(
		array(
			'name'          => __( 'Default Sidebar', 'materia-lite' ),
			'id'            => 'sidebar',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer', 'materia-lite' ),
			'id'            => 'footer-sidebar',
			'before_widget' => '<li id="%1$s" class="widget %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

}
add_action( 'widgets_init', 'materia_widgets_init' );

/*
 * Enqueue styles
 */
function materia_styles() {

	$responsive_mode = get_theme_mod( 'materia_responsive_mode' );

	if ( 'off' !== $responsive_mode ) :
		$stylesheet = '/css/materia.min.css';
	else :
		$stylesheet = '/css/materia-unresponsive.min.css';
	endif;

	if ( function_exists( 'get_theme_file_uri' ) ) : // WordPress 4.7
		/* Child theme support:
		 * Enqueue child-theme's versions of stylesheet in /css if they exist,
		 * or the parent theme's version otherwise
		 */
		wp_register_style( 'materia', get_theme_file_uri( $stylesheet ), array(), MATERIA_THEME_VERSION );

		// Enqueue style.css from the current theme
		wp_register_style( 'materia-style', get_theme_file_uri( 'style.css' ), array(), MATERIA_THEME_VERSION );

		// Load font-awesome
		wp_register_style( 'font-awesome', get_theme_file_uri( 'css/font-awesome/css/font-awesome.min.css' ), array(), MATERIA_THEME_VERSION );

	endif;

	wp_enqueue_style( 'materia' );
	wp_enqueue_style( 'materia-style' );
	wp_enqueue_style( 'font-awesome' );

	wp_enqueue_style( 'materia-roboto', '//fonts.googleapis.com/css?family=Roboto:300italic,400italic,500italic,700italic,300,400,500,700&subset=latin,latin-ext', array(), null );

}
add_action( 'wp_enqueue_scripts', 'materia_styles' );

/*
 * Register editor style
 */
function materia_editor_styles() {
	add_editor_style( 'css/editor-style.css' );
}
add_action( 'init', 'materia_editor_styles' );

/*
 * Enqueue javascripts
 */
function materia_scripts() {

	if ( function_exists( 'get_theme_file_uri' ) ) : // WordPress 4.7
		wp_enqueue_script( 'materia', get_theme_file_uri( '/js/materia.min.js' ), array( 'jquery', 'hoverIntent' ), MATERIA_THEME_VERSION );
		// Loads HTML5 JavaScript file to add support for HTML5 elements for IE < 9.
		wp_enqueue_script( 'html5shiv', get_theme_file_uri( '/js/html5.js' ), array(), MATERIA_THEME_VERSION );
	else : // Support for WordPress <4.7 ( to be removed after 4.9 is released )
		wp_enqueue_script( 'materia', MATERIA_THEME_DIR_URI . '/js/materia.min.js', array( 'jquery', 'hoverIntent' ), MATERIA_THEME_VERSION );
		// Loads HTML5 JavaScript file to add support for HTML5 elements for IE < 9.
		wp_enqueue_script( 'html5shiv', MATERIA_THEME_DIR_URI . '/js/html5.js', array(), MATERIA_THEME_VERSION );
	endif;

	// Add conditional for HTML5Shiv to only load for IE < 9
	wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

	/* Threaded comments support */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) :
		wp_enqueue_script( 'comment-reply' );
	endif;

}
add_action( 'wp_enqueue_scripts', 'materia_scripts' );

// Remove hentry class where irrelevant
function materia_remove_hentry( $classes ) {
	if ( is_page() ) :
		$classes = array_diff( $classes, array( 'hentry' ) );
	endif;
	return $classes;
}
add_filter( 'post_class','materia_remove_hentry' );

// Remove rel="category" in category links ( HTML5 invalid )
function materia_remove_rel_cat( $text ) {
	$text = str_replace( ' rel="category"', '', $text );
	$text = str_replace( ' rel="category tag"', ' rel="tag"', $text );
	return $text;
}
add_filter( 'the_category', 'materia_remove_rel_cat' );

/*
 * Fallback menu args filter
 */
function materia_wp_page_menu_args_filter( $args ) {

	// Filter wp_page_menu when it is used as a fallback for wp_nav_menu for the main navigation menu
	if ( isset( $args['fallback_cb'] ) && 'wp_page_menu' === $args['fallback_cb'] ) :
		$args['menu_class'] = 'navigation main-nav';
	endif;

	return $args;

}
add_filter( 'wp_page_menu_args', 'materia_wp_page_menu_args_filter' );

/*
 * Fallback menu HTML filter
 */
function materia_wp_page_menu_html_filter( $menu, $args ) {

	// Filter wp_page_menu when it is used as a fallback for wp_nav_menu
	if ( isset( $args['fallback_cb'] ) && 'wp_page_menu' === $args['fallback_cb'] ) :

		// Add classes to wp_page_menu so it inherits the same styling as wp_nav_menu
		$menu = str_replace( 'class="navigation main-nav"><ul>', 'class="navigation main-nav"><ul class="menu sf-menu">', $menu );
		$menu = str_replace( 'class="page_item', 'class="page_item menu-item', $menu );
		$menu = str_replace( 'page_item_has_children"', 'page_item_has_children menu-item-has-children"', $menu );
		$menu = str_replace( "class='children", "class='children sub-menu", $menu );

		// Add a hint to "customize this menu" for logged in admin when using the fallback menu (i.e. when user did not set a menu)
		if ( current_user_can( 'edit_theme_options' ) ) :
			$menu = str_replace( '</ul></nav>', '<li class="menu-item"><a href="' . get_admin_url( null, 'nav-menus.php' ) . '">' . __( 'Customize this menu now!', 'materia-lite' ) . '</a></li></ul>', $menu );
		endif;

	endif;

	return $menu;

}
add_filter( 'wp_page_menu', 'materia_wp_page_menu_html_filter', 10, 2 );

/*
 * Customize "Read More" links on index view
 */
function materia_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'materia_excerpt_more' );

/*
 * Determine whether the current post needs a "Read More" link on the blog index page
 */
function materia_has_readmore_link() {
	if ( 'content' === get_theme_mod( 'materia_blog_index_content' ) ) :
		global $post;
		if ( ( preg_match( '/<!--more( .*? )?-->/', $post->post_content ) || preg_match( '/<!--nextpage-->/', $post->post_content ) ) ) :
			return true;
		else :
			return false;
		endif;
	else :
		return true;
	endif;
}

/*
 * Generates a "Read More" link for the current post
 */
function materia_readmore_link( $classes ) {

	$link = get_permalink();

	// If the index is set to "full content" and a "Read More" link is needed,
	// then the <!--more--> quicktag was used. Add an anchor pointing to the more
	// quicktag position to the link.
	if ( 'content' === get_theme_mod( 'materia_blog_index_content' ) ) :
		global $post;
		$link .= '#more-' . $post->ID;
	endif;

	$more = '<a href="' . $link . '" class="readmore-link ' . $classes . '">' . esc_html__( 'Read More', 'materia-lite' ) . '</a>';

	return $more;
}

/* Index page nav ( for use in index.php ) */
function materia_index_page_nav() {

	if ( null !== get_next_posts_link() ) :
		?>
		<div class="previous"><?php next_posts_link( __( 'Previous Posts', 'materia-lite' ) ); ?></div>
		<?php
	endif;

	if ( null !== get_previous_posts_link() ) :
		?>
		<div class="next"><?php previous_posts_link( __( 'Next Posts', 'materia-lite' ) ); ?></div>
		<?php
	endif;

	if ( null !== get_next_posts_link() || null !== get_previous_posts_link() ) :
		?>
		<br class="clear" />
		<?php
	endif;

}

/*
 * Article Nav ( Previous/Next post, for use in single.php )
 */
function materia_article_nav() {

	if ( '' !== get_adjacent_post( false, '', false ) || '' !== get_adjacent_post( false, '', true ) ) :

		echo '<div class="page_nav">';

		if ( '' !== get_adjacent_post( false, '', false ) ) : // Is there a previous post?
			echo '<div class="next">',
				next_post_link( '%link', __( 'Next Post', 'materia-lite' ) ),
				'</div>';
		endif;

		if ( '' !== get_adjacent_post( false, '', true ) ) : // Is there a next post?
			echo '<div class="previous">',
				previous_post_link( '%link', __( 'Previous Post', 'materia-lite' ) ),
				'</div>';
		endif;

		echo '<br class="clear" /></div>';

	endif;
}

/*
 * Finds whether post page needs comments pagination links
 */
function materia_page_has_comments_nav() {
	global $wp_query;
	return ( $wp_query->max_num_comment_pages > 1 );
}

function materia_page_has_next_comments_link() {
	global $wp_query;
	$max_cpage = $wp_query->max_num_comment_pages;
	$cpage = get_query_var( 'cpage' );
	return ( $max_cpage > $cpage );
}

function materia_page_has_previous_comments_link() {
	$cpage = get_query_var( 'cpage' );
	return ( $cpage > 1 );
}

/*
 * Custom searchform markup
 */
function materia_searchform_markup() {

	$form = '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
		<label>
			<span class="screen-reader-text">' . _x( 'Search for:', 'label', 'materia-lite' ) . '</span>
			<i class="fa fa-search" aria-hidden="true"></i>
			<input type="search" class="search-field" placeholder="' . esc_attr_x( 'Search &hellip;', 'placeholder', 'materia-lite' ) . '" value="' . get_search_query() . '" name="s" />
		</label>
		<input type="submit" class="search-submit" value="' . esc_attr_x( 'Search', 'submit button', 'materia-lite' ) . '">
	</form>';

	return $form;
}
add_filter( 'get_search_form', 'materia_searchform_markup' );

/*
 * Custom comment markup
 */
function materia_comment_callback( $comment, $args, $depth ) {
	$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
	?>
	<<?php echo esc_html( $tag ); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( ! empty( $args['has_children'] ) ? 'parent' : '', $comment ); ?>>
	<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
		<footer class="comment-meta">
			<div class="comment-author vcard">
				<?php
				if ( $args['avatar_size'] ) :
					echo get_avatar( $comment, $args['avatar_size'] );
				endif;

				printf(
					// Translators: %s is the author's name
					wp_kses_post( __( '%s <span class="says">says:</span>', 'materia-lite' ) ),
					sprintf( '<b class="fn">%s</b>', get_comment_author_link( $comment ) )
				);
				?>
			</div>

			<div class="comment-metadata">
				<a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
					<time datetime="<?php comment_time( 'c' ); ?>">
						<?php
							comment_date();
							echo ' ';
							printf(
								// Translators: %s is the relative time (e.g. (3 days ago) )
								esc_html__( '(%s ago)', 'materia-lite' ),
								esc_html( human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) )
							);
						?>
					</time>
				</a>
			</div>
			<?php
			if ( '0' === $comment->comment_approved ) :
				?>
				<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'materia-lite' ); ?></p>
				<?php
			endif;
			?>
		</footer>

		<div class="comment-content">
			<?php comment_text(); ?>
		</div>
		<?php

		comment_reply_link(
			array_merge(
				$args,
				array(
					'add_below' => 'div-comment',
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
					'before'    => '<div class="reply">',
					'after'     => '</div>',
				)
			)
		);
		edit_comment_link( __( 'Edit', 'materia-lite' ), '<span class="edit-link">', '</span>' );
		?>
	</article>
<?php
}

/*
 * Create dropdown menu ( for responsive mode )
 */
function materia_dropdown_nav_menu() {

	$menu_name = 'primary';
	$locations = get_nav_menu_locations();

	if ( ( $locations ) && isset( $locations[ $menu_name ] ) ) :

		$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );

		if ( $menu ) :
			$menu_items = wp_get_nav_menu_items( $menu->term_id );
			$menu_list = '<select id="dropdown-menu">';
			$menu_list .= '<option value="">Menu</option>';
			foreach ( (array) $menu_items as $key => $menu_item ) :
				$title = $menu_item->title;
				$url = $menu_item->url;
				if ( $menu_item->menu_item_parent && $menu_item->menu_item_parent > 0 ) :
					$menu_list .= '<option value="' . $url . '"> &raquo; ' . $title . '</option>';
				else :
					$menu_list .= '<option value="' . $url . '">' . $title . '</option>';
				endif;
			endforeach;
			$menu_list .= '</select>';
			// $menu_list now ready to output
			echo $menu_list; // WPCS: XSS ok.
		endif;
	endif;
}

// Generate breadcrumbs

function materia_breadcrumbs() {

	global $post;

	if ( ! is_front_page() ) :

		echo '<a href="' . esc_url( home_url() ) . '">' . esc_html__( 'Home', 'materia-lite' ) . '</a><span class="separator"> / </span>';

		if ( is_home() ) :

			$page_for_posts = get_option( 'page_for_posts' );
			echo get_the_title( $page_for_posts );

		elseif ( is_single() ) :

			// Use categories as breadcrumbs for single posts
			the_category( '<span class="separator"> / </span>' );
			echo '<span class="separator"> / </span>' . get_the_title();

		elseif ( is_page() ) :

			$output = '';
			if ( $post->post_parent ) :
				$anc = get_post_ancestors( $post->ID );
				foreach ( $anc as $ancestor ) :
					$output = '<a href="' . get_permalink( $ancestor ) . '" title="' . get_the_title( $ancestor ) . '">' . get_the_title( $ancestor ) . '</a><span class="separator"> / </span>' . $output;
				endforeach;
				echo wp_kses_post( $output );
			endif;
			the_title();

		elseif ( is_archive() ) :

			the_archive_title();

		elseif ( is_search() ) :

			esc_html_e( 'Search Results', 'materia-lite' );

		elseif ( is_404() ) :

			esc_html_e( '404 Error', 'materia-lite' );

		endif;

	endif;

}


/*
 * Customizer
 */

require_once 'inc/customizer/customizer.php';

function materia_customizer_css() {

	$main_color = esc_attr( get_theme_mod( 'materia_main_color', '#009688' ) );

	$mainhsl = materia_hex2hsl( $main_color );
	$main_color_dark = materia_hsl2hex( $mainhsl[0], $mainhsl[1], 0.82 * $mainhsl[2] );
	$amount = 50;
	$light_l = ( $mainhsl[2] * 100 ) + $amount;
	$light_l = ( $light_l > 100 ) ? 0.95 : $light_l / 100;
	$main_color_light = materia_hsl2hex( $mainhsl[0], 0.41, $light_l );

	$text_on_main = ( materia_rgb_is_light( $main_color ) ) ? 'rgba( 0,0,0,0.87 )' : '#ffffff';

	?>
	<style type="text/css" id="materia-customizer">
		a,
		h1 a,
		h2 a,
		h3 a,
		h4 a,
		h5 a,
		h6 a,
		#sub-footer a,
		#sub-footer .menu a {
			color: <?php echo esc_html( $main_color ); ?>;
		}

		#nav-wrap,
		#icefit-mobile-menu ul li a:hover,
		.button.default,
		.page_nav .page-numbers.current {
			background-color: <?php echo esc_html( $main_color ); ?>;
			color: <?php echo esc_html( $text_on_main ); ?>;
		}

		#navbar .menu-item a {
			color: <?php echo esc_html( $text_on_main ); ?>;
		}

		input[type="text"]:focus,
		input[type="search"]:focus,
		input[type="password"]:focus,
		input[type="email"]:focus,
		input[type="tel"]:focus,
		input[type="url"]:focus,
		textarea:focus,
		select:focus {
			border-bottom-color: <?php echo esc_html( $main_color ); ?>;
		}

		a:hover,
		a:focus,
		h1 a:hover,
		h2 a:hover,
		h3 a:hover,
		h4 a:hover,
		h5 a:hover,
		h6 a:hover {
			color: <?php echo esc_html( $main_color_dark ); ?>;
		}

		.button.default:hover,
		input[type="submit"]:hover,
		button[type="submit"]:hover,
		input[type="reset"]:hover,
		input[type="button"]:hover {
			background: <?php echo esc_html( $main_color_dark ); ?>;
			color: <?php echo esc_html( $text_on_main ); ?>;
		}

		blockquote {
			background: <?php echo esc_html( $main_color_light ); ?>;
		}

	</style>
	<?php
}
add_action( 'wp_head', 'materia_customizer_css' );

// Helper functions for color computing
function materia_hex2hsl( $colour ) {

	if ( '#' === $colour[0] ) :
		$colour = substr( $colour, 1 );
	endif;

	if ( 6 === strlen( $colour ) ) :
		list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
	elseif ( 3 === strlen( $colour ) ) :
		list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
	else :
		return false;
	endif;

	$r = hexdec( $r ) / 255;
	$g = hexdec( $g ) / 255;
	$b = hexdec( $b ) / 255;
	$max = max( $r, $g, $b );
	$min = min( $r, $g, $b );
	$l = ( $max + $min ) / 2;
	$d = $max - $min;

	if ( 0 === $d ) :
		// achromatic
		$h = 0;
		$s = 0;
	else :
		$s = $d / ( 1 - abs( 2 * $l - 1 ) );

		switch ( $max ) :
			case $r:
				$h = 60 * fmod( ( ( $g - $b ) / $d ), 6 );
				if ( $b > $g ) :
					$h += 360;
				endif;
				break;
			case $g:
				$h = 60 * ( ( $b - $r ) / $d + 2 );
				break;
			case $b:
				$h = 60 * ( ( $r - $g ) / $d + 4 );
				break;
			default:
		endswitch;
	endif;

	return array( round( $h, 2 ), round( $s, 2 ), round( $l, 2 ) );

}

function materia_hsl2hex( $h, $s, $l ) {
	$c = ( 1 - abs( 2 * $l - 1 ) ) * $s;
	$x = $c * ( 1 - abs( fmod( ( $h / 60 ), 2 ) - 1 ) );
	$m = $l - ( $c / 2 );
	if ( $h < 60 ) :
		$r = $c;
		$g = $x;
		$b = 0;
	elseif ( $h < 120 ) :
		$r = $x;
		$g = $c;
		$b = 0;
	elseif ( $h < 180 ) :
		$r = 0;
		$g = $c;
		$b = $x;
	elseif ( $h < 240 ) :
		$r = 0;
		$g = $x;
		$b = $c;
	elseif ( $h < 300 ) :
		$r = $x;
		$g = 0;
		$b = $c;
	else :
		$r = $c;
		$g = 0;
		$b = $x;
	endif;

	$r = ( $r + $m ) * 255;
	$g = ( $g + $m ) * 255;
	$b = ( $b + $m  ) * 255;
	$r = dechex( $r );
	$g = dechex( $g );
	$b = dechex( $b );

	if ( strlen( $r ) < 2 ) :
		$r = '0' . $r;

		if ( strlen( $g ) < 2 ) :
			$g = '0' . $g;
		endif;

		if ( strlen( $b ) < 2 ) :
			$b = '0' . $b;
		endif;

	endif;

	return '#' . $r . $g . $b;
}

// Returns true if rgb color is light, false if dark
function materia_rgb_is_light( $colour ) {

	if ( '#' === $colour[0] ) :
		$colour = substr( $colour, 1 );
	endif;

	if ( 6 === strlen( $colour ) ) :
		list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
	elseif ( 3 === strlen( $colour ) ) :
		list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
	else :
		return false;
	endif;

	$r = hexdec( $r );
	$g = hexdec( $g );
	$b = hexdec( $b );

	return ( ( $r * 299 + $g * 587 + $b * 114 ) / 1000 > 160 );

}
