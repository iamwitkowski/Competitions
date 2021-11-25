<?php
	
	add_action('init', 'registerCPT');
	
	function registerCPT() {
		
		register_post_type(
			COMPETITION_NAME,
			array(
				'labels' => array(
					'name' => __(COMPETITION_NAME, 'zkd'),
					'singular_name' => __(COMPETITION_NAME, 'zkd'),
				),
				'public'  => true,
				'show_ui' => true,
				'has_archive' => true,
				'menu_icon' => 'dashicons-format-status',
				'supports' => array('title', 'editor', 'thumbnail'),
				'show_in_rest' => true,
				'rest_base' => COMPETITION_NAME,
				'publicly_queryable'  => true,
			)
		);
		// register submissions
		register_post_type(
			'Submissions',
			array(
				'labels' => array(
					'name' => __('Zgłoszenia', 'zkd'),
					'singular_name' => __('Zgłoszenia', 'zkd'),
				),
				'public'  => true,
				'show_ui' => true,
				'has_archive' => true,
				'menu_icon' => 'dashicons-format-status',
				'supports' => array('title', 'editor', 'thumbnail'),
				'show_in_rest' => true,
				'rest_base' => 'submissions',
				'publicly_queryable'  => true,
			)
		);
	}