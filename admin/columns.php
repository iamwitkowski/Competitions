<?php
	// column list for competition submissions
	add_filter( 'manage_submission_posts_columns', 'submission_filter_posts_columns' );
	function submission_filter_posts_columns( $columns ) {
		$columns = array(
			'cb' => $columns['cb'],
			'title' => __( 'Title' ),
			'name' => __( 'Imię i nazwisko' ),
			'mail' => __( 'Adres e-mail' ),
			'answer' => __('Odpowiedź'),
		);
		return $columns;
	}
	
	// add content to columns
	add_action( 'manage_submission_posts_custom_column', 'submission_column', 10, 2);
	function submission_column( $column, $post_id )
	{
		if ($column == 'answer') {
			echo get_post_meta($post_id, 'answer', true);
		}
	}
	
	