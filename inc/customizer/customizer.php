<?php
/**
 *
 * Materia Lite WordPress Theme by Iceable Themes | https://www.iceablethemes.com
 *
 * Copyright 2017 Mathieu Sarrasin - Iceable Media
 *
 * Customizer functions
 *
 */

class Materia_Customizer {
	public static function register( $wp_customize ) {

		// Move default settings "background_color" in the same section as background image settings
		// and rename the section just "Background"
		//$wp_customize->get_control( 'background_color' )->section = 'background_image';
		//$wp_customize->get_section( 'background_image' )->title = __('Background', 'materia-lite');

		// Add new sections
		if ( ! function_exists('wp_site_icon') ) :
		$wp_customize->add_section( 'materia_logo_favicon' , array(
			'title'      => __( 'Logo & Favicon', 'materia-lite' ),
			'priority'   => 20,
		) );
		else:
		$wp_customize->add_section( 'materia_logo_favicon' , array(
			'title'      => __( 'Logo', 'materia-lite' ),
			'priority'   => 20,
		) );
		endif;

		$wp_customize->add_section( 'materia_blog_settings' , array(
			'title'      => __( 'Blog Settings', 'materia-lite' ),
			'priority'   => 80,
		) );

		$wp_customize->add_section( 'materia_misc_settings' , array(
			'title'      => __( 'Misc', 'materia-lite' ),
			'priority'   => 100,
		) );

		$wp_customize->add_section( 'materia_more' , array(
			'title'      => __( 'More', 'icefit' ),
			'priority'   => 130,
		) );

		// Setting and control for Logo
		$wp_customize->add_setting( 'materia_logo' , array(
			'default'     => '',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control(
			new WP_Customize_Image_Control( $wp_customize, 'materia_logo',
				array(
					'label'      => __( 'Upload your logo', 'materia-lite' ),
					'description' => __('If no logo is uploaded, the site title will be displayed instead.', 'materia-lite'),
					'section'    => 'materia_logo_favicon',
					'settings'   => 'materia_logo',
				)
			)
		);

		// Setting and control for favicon
		if ( ! function_exists('wp_site_icon') ) :
			$wp_customize->add_setting( 'materia_favicon' , array(
				'default'     => '',
				'sanitize_callback' => 'esc_url_raw',
			) );
			$wp_customize->add_control(
				new WP_Customize_Image_Control( $wp_customize, 'materia_favicon',
					array(
						'label'			=> __( 'Upload a custom favicon', 'materia-lite' ),
						'description'	=> __('Set your favicon. 16x16 or 32x32 pixels is recommended. PNG (recommended), GIF, or ICO.', 'materia-lite'),
						'section'		=> 'materia_logo_favicon',
						'settings'		=> 'materia_favicon',
					)
				)
			);
		endif;

		$wp_customize->add_setting( 'materia_main_color' , array(
			'default'     => '#009688',
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control( $wp_customize, 'materia_main_color',
				array(
					'label'		=> __( 'Main Color', 'icefit' ),
					'section'	=> 'colors',
					'settings'	=> 'materia_main_color',
				)
			)
		);

		// Setting and control for blog index content switch
		$wp_customize->add_setting( 'materia_blog_index_content' , array(
			'default'     => 'excerpt',
			'sanitize_callback' => 'materia_sanitize_blog_index_content',
		) );
		$wp_customize->add_control(
			new WP_Customize_Control( $wp_customize, 'materia_blog_index_content',
				array(
					'label'		=> __( 'Blog Index Content', 'materia-lite' ),
					'section'	=> 'materia_blog_settings',
					'settings'	=> 'materia_blog_index_content',
					'type'		=> 'radio',
					'choices'	=> array(
						'excerpt'	=> __( 'Excerpt', 'materia-lite' ),
						'content'	=> __( 'Full content', 'materia-lite' )
					)
				)
			)
		);

		// Setting and control for responsive mode
		$wp_customize->add_setting( 'materia_responsive_mode' , array(
			'default'     => 'on',
			'sanitize_callback' => 'materia_sanitize_on_off',
		) );
		$wp_customize->add_control(
			new WP_Customize_Control( $wp_customize, 'materia_responsive_mode',
				array(
					'label'		=> __( 'Responsive Mode', 'materia-lite' ),
					'section'	=> 'materia_misc_settings',
					'settings'	=> 'materia_responsive_mode',
					'type'		=> 'radio',
					'choices'	=> array(
						'on'	=> __( 'On', 'materia-lite' ),
						'off'	=> __( 'Off', 'materia-lite' )
					)
				)
			)
		);

		// Settings and controls for header image display
		$wp_customize->add_setting( 'header_image_display_mode' , array(
			'default'     => 'card',
			'sanitize_callback' => 'materia_sanitize_display_mode',
		) );
		$wp_customize->add_control(
			new WP_Customize_Control( $wp_customize, 'header_image_display_mode',
				array(
					'label'		=> __( 'Header image display mode', 'icefit' ),
					'section'	=> 'header_image',
					'settings'	=> 'header_image_display_mode',
					'type'		=> 'radio',
					'choices'	=> array(
						'card'	=> __( 'Card', 'icefit' ),
						'full-width'	=> __( 'Full Width', 'icefit' ),
					)
				)
			)
		);

		$wp_customize->add_setting( 'home_header_image' , array(
			'default'     => 'on',
			'sanitize_callback' => 'materia_sanitize_on_off',
		) );
		$wp_customize->add_control(
			new WP_Customize_Control( $wp_customize, 'home_header_image',
				array(
					'label'		=> __( 'Display header on Homepage', 'icefit' ),
					'section'	=> 'header_image',
					'settings'	=> 'home_header_image',
					'type'		=> 'radio',
					'choices'	=> array(
						'on'	=> __( 'On', 'icefit' ),
						'off'	=> __( 'Off', 'icefit' )
					)
				)
			)
		);

		$wp_customize->add_setting( 'blog_header_image' , array(
			'default'     => 'on',
			'sanitize_callback' => 'materia_sanitize_on_off',
		) );
		$wp_customize->add_control(
			new WP_Customize_Control( $wp_customize, 'blog_header_image',
				array(
					'label'		=> __( 'Display header on Blog Index', 'icefit' ),
					'section'	=> 'header_image',
					'settings'	=> 'blog_header_image',
					'type'		=> 'radio',
					'choices'	=> array(
						'on'	=> __( 'On', 'icefit' ),
						'off'	=> __( 'Off', 'icefit' )
					)
				)
			)
		);

		$wp_customize->add_setting( 'single_header_image' , array(
			'default'     => 'on',
			'sanitize_callback' => 'materia_sanitize_on_off',
		) );
		$wp_customize->add_control(
			new WP_Customize_Control( $wp_customize, 'single_header_image',
				array(
					'label'		=> __( 'Display header on Single Posts', 'icefit' ),
					'section'	=> 'header_image',
					'settings'	=> 'single_header_image',
					'type'		=> 'radio',
					'choices'	=> array(
						'on'	=> __( 'On', 'icefit' ),
						'off'	=> __( 'Off', 'icefit' )
					)
				)
			)
		);

		$wp_customize->add_setting( 'pages_header_image' , array(
			'default'     => 'on',
			'sanitize_callback' => 'materia_sanitize_on_off',
		) );
		$wp_customize->add_control(
			new WP_Customize_Control( $wp_customize, 'pages_header_image',
				array(
					'label'		=> __( 'Display header on Pages', 'icefit' ),
					'section'	=> 'header_image',
					'settings'	=> 'pages_header_image',
					'type'		=> 'radio',
					'choices'	=> array(
						'on'	=> __( 'On', 'icefit' ),
						'off'	=> __( 'Off', 'icefit' )
					)
				)
			)
		);

		$wp_customize->add_setting( 'header_image_heading' , array(
			'default'     => '',
			'sanitize_callback' => 'materia_sanitize_text',
		) );
		$wp_customize->add_control(
			new WP_Customize_Control( $wp_customize, 'header_image_heading',
				array(
					'label'		=> __( 'Header Image Heading', 'icefit' ),
					'section'	=> 'header_image',
					'settings'	=> 'header_image_heading',
					'type'		=> 'text',
				)
			)
		);

		$wp_customize->add_setting( 'header_image_subheading' , array(
			'default'     => '',
			'sanitize_callback' => 'materia_sanitize_text',
		) );
		$wp_customize->add_control(
			new WP_Customize_Control( $wp_customize, 'header_image_subheading',
				array(
					'label'		=> __( 'Header Image Subheading', 'icefit' ),
					'section'	=> 'header_image',
					'settings'	=> 'header_image_subheading',
					'type'		=> 'text',
				)
			)
		);

		$wp_customize->add_setting( 'header_image_headings_color' , array(
			'default'     => '#ffffff',
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control( $wp_customize, 'header_image_headings_color',
				array(
					'label'		=> __( 'Header Image Headings Color', 'icefit' ),
					'section'	=> 'header_image',
					'settings'	=> 'header_image_headings_color',
				)
			)
		);

		$wp_customize->add_setting( 'header_image_button_1_text' , array(
			'default'     => '',
			'sanitize_callback' => 'materia_sanitize_text',
		) );
		$wp_customize->add_control(
			new WP_Customize_Control( $wp_customize, 'header_image_button_1_text',
				array(
					'label'		=> __( 'Button 1 Text', 'icefit' ),
					'section'	=> 'header_image',
					'settings'	=> 'header_image_button_1_text',
					'type'		=> 'text',
				)
			)
		);

		$wp_customize->add_setting( 'header_image_button_1_link' , array(
			'default'     => '',
			'sanitize_callback' => 'materia_sanitize_text',
		) );
		$wp_customize->add_control(
			new WP_Customize_Control( $wp_customize, 'header_image_button_1_link',
				array(
					'label'		=> __( 'Button 1 link', 'icefit' ),
					'section'	=> 'header_image',
					'settings'	=> 'header_image_button_1_link',
					'type'		=> 'text',
				)
			)
		);

		$wp_customize->add_setting( 'header_image_button_2_text' , array(
			'default'     => '',
			'sanitize_callback' => 'materia_sanitize_text',
		) );
		$wp_customize->add_control(
			new WP_Customize_Control( $wp_customize, 'header_image_button_2_text',
				array(
					'label'		=> __( 'Button 2 Text', 'icefit' ),
					'section'	=> 'header_image',
					'settings'	=> 'header_image_button_2_text',
					'type'		=> 'text',
				)
			)
		);

		$wp_customize->add_setting( 'header_image_button_2_link' , array(
			'default'     => '',
			'sanitize_callback' => 'materia_sanitize_text',
		) );
		$wp_customize->add_control(
			new WP_Customize_Control( $wp_customize, 'header_image_button_2_link',
				array(
					'label'		=> __( 'Button 2 link', 'icefit' ),
					'section'	=> 'header_image',
					'settings'	=> 'header_image_button_2_link',
					'type'		=> 'text',
				)
			)
		);

		// Setting and control for materia upgrade message
		$wp_customize->add_setting( 'materia_upgrade', array(
			'default'	=> 'https://www.iceablethemes.com/shop/materia-pro/',
			'sanitize_callback' => 'materia_sanitize_button',
		) );
		$wp_customize->add_control(
			new materia_Button_Customize_Control( $wp_customize, 'materia_upgrade',
				array(
					'label'			=> __( 'Get Materia Pro', 'materia-lite' ),
					'description'	=> __( 'Unleash the full potential of materia with tons of additional settings, advanced features and premium support.', 'materia-lite'),
					'section'		=> 'materia_more',
					'settings'		=> 'materia_upgrade',
					'type'			=> 'button',
				)
			)
		);

		// Setting and control for materia support forums message
		$wp_customize->add_setting( 'materia_support', array(
			'default'	=> 'https://www.iceablethemes.com/forums/forum/free-support-forum/materia-lite/',
			'sanitize_callback' => 'materia_sanitize_button',
		) );
		$wp_customize->add_control(
			new materia_Button_Customize_Control( $wp_customize, 'materia_support',
				array(
					'label'			=> __( 'Materia Lite support forums', 'materia-lite' ),
					'description'	=> __( 'Have a question? Need help?', 'materia-lite'),
					'section'		=> 'materia_more',
					'settings'		=> 'materia_support',
					'type'			=> 'button',
				)
			)
		);

		// Setting and control for materia feedback message
		$wp_customize->add_setting( 'materia_feedback', array(
			'default'	=> 'https://wordpress.org/support/view/theme-reviews/materia-lite',
			'sanitize_callback' => 'materia_sanitize_button',
		) );
		$wp_customize->add_control(
			new materia_Button_Customize_Control( $wp_customize, 'materia_feedback',
				array(
					'label'			=> __( 'Rate Materia Lite', 'materia-lite' ),
					'description'	=> __( 'Like this theme? We\'d love to hear your feedback!', 'materia-lite'),
					'section'		=> 'materia_more',
					'settings'		=> 'materia_feedback',
					'type'			=> 'button',
				)
			)
		);


	}

	public static function customize_controls_scripts(){
		wp_enqueue_style(
			'materia-customizer-controls-style',
			THEME_DIR_URI . '/inc/customizer/css/customizer-controls.css',
			array( 'customize-controls' )
		);

		wp_register_script(
			  'materia-customizer-section',
			  THEME_DIR_URI . '/inc/customizer/js/materia-customizer-section.js',
			  array( 'jquery','jquery-ui-core','jquery-ui-button','customize-controls' ),
			  '',
			  true
		);
		$materia_customizer_section_l10n = array(
			'upgrade_pro' => __( 'Upgrade to materia Pro!', 'materia-lite' ),
		);
		wp_localize_script( 'materia-customizer-section', 'materia_customizer_section_l10n', $materia_customizer_section_l10n );
		wp_enqueue_script( 'materia-customizer-section' );
	}

}
add_action( 'customize_register' , array( 'Materia_Customizer' , 'register' ) );
add_action ('customize_controls_enqueue_scripts', array( 'Materia_Customizer', 'customize_controls_scripts' ));

// Create custom controls for customizer
if ( class_exists( 'WP_Customize_Control' ) ) {
	class Materia_Button_Customize_Control extends WP_Customize_Control {
		public $type = 'button';
		public function render_content() {
			?><label>
			<span class="description customize-control-description"><?php echo $this->description; ?></span>
			<a class="button" href="<?php echo esc_url( $this->value() ); ?>" target="_blank"><?php echo esc_html( $this->label ); ?></a>
			</label><?php
		}
	}
}

function materia_sanitize_blog_index_content( $input ){
	$choices = array( 'excerpt', 'content' );
	if ( in_array($input, $choices) ):
		return $input;
	else:
		return '';
	endif;
}

function materia_sanitize_on_off( $input ){
	$choices = array( 'on', 'off' );
	if ( in_array($input, $choices) ):
		return $input;
	else:
		return '';
	endif;
}

function materia_sanitize_display_mode( $input ){
	$choices = array( 'card', 'full-width' );
	if ( in_array($input, $choices) ):
		return $input;
	else:
		return '';
	endif;
}

function materia_sanitize_button( $input ){
	return '';
}

function materia_sanitize_text( $input ){
	return sanitize_text_field( $input );
}

?>
