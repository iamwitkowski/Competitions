<?php
	/**
	 * API routes and functions
	 *
	 * @author MW
	 */
	
	namespace competitions;
	
	use WP_REST_Request;
	use WP_REST_Response;
	use WP_REST_Server;
	
	class API
	{
		public $api;
		
		public function createAPI()
		{
			add_action('rest_api_init', function () {
				register_rest_route('competition/v1', '/all/', array(
					'methods' => 'GET',
					'callback' => 'api_get_callback'
				));
				register_rest_route( 'compliments/v1', '/create/', array(
					'methods' => 'POST',
					'callback' => 'api_post_callback'
				));
			});
		}
	}

	
