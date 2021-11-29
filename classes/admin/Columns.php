<?php
	/*
	 * add custom columns to submission list in WP-admin
	 *
	 * @author MW
	 *
	 */
	namespace competitions;
	
	class Columns
	{
		function __construct() {
			
			add_filter( 'manage_submission_posts_columns', array( $this, 'submission_filter_posts_columns' ));
			
			add_action( 'manage_submission_posts_custom_column', array( $this, 'submission_column' ), 10, 2);
			
			add_filter( 'manage_edit-submission_sortable_columns', array( $this, 'submission_sortable_columns'));
			
		}
		
		/*
		 * add columns
		 *
		 */
		
		public function submission_filter_posts_columns( $columns ) {
			$columns = array(
				'cb' => $columns['cb'],
				'title' => __( 'Tytuł' ),
				'name' => __( 'Imię i nazwisko' ),
				'mail' => __( 'Adres e-mail' ),
				'answer' => __('Odpowiedź'),
				'status' => __('Status'),
			);
			return $columns;
		}
		
		/*
		 * fill columns with custom fields value
		 *
		 */
		
		function submission_column( $column, $post_id )
		{
			if ($column == 'name') {
				echo get_post_meta($post_id, 'name', true);
			}
			if ($column == 'answer') {
				echo get_post_meta($post_id, 'answer', true);
			}
			if ($column == 'status') {
				$status = get_post_meta($post_id, 'status', true);
				if($status === 'accept') {
					$status = 'zaakceptowano';
				}
				if($status === 'reject') {
					$status = 'odrzucone';
				}
				if($status === 'waiting') {
					$status = 'oczekuje';
				}
				echo $status;
			}
			if ($column == 'mail') {
				echo get_post_meta($post_id, 'mail', true);
			}
		}
		
		
		/*
		 * sort columns asc/desc
		 *
		 */
		
		function submission_sortable_columns( $columns ) {
			$columns['name'] = 'Imię i nazwisko';
			$columns['mail'] = 'Adres e-mail';
			$columns['answer'] = 'Odpowiedź';
			$columns['status'] = 'Status';
			return $columns;
		}
	}