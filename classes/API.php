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
		public function __construct() {
			add_action( 'rest_api_init', array( $this, 'createAPI' ));
		}
		
		public function createAPI()
		{
				register_rest_route(''.COMPETITION_NAME.'/v1', '/all/', array(
					'methods' => 'GET',
					'callback' => 'api_get_callback'
				));
				register_rest_route( ''.COMPETITION_NAME.'/v1', '/create/', array(
					'methods' => 'POST',
					'callback' => 'api_post_callback'
				));
		}
	}

	
