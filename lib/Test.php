<?php
/**
* class Test
*
* Basic library for run-time tests.
*/
if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); }

if ( !class_exists('Test') ) :
	
	class Test {
	
		/**
		* min_php_version
		*
		* Test that your PHP version is at least that of the $min_php_version.
		* @param $min_php_version string representing the minimum required version of PHP, e.g. '5.3.2'
		* @param $plugin_name string Name of the plugin for messaging purposes.
		* @return none Exit with messaging if PHP version is too old.
		*/
		static function min_php_version ($min_php_version, $plugin_name) {
			
			$exit_msg = sprintf(__('The %s plugin requires PHP %s or newer. Contact your system administrator about updating your version of PHP.', Config::domain), $plugin_name, $min_php_version);
			
			if ( version_compare(phpversion(),$min_php_version,'<') ) {
				exit($exit_msg);
			}
			
		}
		
		/**
		* min_wp_version
		*
		* Test that your WordPress version is at least that of the $min_wp_version.
		* @param $min_wp_version string representing the minimum required version of WP, e.g. '3.0'
		* @param $plugin_name string Name of the plugin for messaging purposes.
		* @return none Exit with messaging if PHP version is too old.
		*/
		static function min_wp_version ($min_wp_version, $plugin_name) {
			
			global $wp_version;

			$exit_msg = sprintf(__('The %s plugin requires WordPress %s or newer.', Config::domain), $plugin_name, $min_wp_version);
			$exit_msg .= ' '.sprintf(__('Your version is %s. Please,', Config::domain), $wp_version);
			$exit_msg .= ' <a href="">';
			$exit_msg .= __('update your WordPress!', Config::domain);
			$exit_msg .= '</a>';
			
			if ( version_compare($wp_version,$min_wp_version,'<') ) {
				exit($exit_msg);
			}

		}
		
	}

endif;
/*EOF*/