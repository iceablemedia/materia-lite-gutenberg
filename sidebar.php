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

?><ul id="sidebar" class="sidebar"><?php

	if ( ! dynamic_sidebar( 'sidebar' ) ):

	?>
	<li id="recent" class="widget">
		<h3 class="widget-title"><?php _e( 'Recent Posts', 'icefit' ); ?></h3>
		<ul><?php wp_get_archives( 'type=postbypost&limit=5' ); ?></ul>
	</li>

	<li id="archives" class="widget">
	<h3 class="widget-title"><?php _e( 'Archives', 'icefit' ); ?></h3>
	<ul><?php wp_get_archives( 'type=monthly' ); ?></ul>
	</li>

	<li id="meta" class="widget">
	<h3 class="widget-title"><?php _e( 'Meta', 'icefit' ); ?></h3>
	<ul>
		<?php wp_register(); ?>
		<li><?php wp_loginout(); ?></li>
		<?php wp_meta(); ?>
	</ul>
	</li>
	<?php endif; ?>
</ul>
