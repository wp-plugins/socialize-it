<?php/*** class SocializeIt** Adds popular social buttons*/if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); }class SocializeIt {		/**	* The main function for this plugin, similar to __construct()	*/	public static function initialize() {				Test::min_php_version(Config::min_php_version, Config::plugin_name);		Test::min_wp_version(Config::min_wp_version, Config::plugin_name);				wp_enqueue_script('jquery');		wp_enqueue_script("jquery-ui-core", array('jquery'));				if(self::_is_public_page()) {			$opts = self::get_settings();			$mypanel = $opts['hb_panel'];			if ($mypanel == 'floating') $stylesrc = plugins_url('css/hb.css', dirname(__FILE__));			else $stylesrc = plugins_url('css/hb_gorizontal.css', dirname(__FILE__));			wp_register_style('hundredbuttonsCSS', $stylesrc);			wp_enqueue_style('hundredbuttonsCSS');		}		else {			$astylesrc = plugins_url('css/adminhundredbuttons.css', dirname(__FILE__));			wp_register_style('adminhundredbuttonsCSS', $astylesrc);			wp_enqueue_style('adminhundredbuttonsCSS');			wp_enqueue_script("jquery-ui-tabs", array('jquery','jquery-ui-core'));			wp_enqueue_script("jquery-ui-sortable", array('jquery','jquery-ui-core'));			wp_enqueue_script("jquery-ui-selectable", array('jquery','jquery-ui-core'));		}						$lang_dir = plugin_basename(HB_PLUGIN_PATH).'/lang';		load_plugin_textdomain( Config::domain, '', $lang_dir );	}		public static function get_settings() {		if (get_option('hb_settings')) $hb_options = get_option('hb_settings');		else $hb_options = array();		return $hb_options;	}		static function wp_footer() {				if (is_single() || is_page()) {			$post_url = self::_get_post_url();			$post_title = self::_get_post_title();			echo self::_compile_buttons();			echo '<script type="text/javascript">HBSocializeIt(\''.$post_url.'\',\''.$post_title.'\');</script>';		}	}			/**	* Controller that generates admin page	*/	static function generate_admin_page() {				require('admin-page.php');	}		/**	* Adds a menu item inside the WordPress admin	*/	static function add_menu_item() {				add_submenu_page(			'plugins.php', // Menu page to attach to			'Socialize It! Settings', // page title			__('Socialize It!'), // menu title			'manage_options', // permissions			HB_PLUGIN_DIR, // page-name (used in the URL)			'SocializeIt::generate_admin_page' // clicking callback function		);			}		/**	* _is_public_page	*	* Any page that's not in the WP admin area is considered searchable.	* @return boolean Simple true/false as to whether the current page is searchable.	*/	private static function _is_public_page() {				if (is_admin()) return false;		else return true;			}		/**	/* for admin settings	*/	public static function get_admin_services_info() {				$services = array();		$services = Config::_get_services_info();		return $services;		}		/**	/* saves options to db	*/	public static function submit_settings() {				if ( !empty($_POST) && check_admin_referer('hb_admin_options', 'hb_admin_wpnonce') ) {						$hb_options = array();						$mypanel = str_replace('panel=','',urldecode($_POST['panel']));			$hbicons = urldecode($_POST['hbicons']);			$m1 = explode('&',$hbicons);						$myicons = array();			foreach($m1 as $key=>$val) {				$myicons[] = str_replace('icons=','',$val);			}						$hb_options['hb_icons'] = $myicons;			$hb_options['hb_size'] = $_POST['size'];			$hb_options['hb_panel'] = $mypanel;			$hb_options['hb_panelfloat'] = $_POST['panelfloat'];			$hb_options['hb_mtop'] = trim($_POST['hbmtop']);			$hb_options['hb_mside'] = trim($_POST['hbmside']);			$hb_options['hb_logo'] = $_POST['hblogo'];						update_option('hb_settings', $hb_options);						echo 1;				}				else echo -1;				die();		}		### front section ###		/**	* Gets the URL of the current post.	*	* @returns string the URL of the current post.	*/	private static function _get_post_url() { 				return get_permalink();			}		/**	* Gets the title of the current post.	*	* @returns string the title of the current post.	*/	private static function _get_post_title() {		$id = get_the_ID();		return get_the_title($id);	}		private static function _compile_buttons() {				$buttons = '';		$lng = Config::_get_lng();		$services = self::get_admin_services_info();		$opts = self::get_settings();		$myicons = $opts['hb_icons'];		$hblogo = $opts['hb_logo'];		$step = 8;		$blocksqty = ceil(count($myicons)/$step);					if ($opts['hb_size']) $mysize = $opts['hb_size'];		else $mysize = 32;		if ($mysize == 32) {			$hbw = $mysize*14;			$hblogo_position = '-96px -224px';		}		if ($mysize == 24) {			$hbw = $mysize*15;			$hblogo_position = '-72px -168px';		}		if ($mysize == 16) {			$hbw = $mysize*16;			$hblogo_position = '-48px -112px';		}		$hblogo_url = 'http://wpsells.com/links/blog/socialize-it.html';		$mypanel = $opts['hb_panel'];		if ($mypanel == 'floating')	{			if ($opts['hb_mside']) $mymside = $opts['hb_mside'];			else $mymside = 0;			if ($opts['hb_mtop']) $mymtop = $opts['hb_mtop'];			else $mymtop = 0;			if ($panelfloat == 'right') $mymside += 900;			$buttons .= "<script type=\"text/javascript\">HBSocializeIt=function(u,t){var mleft=".$mymside.";var m1=".$mymtop.";var m2=50;jQuery(document).ready(function(){var s=jQuery('#socializeit');s.css({top: m1,\"margin-left\": mleft});function margin(){var top=jQuery(window).scrollTop();if(top+m2<m1){s.css({top: m1-top});}else{s.css({top: m2});}}jQuery(window).scroll(function(){margin();});";			if ($blocksqty > 1) :			$buttons .= "s.append('<div id=\"hb_prev\" class=\"hbmore\" title=\"".$lng['back']."\" style=\"background:url(".HB_IMG_URL."up.png) no-repeat;width:12px;height:7px;margin:3px auto 6px;\"></div>');";			endif;			$i=0; while ($i < $blocksqty) : 			$first = $step*$i;			$myicons[$i] = array_slice($myicons, $first, $step);			foreach ($myicons[$i] as $k) :			foreach ($services as $key=>$val) :			if ($k == $key) :			$buttons .= "s.append('<div class=\"hbblock".$i."\"><a rel=\"nofollow\" href=\"".$val['url']."\"";			if ($val['onclick']) $buttons .= " onclick=\"".$val['onclick']."\"";			$buttons .= " title=\"".$val['title']."\" style=\"width:".$mysize."px;height:".$mysize."px;\"><div id=\"".$key."\" style=\"background-image:url(".HB_IMG_URL."icons-".$mysize.".png);background-repeat:no-repeat;background-position:".$val[$mysize].";width:".$mysize."px;height:".$mysize."px;\"></div></a></div>');";			endif;			endforeach;			endforeach;			if ($i>0) :			$buttons .= "jQuery('.hbblock".$i."').hide();jQuery('.hbmore".$i."').hide();";			endif;			$i++; endwhile;			if ($hblogo == 'yes') {			$buttons .= "s.append('<div class=\"hbblock".$i."\"><a rel=\"nofollow\" href=\"".$hblogo_url."\"";			$buttons .= " title=\"".$lng['hblogotitle']."\" style=\"width:".$mysize."px;height:".$mysize."px;\"><div id=\"".$key."\" style=\"background-image:url(".HB_IMG_URL."icons-".$mysize.".png);background-repeat:no-repeat;background-position:".$hblogo_position.";width:".$mysize."px;height:".$mysize."px;\"></div></a></div>');";			}			if ($blocksqty > 1) :			$buttons .= "s.append('<div id=\"hb_next\" class=\"hbmore\" title=\"".$lng['more']."\" style=\"background:url(".HB_IMG_URL."down.png) no-repeat;width:12px;height:7px;margin:6px auto 8px;\"></div>');";			endif;			$buttons .= "s.find('a').attr({target: '_blank'}).css({opacity: 0.5}).hover(function(){jQuery(this).css({opacity: 1});},function(){jQuery(this).css({opacity: 0.7});});s.hover(function(){jQuery(this).find('a').css({opacity: 0.7});},function(){jQuery(this).find('a').css({opacity: 0.5});});jQuery('.hbmore').css({opacity: 0.5}).hover(function(){jQuery(this).css({opacity: 0.8});},function(){jQuery(this).css({opacity: 0.5});});jQuery('#hb_prev').hide();var hbcounter=0;var blocksqty=".$blocksqty.";";			$buttons .= "jQuery('#hb_next').click(function(){jQuery('.hbblock'+hbcounter).animate({height: 'hide'},300);hbcounter++;jQuery('.hbblock'+hbcounter).animate({height: 'show'},300);if(hbcounter>0){jQuery('#hb_prev').show();}if (hbcounter==blocksqty-1){jQuery('#hb_next').hide();}});";			$buttons .= "jQuery('#hb_prev').click(function(){jQuery('.hbblock'+hbcounter).animate({height: 'hide'},300);hbcounter--;jQuery('.hbblock'+hbcounter).animate({height: 'show'},300);if(hbcounter==0){jQuery('#hb_prev').hide();}if(hbcounter>=0){jQuery('#hb_next').show();}});})";			$buttons .= "}</script>";		}		else {			$buttons .= "<script type=\"text/javascript\">HBSocializeIt=function(u,t){jQuery(document).ready(function(){var s=jQuery('#socializeit');var hbnav=jQuery('#hbnav');";			if ($blocksqty > 1) :			$buttons .= "hbnav.append('<div id=\"hb_prev\" class=\"hbmore\" title=\"".$lng['back']."\" style=\"float:left;\">... ".$lng['back']."</div>');";			endif;			$i=0; while ($i < $blocksqty) : 			$first = $step*$i;			$myicons[$i] = array_slice($myicons, $first, $step);			foreach ($myicons[$i] as $k) :			foreach ($services as $key=>$val) :			if ($k == $key) :			$buttons .= "s.append('<div class=\"hbblock".$i." hbholder\" style=\"display:inline-block;margin:0;padding:0;\"><a rel=\"nofollow\" href=\"".$val['url']."\"";			if ($val['onclick']) $buttons .= " onclick=\"".$val['onclick']."\"";			$buttons .= " title=\"".$val['title']."\" style=\"width:".$mysize."px;height:".$mysize."px;\"><div id=\"".$key."\" style=\"background-image:url(".HB_IMG_URL."icons-".$mysize.".png);background-repeat:no-repeat;background-position:".$val[$mysize].";width:".$mysize."px;height:".$mysize."px;margin:0 3px;\"></div></a></div>');";			endif;			endforeach;			endforeach;			if ($i>0) :			$buttons .= "jQuery('.hbblock".$i."').hide();jQuery('.hbmore".$i."').hide();";			endif;			$i++; endwhile;			if ($hblogo == 'yes') {			$buttons .= "s.append('<div class=\"hbblock".$i." hbholder\" style=\"display:inline-block;margin:0;padding:0 0 0 3px;\"><a rel=\"nofollow\" href=\"".$hblogo_url."\"";			$buttons .= " title=\"".$lng['hblogotitle']."\" style=\"width:".$mysize."px;height:".$mysize."px;\"><div id=\"".$key."\" style=\"background-image:url(".HB_IMG_URL."icons-".$mysize.".png);background-repeat:no-repeat;background-position:".$hblogo_position.";width:".$mysize."px;height:".$mysize."px;\"></div></a></div>');";			}			if ($blocksqty > 1) :			$buttons .= "hbnav.append('<div id=\"hb_next\" class=\"hbmore\" title=\"".$lng['more']."\" style=\"float:right;\">".$lng['more']." ...</div>');";			endif;			$buttons .= "s.find('a').attr({target:'_blank'});jQuery('.hbholder').css({opacity:0.5}).hover(function(){jQuery(this).css({opacity:1});},function(){jQuery(this).css({opacity:0.7});});s.hover(function(){jQuery(this).find('a').css({opacity:0.7});},function(){jQuery(this).find('a').css({opacity:0.5});});jQuery('.hbmore').css({opacity:0.5}).hover(function(){jQuery(this).css({opacity: 0.8});},function(){jQuery(this).css({opacity:0.5});});jQuery('#hb_prev').hide();var hbcounter=0;var blocksqty=".$blocksqty.";jQuery('#hb_next').click(function(){jQuery('.hbblock'+hbcounter).animate({width:'hide'},300);hbcounter++;jQuery('.hbblock'+hbcounter).animate({width:'show'},300);if(hbcounter>0){jQuery('#hb_prev').show();}if(hbcounter==blocksqty-1){jQuery('#hb_next').hide();}});jQuery('#hb_prev').click(function(){jQuery('.hbblock'+hbcounter).animate({width:'hide'},300);hbcounter--;jQuery('.hbblock'+hbcounter).animate({width:'show'},300);if(hbcounter==0){jQuery('#hb_prev').hide();}if(hbcounter>=0){jQuery('#hb_next').show();}});});";			$buttons .= "}</script>";		}				return $buttons;			}		/**	* Appends buttons to the current post or page.	*	* @returns string content + buttons.	*/	public static function bind_buttons($content) {		if (is_single() || is_page()) {						$opts = self::get_settings();			if ($opts['hb_size']) $mysize = $opts['hb_size'];			else $mysize = 32;			if ($mysize == 32) $hbw = $mysize*14;			if ($mysize == 24) $hbw = $mysize*15;			if ($mysize == 16) $hbw = $mysize*16;			$mypanel = $opts['hb_panel'];						if ($mypanel == 'floating') $content .= '<div id="socializeit"></div>';			else $content .= '<div id="hbclear" align="center"><div id="socializeit" align="center" style="width:'.$hbw.'px;height:'.$mysize.'px;"></div><div id="hbnav" style="width:'.$hbw.'px;height:6px;"></div></div>';				}				return $content;		}			}/* EOF */