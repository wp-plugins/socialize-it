<?php
/*
Plugin Name: Socialize It!
Plugin URI: http://wpsells.com/blog/wordpress-tech/215.html
Description: Floating social buttons bar. Based on Share42.com
Author: Igor Ocheretny
Version: 1.2
Author URI: http://wpsells.com/blog/
*/
require_once('lib/Test.php');
require_once('lib/Config.php');
require_once('inc/SocializeIt.php');
add_action('init', 'SocializeIt::initialize');
add_action('wp_footer', 'SocializeIt::wp_footer');
add_action('admin_menu', 'SocializeIt::add_menu_item');
add_action('wp_ajax_submithb', 'SocializeIt::submit_settings');
add_filter('the_content', 'SocializeIt::bind_buttons');
/*EOF*/