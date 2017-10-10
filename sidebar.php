<?php
/**
 *
 * Materia Lite WordPress Theme by Iceable Themes | https://www.iceablethemes.com
 *
 * Copyright 2017 Mathieu Sarrasin - Iceable Media
 *
 * Sidebar
 *
 */

?>
<ul id="sidebar" class="sidebar">

	<?php if ( ! dynamic_sidebar( 'sidebar' ) && current_user_can( 'edit_theme_options' ) ) : ?>
		
		<li id="customize-sidebar" class="widget">
			<h3 class="widget-title"><?php esc_html_e( 'Add some widgets', 'materia-lite' ); ?></h3>
			<div><a href="<?php echo esc_url( get_admin_url( null, 'widgets.php' ) ); ?>"><?php esc_html_e( 'Click here to add widgets to your sidebar!', 'materia-lite' ); ?></a></div>
		</li>

	<?php endif; ?>
</ul>
