<?php
/**
* class Config
*
* Basic library for configuration.
*/
if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); }

if(!defined('HB_PLUGIN_PATH')) define('HB_PLUGIN_PATH', str_replace('lib/', '', plugin_dir_path( __FILE__ )));
if(!defined('HB_PLUGIN_DIR')) define('HB_PLUGIN_DIR', 'socialize-it');
if(!defined('HB_IMG_URL')) define('HB_IMG_URL', WP_PLUGIN_URL.'/'.HB_PLUGIN_DIR.'/img/');

if ( !class_exists('Config') ) :
	
	class Config {
	
		const plugin_name = 'Socialize It!';
		const min_php_version = '5.2';
		const min_wp_version = '3.0';
		const domain = 'wp-socialize-it';
		
		/**
		* _get_services_info
		*
		* all used services
		* @returns array of data.
		*/
		public static function _get_services_info() {
		
			$services = array();
			$services['blogger']['name'] = __('Blogger', self::domain);
			$services['blogger']['url'] = 'http://www.blogger.com/blog_this.pyra?t&u=\'+u+\'&n=\'+\'';
			$services['blogger']['title'] = __('Post in Blogger.com!', self::domain);
			$services['blogger']['32'] = '-192px 0px';
			$services['blogger']['24'] = '-144px 0px';
			$services['blogger']['16'] = '-96px 0px';
			
			$services['bobrdobr']['name'] = __('BobrDobr', self::domain);
			$services['bobrdobr']['url'] = 'http://bobrdobr.ru/add.html?url=\'+u+\'&title=\'+t+\'';
			$services['bobrdobr']['title'] = __('Bobr It!', self::domain);;
			$services['bobrdobr']['32'] = '-128px 0px';
			$services['bobrdobr']['24'] = '-96px 0px';
			$services['bobrdobr']['16'] = '-64px 0px';
			
			$services['delicious']['name'] = __('Delicious', self::domain);
			$services['delicious']['url'] = 'http://delicious.com/save?url=\'+u+\'&title=\'+t+\'';
			$services['delicious']['title'] = __('Bookmark with Delicious!', self::domain);
			$services['delicious']['32'] = '-64px 0px';
			$services['delicious']['24'] = '-48px 0px';
			$services['delicious']['16'] = '-32px 0px';
			
			$services['design-bump']['name'] = __('DesignBump', self::domain);
			$services['design-bump']['url'] = 'http://designbump.com/node/add/drigg/?url=\'+u+\'&title=\'+t+\'';
			$services['design-bump']['title'] = __('Bump it!', self::domain);;
			$services['design-bump']['32'] = '-288px 0px';
			$services['design-bump']['24'] = '-216px 0px';
			$services['design-bump']['16'] = '-144px 0px';
			
			$services['design-float']['name'] = __('DesignFloat', self::domain);
			$services['design-float']['url'] = 'http://www.designfloat.com/submit.php?url=\'+u+\'';
			$services['design-float']['title'] = __('Float it!', self::domain);
			$services['design-float']['32'] = '-256px -32px';
			$services['design-float']['24'] = '-192px -24px';
			$services['design-float']['16'] = '-128px -16px';
			
			$services['digg']['name'] = __('digg', self::domain);
			$services['digg']['url'] = 'http://digg.com/submit?url=\'+u+\'';
			$services['digg']['title'] = __('Add to digg!', self::domain);
			$services['digg']['32'] = '-160px -32px';
			$services['digg']['24'] = '-120px -24px';
			$services['digg']['16'] = '-80px -16px';
			
			$services['evernote']['name'] = __('evernote', self::domain);
			$services['evernote']['url'] = 'http://www.evernote.com/clip.action?url=\'+u+\'&title=\'+t+\'';
			$services['evernote']['title'] = __('Add to Evernote!', self::domain);
			$services['evernote']['32'] = '-96px -32px';
			$services['evernote']['24'] = '-72px -24px';
			$services['evernote']['16'] = '-48px -16px';
			
			$services['facebook']['name'] = __('facebook', self::domain);
			$services['facebook']['url'] = 'http://www.facebook.com/sharer.php?u=\'+u+\'&t=\'+t+\'';
			$services['facebook']['title'] = __('Share in Facebook!', self::domain);
			$services['facebook']['32'] = '-64px -32px';
			$services['facebook']['24'] = '-48px -24px';
			$services['facebook']['16'] = '-32px -16px';
			
			$services['friendfeed']['name'] = __('FriendFeed', self::domain);
			$services['friendfeed']['url'] = 'http://www.friendfeed.com/share?title=\'+t+\'';
			$services['friendfeed']['title'] = __('Add to FriendFeed!', self::domain);
			$services['friendfeed']['32'] = '-224px -64px';
			$services['friendfeed']['24'] = '-168px -48px';
			$services['friendfeed']['16'] = '-112px -32px';
			
			$services['google-bookmarks']['name'] = __('Google Bookmarks', self::domain);
			$services['google-bookmarks']['url'] = 'http://www.google.com/bookmarks/mark?op=edit&output=popup&bkmk=\'+u+\'&title=\'+t+\'';
			$services['google-bookmarks']['title'] = __('Bookmark at Google!', self::domain);
			$services['google-bookmarks']['32'] = '-96px -64px';
			$services['google-bookmarks']['24'] = '-72px -48px';
			$services['google-bookmarks']['16'] = '-48px -32px';
			
			$services['google-buzz']['name'] = __('Google Buzz', self::domain);
			$services['google-buzz']['url'] = 'http://www.google.com/buzz/post?message=\'+t+\'&url=\'+u+\'';
			$services['google-buzz']['title'] = __('Add to Google Buzz!', self::domain);
			$services['google-buzz']['32'] = '-64px -64px';
			$services['google-buzz']['24'] = '-48px -48px';
			$services['google-buzz']['16'] = '-32px -32px';
			
			$services['identi']['name'] = __('identi', self::domain);
			$services['identi']['url'] = 'http://identi.ca/notice/new?status_textarea=\'+t+\' - \'+u+\'';
			$services['identi']['title'] = __('Add to Identi.ca!', self::domain);
			$services['identi']['32'] = '0 -64px';
			$services['identi']['24'] = '0 -48px';
			$services['identi']['16'] = '0 -32px';
			
			$services['juick']['name'] = __('juick', self::domain);
			$services['juick']['url'] = 'http://www.juick.com/post?body=\'+t+\' - \'+u+\'';
			$services['juick']['title'] = __('Add to Juick!', self::domain);
			$services['juick']['32'] = '-256px -96px';
			$services['juick']['24'] = '-192px -72px';
			$services['juick']['16'] = '-128px -48px';
			
			$services['linkedin']['name'] = __('LinkedIn', self::domain);
			$services['linkedin']['url'] = 'http://www.linkedin.com/shareArticle?mini=true&url=\'+u+\'&title=\'+t+\'';
			$services['linkedin']['title'] = __('Add to Linkedin!', self::domain);
			$services['linkedin']['32'] = '-160px -96px';
			$services['linkedin']['24'] = '-120px -72px';
			$services['linkedin']['16'] = '-80px -48px';
			
			$services['liveinternet']['name'] = __('LiveInternet', self::domain);
			$services['liveinternet']['url'] = 'http://www.liveinternet.ru/journal_post.php?action=n_add&cnurl=\'+u+\'&cntitle=\'+t+\'';
			$services['liveinternet']['title'] = __('Post in LiveInternet!', self::domain);
			$services['liveinternet']['32'] = '-128px -96px';
			$services['liveinternet']['24'] = '-96px -72px';
			$services['liveinternet']['16'] = '-64px -48px';
			
			$services['livejournal']['name'] = __('LiveJournal', self::domain);
			$services['livejournal']['url'] = 'http://www.livejournal.com/update.bml?event=\'+u+\'&subject=\'+t+\'';
			$services['livejournal']['title'] = __('Post in LiveJournal!', self::domain);
			$services['livejournal']['32'] = '-96px -96px';
			$services['livejournal']['24'] = '-72px -72px';
			$services['livejournal']['16'] = '-48px -48px';
			
			$services['mail-ru']['name'] = __('Mail.Ru', self::domain);
			$services['mail-ru']['url'] = 'http://connect.mail.ru/share?url=\'+u+\'&title=\'+t+\'';
			$services['mail-ru']['title'] = __('Share in MyWorld@Mail.Ru!', self::domain);
			$services['mail-ru']['32'] = '-64px -96px';
			$services['mail-ru']['24'] = '-48px -72px';
			$services['mail-ru']['16'] = '-32px -48px';
			
			$services['memori']['name'] = __('memori', self::domain);
			$services['memori']['url'] = 'http://memori.ru/link/?sm=1&u_data[url]=\'+u+\'&u_data[name]=\'+t+\'';
			$services['memori']['title'] = __('Bookmark at Memori.ru!', self::domain);
			$services['memori']['32'] = '-32px -96px';
			$services['memori']['24'] = '-24px -72px';
			$services['memori']['16'] = '-16px -48px';
			
			$services['mister-wong']['name'] = __('Mister Wong', self::domain);
			$services['mister-wong']['url'] = 'http://www.mister-wong.ru/index.php?action=addurl&bm_url=\'+u+\'&bm_description=\'+t+\'';
			$services['mister-wong']['title'] = __('Bookmark at Mister Wong!', self::domain);
			$services['mister-wong']['32'] = '0 -96px';
			$services['mister-wong']['24'] = '0 -72px';
			$services['mister-wong']['16'] = '0 -48px';
			
			$services['mixx']['name'] = __('mixx', self::domain);
			$services['mixx']['url'] = 'http://www.mixx.com/submit?page_url=\'+u+\'&title=\'+t+\'';
			$services['mixx']['title'] = __('Add to Mixx!', self::domain);
			$services['mixx']['32'] = '-288px -96px';
			$services['mixx']['24'] = '-216px -72px';
			$services['mixx']['16'] = '-144px -48px';
			
			$services['myspace']['name'] = __('MySpace', self::domain);
			$services['myspace']['url'] = 'http://www.myspace.com/Modules/PostTo/Pages/?u=\'+u+\'&t=\'+t+\'';
			$services['myspace']['title'] = __('Add to MySpace!', self::domain);
			$services['myspace']['32'] = '-96px -128px';
			$services['myspace']['24'] = '-72px -96px';
			$services['myspace']['16'] = '-48px -64px';
			
			$services['netvibes']['name'] = __('netvibes', self::domain);
			$services['netvibes']['url'] = 'http://www.netvibes.com/share?title=\'+t+\'&url=\'+u+\'';
			$services['netvibes']['title'] = __('Add to Netvibes!', self::domain);
			$services['netvibes']['32'] = '-64px -128px';
			$services['netvibes']['24'] = '-48px -96px';
			$services['netvibes']['16'] = '-32px -64px';
			
			$services['newsvine']['name'] = __('newsvine', self::domain);
			$services['newsvine']['url'] = 'http://www.newsvine.com/_tools/seed&save?u=\'+u+\'&h=\'+t+\'';
			$services['newsvine']['title'] = __('Add to Newsvine!', self::domain);
			$services['newsvine']['32'] = '0 -128px';
			$services['newsvine']['24'] = '0 -96px';
			$services['newsvine']['16'] = '0 -64px';
			
			$services['odnoklassniki']['name'] = __('odnoclassniki', self::domain);
			$services['odnoklassniki']['url'] = 'http://www.odnoklassniki.ru/dk?st.cmd=addShare&st._surl=\'+u+\'&title=\'+t+\'';
			$services['odnoklassniki']['title'] = __('Add to Odnoclassniki!', self::domain);
			$services['odnoklassniki']['32'] = '-32px -128px';
			$services['odnoklassniki']['24'] = '-24px -96px';
			$services['odnoklassniki']['16'] = '-16px -64px';
			
			$services['pikabu']['name'] = __('pikabu', self::domain);
			$services['pikabu']['url'] = 'http://pikabu.ru/add_story.php?story_url=\'+u+\'';
			$services['pikabu']['title'] = __('Add to Pikabu!', self::domain);
			$services['pikabu']['32'] = '-160px -160px';
			$services['pikabu']['24'] = '-120px -120px';
			$services['pikabu']['16'] = '-80px -80px';
			
			$services['posterous']['name'] = __('posterous', self::domain);
			$services['posterous']['url'] = 'http://posterous.com/share?linkto=\'+u+\'&title=\'+t+\'';
			$services['posterous']['title'] = __('Add to Posterous!', self::domain);
			$services['posterous']['32'] = '-96px -160px';
			$services['posterous']['24'] = '-72px -120px';
			$services['posterous']['16'] = '-48px -80px';
			
			$services['reddit']['name'] = __('reddit', self::domain);
			$services['reddit']['url'] = 'http://reddit.com/submit?url=\'+u+\'&title=\'+t+\'';
			$services['reddit']['title'] = __('Add to Reddit!', self::domain);
			$services['reddit']['32'] = '0 -160px';
			$services['reddit']['24'] = '0 -120px';
			$services['reddit']['16'] = '0 -80px';
			
			$services['rutvit']['name'] = __('rutvit', self::domain);
			$services['rutvit']['url'] = 'http://rutvit.ru/tools/widgets/share/popup?url=\'+u+\'&title=\'+t+\'';
			$services['rutvit']['title'] = __('Add to RuTvit!', self::domain);
			$services['rutvit']['32'] = '-256px -160px';
			$services['rutvit']['24'] = '-192px -120px';
			$services['rutvit']['16'] = '-128px -80px';
			
			$services['stumbleupon']['name'] = __('StumbleUpon', self::domain);
			$services['stumbleupon']['url'] = 'http://www.stumbleupon.com/submit?url=\'+u+\'&title=\'+t+\'';
			$services['stumbleupon']['title'] = __('Add to StumbleUpon!', self::domain);
			$services['stumbleupon']['32'] = '-192px -160px';
			$services['stumbleupon']['24'] = '-144px -120px';
			$services['stumbleupon']['16'] = '-96px -80px';
			
			$services['technorati']['name'] = __('technorati', self::domain);
			$services['technorati']['url'] = 'http://technorati.com/faves?add=\'+u+\'&title=\'+t+\'';
			$services['technorati']['title'] = __('Add to Technorati!', self::domain);
			$services['technorati']['32'] = '-288px -160px';
			$services['technorati']['24'] = '-216px -120px';
			$services['technorati']['16'] = '-144px -80px';
			
			$services['tumblr']['name'] = __('tumblr', self::domain);
			$services['tumblr']['url'] = 'http://www.tumblr.com/share?v=3&u=\'+u+\'&t=\'+t+\'';
			$services['tumblr']['title'] = __('Add to Tumblr!', self::domain);
			$services['tumblr']['32'] = '-64px -192px';
			$services['tumblr']['24'] = '-48px -144px';
			$services['tumblr']['16'] = '-32px -96px';
			
			$services['twitter']['name'] = __('twitter', self::domain);
			$services['twitter']['url'] = 'http://twitter.com/share?text=\'+t+\'&url=\'+u+\'';
			$services['twitter']['title'] = __('Add to Twitter!', self::domain);
			$services['twitter']['32'] = '-32px -192px';
			$services['twitter']['24'] = '-24px -144px';
			$services['twitter']['16'] = '-16px -96px';
			
			$services['vkontakte']['name'] = __('vkontakte', self::domain);
			$services['vkontakte']['url'] = '#';
			$services['vkontakte']['title'] = __('Share in Vkontakte!', self::domain);
			$services['vkontakte']['onclick'] = "window.open(\'http://vkontakte.ru/share.php?url='+u+'\', \'_blank\', \'scrollbars=0, resizable=1, menubar=0, left=200, top=200, width=554, height=421, toolbar=0, status=0\');return false;";
			$services['vkontakte']['32'] = '-288px -192px';
			$services['vkontakte']['24'] = '-216px -144px';
			$services['vkontakte']['16'] = '-144px -96px';
			
			$services['yahoo-bookmarks']['name'] = __('Yahoo! Bookmarks', self::domain);
			$services['yahoo-bookmarks']['url'] = 'http://bookmarks.yahoo.com/toolbar/savebm?u=\'+u+\'&t=\'+t+\'';
			$services['yahoo-bookmarks']['title'] = __('Bookmark at Yahoo!', self::domain);
			$services['yahoo-bookmarks']['32'] = '-256px -192px';
			$services['yahoo-bookmarks']['24'] = '-192px -144px';
			$services['yahoo-bookmarks']['16'] = '-128px -96px';
			
			$services['yandex']['name'] = __('Yandex Bookmarks', self::domain);
			$services['yandex']['url'] = 'http://zakladki.yandex.ru/newlink.xml?url=\'+u+\'&name=\'+t+\'';
			$services['yandex']['title'] = __('Bookmark at Yandex!', self::domain);
			$services['yandex']['32'] = '-192px -192px';
			$services['yandex']['24'] = '-144px -144px';
			$services['yandex']['16'] = '-96px -96px';
			
			$services['yaru']['name'] = __('Ya.ru', self::domain);
			$services['yaru']['url'] = '"http://my.ya.ru/posts_add_link.xml?URL=\'+u+\'&title=\'+t+\'';
			$services['yaru']['title'] = __('Share in Ya.ru!', self::domain);
			$services['yaru']['32'] = '-160px -192px';
			$services['yaru']['24'] = '-120px -144px';
			$services['yaru']['16'] = '-80px -96px';
			
			$services['print']['name'] = __('Print', self::domain);
			$services['print']['url'] = '#';
			$services['print']['title'] = __('Print it!', self::domain);
			$services['print']['onclick'] = 'print();return false;';
			$services['print']['32'] = '-64px -160px';
			$services['print']['24'] = '-48px -120px';
			$services['print']['16'] = '-32px -80px';
			
			/*
			$services['rss']['name'] = __('Subscribe', self::domain);
			$services['rss']['url'] = get_permalink().'/feed';
			$services['rss']['title'] = __('Subscribe to feed', self::domain);
			$services['rss']['32'] = '-64px -224px';
			$services['rss']['24'] = '-48px -168px';
			$services['rss']['16'] = '-32px -112px';
			*/
			
			return $services;
			
		}
		
		public static function _get_lng() {
			$lng['back'] = __('Back', self::domain);
			$lng['more'] = __('More', self::domain);
			$lng['hblogotitle'] = __('Download plugin Socialize It!', self::domain);
			return $lng;
		}

	}

endif;
/*EOF*/