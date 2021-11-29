<?php
	
	/*
	 * create e-mail content creator in dashboard
	 *
	 * @author MW
	 *
	 */
	
	namespace competitions;
	
	use competitions\mailService;
	
	class Winner
	{
		
		function __construct() {
			self::setOptionsPage();
		}
		
		public static function setOptionsPage()
		{
			if (function_exists('acf_add_options_page'))
			{
				acf_add_options_page(array(
					'page_title' => __('WinnerMail', 'zkd'),
					'menu_title' => __('Zwycięzca konkursu - konfigurator', 'zkd'),
					'menu_slug' => 'mail-winner',
					'capability' => 'manage_options',
					'icon_url' => 'dashicons-list-view',
					'redirect' => false
				));
			}
		}
	}