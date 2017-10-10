<?php
/**
 *
 * Materia Lite WordPress Theme by Iceable Themes | https://www.iceablethemes.com
 *
 * Copyright 2017 Mathieu Sarrasin - Iceable Media
 *
 * Header Template
 *
 */

?><!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if ( gte IE 9 )|!( IE )]><!--><html <?php language_attributes( 'html' ); ?>><!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<?php if ( is_singular() && pings_open() ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php endif; ?>
<?php
/**
 * The <title> tag is handled by WordPress with title-tag
 * If you add your own title tag here, then make sure to
 * remove_theme_support( 'title-tag' ); to avoid duplication.
 */
wp_head();
?>
</head>
<body <?php body_class(); ?>>
	<div id="main-wrap" class=''>
		<div id="header">
			<div class="container">
				<?php

				if ( get_theme_mod( 'custom_logo' ) ) :
					?>
					<h1 class="site-title" style="display:none"><?php echo bloginfo( 'name' ); ?></h1>
					<div id="logo">
						<a href="<?php echo esc_url( home_url() ); ?>" title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'>
							<?php the_custom_logo(); ?>
						</a>
					</div>
					<?php
				else :
					?>
					<h1 class="site-title">
						<a class="site-title-link" href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo( 'name' ); ?></a>
					</h1>
					<?php
				endif;

				if ( get_bloginfo( 'description' ) ) :
					?>
					<div id="tagline"><?php bloginfo( 'description' ); ?></div>
					<?php
				endif;

				?>
			</div>
		</div>
		<?php

		get_template_part( 'navbar' );

		// Header image
		if ( get_custom_header()->url ) :
			if (
				( is_front_page() && 'off' !== get_theme_mod( 'home_header_image' ) )
				|| ( is_page() && ! is_front_page() && 'off' !== get_theme_mod( 'pages_header_image' ) )
				|| ( is_single() && 'off' !== get_theme_mod( 'single_header_image' ) )
				|| ( ! is_front_page() && ! is_singular() && 'off' !== get_theme_mod( 'blog_header_image' ) )
				|| ( is_404() )
			) :
				$materia_display_mode     = get_theme_mod( 'materia_header_image_display_mode' );
				$materia_header_image_src = esc_url( get_header_image() );
				$materia_image_height     = get_custom_header()->height;
				$materia_image_width      = get_custom_header()->width;
			endif;
		endif;

		if ( isset( $materia_header_image_src ) ) :
			if ( $materia_header_image_src ) :


				if ( 'card' === $materia_display_mode ) :
					$header_image_class = 'container';
				endif;
				$header_image_style_attr = '';
				if ( 'full-width' === $materia_display_mode ) :
					$header_image_class = 'full-width';
					$header_image_style_attr = ' style="background-image: url( ' . esc_url( $materia_header_image_src ) . ' ); height:' . esc_attr( $materia_image_height ) . 'px"';

				endif;

				?>
				<div id="header-image" class="<?php echo esc_attr( $header_image_class ); ?>"<?php echo esc_attr( $header_image_style_attr ); ?>>
					<?php
					if ( 'card' === $materia_display_mode ) :
						?>
						<img class="cards" src="<?php echo esc_url( $materia_header_image_src ); ?>" height="<?php echo esc_attr( $materia_image_height ); ?>" width="<?php echo esc_attr( $materia_image_width ); ?>" alt='' />
						<?php
					endif;
					?>
				</div>
			<?php
		endif;
	endif;
