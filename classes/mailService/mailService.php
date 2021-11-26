<?php
	/*
	 * class responsible to mail notifications
	 *
	 */
	namespace competitions;
	
	class mailService
	{
		function __construct()
		{
			add_action( 'transition_post_status', array( $this, 'send_confirmation' ), 10, 3);
			
		}
		
		
		function send_confirmation( $new, $old, $post )
		{
			if ( ( $new == 'draft' ) && ( $old != 'publish' || $old != 'auto-draft' ||  $old != 'draft' ) && ( $post->post_type == 'submission' ) )
			{
				$emailto = get_field('mail', $post->ID);
				$subject = 'Przyjęliśmy zgłoszenie. Dziękujemy za udział w konkursie';
				ob_start();
				include(ROOT_DIR . '/mail-templates/confirm.php');
				$email_content = ob_get_contents();
				ob_end_clean();
				$headers = array('Content-Type: text/html; charset=UTF-8');
				wp_mail($emailto, $subject, $email_content, $headers);
				
				
				$mailLog['post_title'] = ''.$subject.' '.$emailto.'';
				$mailLog['post_status'] = 'draft';
				$mailLog['post_type'] = 'email-log';
				
				$new_mail_id = wp_insert_post($mailLog);
			}
			else {
				return;
			}
		}
	
		public static function sendAccept($post_id)
		{
			$emailto = get_field('mail', $post_id);
			$subject = 'Zgłoszenie zaakceptowane';
			ob_start();
			include(ROOT_DIR . '/mail-templates/accept.php');
			$email_content = ob_get_contents();
			ob_end_clean();
			$headers = array('Content-Type: text/html; charset=UTF-8');
			wp_mail($emailto, $subject, $email_content, $headers);
			
			
			$mailLog['post_title'] = ''.$subject.' '.$emailto.'';
			$mailLog['post_status'] = 'draft';
			$mailLog['post_type'] = 'email-log';
			
			$new_mail_id = wp_insert_post($mailLog);
		}
		
		
		public static function sendReject($post_id)
		{
			$emailto = get_field('mail', $post_id);
			$subject = 'Zgłoszenie odrzucone';
			ob_start();
			include(ROOT_DIR . '/mail-templates/reject.php');
			$email_content = ob_get_contents();
			ob_end_clean();
			$headers = array('Content-Type: text/html; charset=UTF-8');
			wp_mail($emailto, $subject, $email_content, $headers);
			
			
			
			$mailLog['post_title'] = ''.$subject.' '.$emailto.'';
			$mailLog['post_status'] = 'draft';
			$mailLog['post_type'] = 'email-log';
			
			$new_mail_id = wp_insert_post($mailLog);
		}
		
	}