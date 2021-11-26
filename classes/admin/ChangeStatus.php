<?php
	/**
	 * class for change status of submissions
	 *
	 * @author MW
	 *
	 */
	
	namespace competitions;
	use competitions\mailService;
	
	class ChangeStatus
	{
		function __construct()
		{
			add_filter('bulk_actions-edit-submission', array( $this, 'add_bulk_actions' ));
			add_filter('handle_bulk_actions-edit-submission',  array( $this, 'accept_submission_bulk_action' ), 10, 3);
			add_filter('handle_bulk_actions-edit-submission',  array( $this, 'reject_submission_bulk_action' ), 10, 3);
			add_filter('handle_bulk_actions-edit-submission',  array( $this, 'queued_submission_bulk_action' ), 10, 3);
		}
		
		/*
		 * add bulk actions for status change
		 *
		 */
		
		function add_bulk_actions($bulk_actions)
		{
			$bulk_actions['accept'] = __('Akceptuj', 'txtdomain');
			$bulk_actions['reject'] = __('Odrzuć', 'txtdomain');
			$bulk_actions['queued'] = __('Zmień na oczekujący', 'txtdomain');
			return $bulk_actions;
		}
		
		/*
		 * accept submission
		 *
		 */
		
		public function accept_submission_bulk_action($redirect_url, $action, $post_ids)
		{
			if ($action == 'accept') {
				foreach ($post_ids as $post_id) {
					update_post_meta($post_id, 'status', 'accept');
					mailService::sendAccept($post_id);
				}
				$redirect_url = add_query_arg('accept', count($post_ids), $redirect_url);
			}
			
			return $redirect_url;
			
		}
		
		/*
		 * reject submission
		 *
		 */
		
		function reject_submission_bulk_action($redirect_url, $action, $post_ids)
		{
			if ($action == 'reject') {
				foreach ($post_ids as $post_id) {
					update_post_meta($post_id, 'status', 'reject');
					mailService::sendReject($post_id);
				}
				$redirect_url = add_query_arg('reject', count($post_ids), $redirect_url);
			}
			return $redirect_url;
		}
		
		/*
		 * change status to queued
		 *
		 */
		
		function queued_submission_bulk_action($redirect_url, $action, $post_ids)
		{
			if ($action == 'queued') {
				foreach ($post_ids as $post_id) {
					update_post_meta($post_id, 'status', 'waiting');
				}
				$redirect_url = add_query_arg('queued', count($post_ids), $redirect_url);
			}
			return $redirect_url;
		}
	}