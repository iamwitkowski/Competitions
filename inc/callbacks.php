<?php
	/**
	 * Get all submissions items
	 * @param $request WP_Request
	 * return object WP_REST_Response
	 */
	
	function api_get_callback($request)
	{
		$posts = get_posts( [ 'post_type' => 'submission', 'post_status' => 'draft' ] );
		if( count($posts) > 0 ){
			$response['status'] =  200;
			$response['success'] = true;
			$response['data'] = $posts;
		}else{
			$response['status'] =  200;
			$response['success'] = false;
			$response['message'] = 'NO posts!';
		}
		wp_reset_postdata();
		return new WP_REST_Response( $response );
	}
	
	
	
	/**
	 * Post submission by rest api
	 * @param  object $request WP_Request with data
	 * @return object WP_REST_Response
	 */
	function api_post_callback( $request ){
		
		if( $request->get_header('token') == TOKEN) {
			
			$submission['post_title'] = sanitize_text_field( $request->get_param( 'name' ) );
			$submission['post_status'] = 'draft';
			$submission['post_type'] = 'submission';
			$submission['meta_input'] = [
				$checkboxes = $request->get_param('checkbox'),
				'regulations' =>  sanitize_text_field($checkboxes[0]),
				'rodo' => sanitize_text_field($checkboxes[1]),
				'statement' => sanitize_text_field($checkboxes[2]),
				'marketing' => sanitize_text_field($checkboxes[3]),
				'answer' => sanitize_text_field($request->get_param('answer')),
				'status' => 'oczekuje',
				'mail' => sanitize_text_field( $request->get_param( 'mail' ) ),
			];
			
			$new_submission_id = wp_insert_post($submission);
			
			if( !is_wp_error( $new_submission_id) ){
				$response['status'] =  200;
				$response['success'] = true;
				$response['submission'] = get_permalink( $new_submission_id ) ;
			}else{
				$response['status'] =  200;
				$response['success'] = false;
				$response['message'] = 'No post found!';
			}
			
			
		}
		else {
			$response['message'] = 'Wrong API token!';
		}
		return new WP_REST_Response( $response );
	}
