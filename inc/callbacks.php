<?php
	/**
	 * Get all submissions items
	 * @param $request WP_Request
	 * return object WP_REST_Response
	 */
	
	function api_get_callback($request)
	{
		$posts = get_posts( [ 'post_type' => COMPETITION_NAME, 'post_status' => 'draft' ] );
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
			
			$post['post_title'] = sanitize_text_field( $request->get_param( 'name' ) ) . ' przesyła życzenia';
			$post['post_content'] = sanitize_text_field( $request->get_param( 'content' ) );
			$post['post_status'] = 'draft';
			$post['post_type'] = COMPETITION_NAME;
			$post['meta_input'] = [
				'name' => sanitize_text_field( $request->get_param( 'name' ) ),
				'filter' => sanitize_text_field( $request->get_param( 'filter' ) ),
				'compliment' => sanitize_text_field( $request->get_param( 'compliment' ) ),
				'mail' => sanitize_text_field($request->get_param('mail')),
				
				$images= $request->get_param('images'),
				'image1' =>  sanitize_text_field($images[0]),
				'image2' =>  sanitize_text_field($images[1]),
				'image3' =>  sanitize_text_field($images[2]),
			];
			
			$submission['post_title'] = sanitize_text_field( $request->get_param( 'name' ) );
			$submission['post_status'] = 'draft';
			$submission['post_type'] = 'submissions';
			$submission['meta_input'] = [
				$checkboxes = $request->get_param('checkbox'),
				'regulations' =>  sanitize_text_field($checkboxes[0]),
				'rodo' => sanitize_text_field($checkboxes[1]),
				'statement' => sanitize_text_field($checkboxes[2]),
				'marketing' => sanitize_text_field($checkboxes[3]),
				'mail' => sanitize_text_field( $request->get_param( 'mail' ) ),
			];
			
			$new_post_id = wp_insert_post( $post );
			$new_submission_id = wp_insert_post($submission);
			
			if( !is_wp_error( $new_post_id ) ){
				$response['status'] =  200;
				$response['success'] = true;
				$response['data'] = get_permalink( $new_post_id ) ;
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
