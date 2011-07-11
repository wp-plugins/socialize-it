<?php if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); } ?>
<div class="wrap">
<?php screen_icon(); ?>
<h2><?php _e('Socialize It!: Settings', Config::domain); ?></h2>
<?php 
$services = SocializeIt::get_admin_services_info(); 
$opts = SocializeIt::get_settings();
$myicons = $opts['hb_icons'];
if ($opts['hb_size']) $mysize = $opts['hb_size'];
else $mysize = 32;
$mypanel = $opts['hb_panel'];
$panelfloat = $opts['hb_panelfloat'];
$mtop = $opts['hb_mtop'];
$mside = $opts['hb_mside'];
$hblogo = $opts['hb_logo'];
$hbyoutube = $opts['hb_youtube'];
$hbflickr = $opts['hb_flickr'];
$hbinviterusername = $opts['hb_inviterusername'];
$hbinviterformid = $opts['hb_inviterformid'];
$wp_lang = WPLANG;
if ($wp_lang == 'ru_RU') {
	$invdomain = 'invitemaster.ru';
	$inviconname = 'invitemaster';
}
else {
	$invdomain = 'powerinviter.com';
	$inviconname = 'powerinviter';
}
?>
<script type='text/javascript'>

jQuery(document).ready(function() {
	
	var imgpath = '<?php echo HB_IMG_URL; ?>';
	var size = <?php if (!$mysize) echo '32'; else echo $mysize; ?>;
	var hbyoutube = '<?php echo $hbyoutube; ?>';
	var hbflickr = '<?php echo $hbflickr; ?>';

	jQuery('div.section').not('.visible').hide();

	var input = jQuery('#icons li input');
	
	function check_youtube() {
		
		var youtubeinput = true;
		var youtubeinputmsg = '<?php _e('Enter the name of your YouTube account', Config::domain); ?>';
		if (hbyoutube) {
			youtubeinput = hbyoutube;
			youtubeinputmsg = '<?php _e('Check the name of your YouTube account', Config::domain); ?>';
		}
				
		var flickrinput = true;
		var flickrinputmsg = '<?php _e('Enter the name of your Flickr account', Config::domain); ?>';
				
		if (hbflickr) {
			flickrinput = hbflickr;
			flickrinputmsg = '<?php _e('Check the name of your Flickr account', Config::domain); ?>';
		}
		apprise(youtubeinputmsg + ':', {'input':youtubeinput,'animate':true,'textOk':'<?php _e('Corrert', Config::domain); ?>','textCancel':'<?php _e('Switch off', Config::domain); ?>'}, function(r){
			if(r) { 
				jQuery('#hiddens').append('<input type="hidden" name="youtubeaccname" value="' + r + '" />');
				jQuery('#youtube').attr({checked: true}).parents('li').addClass('selected');
				hbyoutube = jQuery('input[name="youtubeaccname"]').val();
			}
			else {
				jQuery('#youtube').attr({checked: false}).parents('li').removeClass('selected');
			}
					
			if (jQuery('#flickr')) {
				apprise(flickrinputmsg + ':', {'input':flickrinput,'animate':true, 'textOk':'<?php _e('Corrert', Config::domain); ?>','textCancel':'<?php _e('Switch off', Config::domain); ?>'}, function(r){
					if(r) { 
						jQuery('#hiddens').append('<input type="hidden" name="flickraccname" value="' + r + '" />');
						jQuery('#flickr').attr({checked: true}).parents('li').addClass('selected');
						hbflickr = jQuery('input[name="flickraccname"]').val();
					}
					else jQuery('#flickr').attr({checked: false}).parents('li').removeClass('selected');
				});
			}
		});
		
	}

	jQuery('#all').click(function() {
		if (jQuery('#icons li input:checked').length > 0) {
			input.each(function() {
				jQuery(this).attr({checked: false}).parents('li').removeClass('selected');
			})
		} else {
			input.each(function() {
				jQuery(this).attr({checked: true}).parents('li').addClass('selected');
			})
			check_youtube();	
		}
	})

	jQuery('#invert').click(function() {
		input.each(function() {
			if (jQuery(this).is(':checked')) {
				jQuery(this).attr({checked: false}).parents('li').removeClass('selected');
			} else {
				jQuery(this).attr({checked: true}).parents('li').addClass('selected');
			}
		})
		check_youtube();	
	})

	jQuery('#icons ol').sortable({
		placeholder: 'ui-state-highlight'
	});
	jQuery('#icons ol').disableSelection();

	input.change(function() {
		
		var youtubeinput = true;
		var youtubeinputmsg = '<?php _e('Enter the name of your YouTube account', Config::domain); ?>';
		
		if (hbyoutube) {
			youtubeinput = hbyoutube;
			youtubeinputmsg = '<?php _e('Check the name of your YouTube account', Config::domain); ?>';
		}
		
		var flickrinput = true;
		var flickrinputmsg = '<?php _e('Enter the name of your Flickr account', Config::domain); ?>';
		
		if (hbflickr) {
			flickrinput = hbflickr;
			flickrinputmsg = '<?php _e('Check the name of your Flickr account', Config::domain); ?>';
		}
		
		if (jQuery(this).attr('id') == 'youtube' && jQuery(this).attr({checked: false})) {
			apprise(youtubeinputmsg + ':', {'input':youtubeinput,'animate':true, 'textOk':'<?php _e('Corrert', Config::domain); ?>','textCancel':'<?php _e('Switch off', Config::domain); ?>'}, function(r){
				if(r) { 
					jQuery('#hiddens').append('<input type="hidden" name="youtubeaccname" value="' + r + '" />');
					jQuery('#youtube').attr({checked: true}).parents('li').addClass('selected');
					hbyoutube = jQuery('input[name="youtubeaccname"]').val();
				}
				else {
					jQuery('#youtube').attr({checked: false}).parents('li').removeClass('selected');
				}
			});
		}
		else if (jQuery(this).attr('id') == 'flickr' && jQuery(this).attr({checked: false})) {
			apprise(flickrinputmsg + ':', {'input':flickrinput,'animate':true, 'textOk':'<?php _e('Corrert', Config::domain); ?>','textCancel':'<?php _e('Switch off', Config::domain); ?>'}, function(r){
				if(r) { 
					jQuery('#hiddens').append('<input type="hidden" name="flickraccname" value="' + r + '" />');
					jQuery('#flickr').attr({checked: true}).parents('li').addClass('selected');
					hbflickr = jQuery('input[name="flickraccname"]').val();
				}
				else jQuery('#flickr').attr({checked: false}).parents('li').removeClass('selected');
			});
		}
		else {
			jQuery(this).parents('li').toggleClass('selected');
		}
		
		jQuery('#error').clearQueue().fadeOut(250, function() { jQuery(this).remove(); });
	})

	jQuery('#size li').click(function() {
		size = jQuery(this).attr('id').replace('s', '');
		jQuery('#icons, #size li').removeClass();
		jQuery(this).addClass('current');

		<?php $services = SocializeIt::get_admin_services_info(); ?>
		
		jQuery('#icons li div').each(function() {
			
			var bgpos = '0 0';
			
			<?php foreach ($services as $key=>$val) : ?>
			if (jQuery(this).attr('id') == '<?php echo $key; ?>') {
				if (size == 32) bgpos = '<?php echo $val['32']; ?>';
				if (size == 24) bgpos = '<?php echo $val['24']; ?>';
				if (size == 16) bgpos = '<?php echo $val['16']; ?>';
			}
			<?php endforeach; ?>
			
			jQuery(this).css ( { 
				width:size, 
				height:size,
				"background-image":'url(' + imgpath + 'icons-' + size + '.png)',
				"background-position":bgpos,
			});

		})

	})

	jQuery('#option-floating').click(function() {
		jQuery('#panel-float-li').attr({style: 'dysplay:block;visibility:visible;'});
		jQuery('#panel-mtop').attr({style: 'dysplay:block;visibility:visible;'});
		jQuery('#panel-mside').attr({style: 'dysplay:block;visibility:visible;'});
	})
	
	jQuery('#option-horizontal').click(function() {
		jQuery('#panel-float-li').toggle();
		jQuery('#panel-mtop').toggle();
		jQuery('#panel-mside').toggle();
	})

	jQuery('span.tooltip').each(function() {
		var title = jQuery(this).attr('title');
		jQuery(this).attr('title', '').append('<div>' + title + '</div>');
		var width = jQuery(this).find('div').width();
		var height = jQuery(this).find('div').height();
		jQuery(this).hover(
			function() {
				jQuery(this).find('div')
					.clearQueue()
					.animate({width: width + 20, height: height + 20}, 200).show(200)
					.animate({width: width, height: height}, 200);
			},
			function() {
				jQuery(this).find('div')
					.animate({width: width + 20, height: height + 20}, 150)
					.animate({width: 'hide', height: 'hide'}, 150);
			}
		)
	})
	
	function error() {
		jQuery('#error').remove();
		jQuery('#hbsocializesubmit').before('<div id="error"><?php _e('You must select at least one icon', Config::domain); ?>!</div>');
		jQuery('#error').hide().fadeIn().delay(5000).fadeOut(750, function() { jQuery(this).remove(); });
	}
	
	function msg(settingsmsg) {
		jQuery('#respond').remove();
		jQuery('#hbsocializesubmit').before('<div id="respond">' + settingsmsg + '</div>');
		jQuery('#respond').hide().fadeIn().delay(2000).fadeOut(750, function() { jQuery(this).remove(); window.location='<?php echo $_SERVER['PHP_SELF'].'?page='.HB_PLUGIN_DIR; ?>' });
	}

	jQuery('#hbsocializesubmit').click(function() {
		if (jQuery('#icons input:checked').length < 1) {
			error();
			return false;
		} else {
			jQuery('input[name="size"]').val(size);
			var settingsmsg = '';
			var hblogo = 'yes';
			if (jQuery('input[name="hblogo"]:checked').val()) hblogo = 'yes';
			else hblogo = 'no';

			var data = {
				action: 'submithb',
				size: size,
				hbicons: jQuery('input[name="icons"]:checked').serialize(),
				panel: jQuery('input[name="panel"]:checked').serialize(),
				panelfloat: jQuery('select[name="panelfloat"] option:selected').val(),
				hbmtop: jQuery('input[name="mtop"]').val(),
				hbmside: jQuery('input[name="mside"]').val(),
				hblogo: hblogo,
				hbyoutube: hbyoutube,
				hbflickr: hbflickr,
				hbinviterusername: jQuery('input[name="inviterusername"]').val(),
				hbinviterformid: jQuery('input[name="inviterformid"]').val(),
				hb_admin_wpnonce: jQuery('input[name="hb_admin_wpnonce"]').val(),
			};

			jQuery.post(ajaxurl, data, function(response) {
				if (response == 1) {
					settingsmsg = "<?php _e('Your settings saved successfully', Config::domain); ?>!";
				}
				else {
					settingsmsg = "<?php _e('Settings failed - try later, please', Config::domain); ?> :(";
				}
				msg(settingsmsg);
			});

			return false;
		}
	})

});

</script>
<div class="hb_container visible">
<form action="" method="post" id="hbform" name="hbform">

	<h3><?php _e('Choose the size and icons which you would like to use at your blog', Config::domain); ?>:</h3>

	<div id="icons">

		<div id="count"><?php _e('Icons total', Config::domain); ?>: <span><?php echo count($services); ?></span></div>

		<ul id="size">
			<li id="s32"<?php if ($mysize == 32 || !$mysize) echo ' class="current"'; ?>>32x32</li>
			<li id="s24"<?php if ($mysize == 24) echo ' class="current"'; ?>>24x24</li>
			<li id="s16"<?php if ($mysize == 16) echo ' class="current"'; ?>>16x16</li>
		</ul>

		<span id="all"><?php _e('Select/unselect all', Config::domain); ?></span> <span id="invert"><?php _e('Invert selection', Config::domain); ?></span>

		<span class="tooltip" style="font-weight:bold;" title="<?php _e('You can change the order of the icons just dragging them with mouse', Config::domain); ?>.">!</span>

		<ol id="dynamic">
				
			<?php foreach ($services as $key=>$val) : ?>
			<li<?php if (is_array($myicons)) { foreach ($myicons as $icn) : if ($icn == $key) echo ' class="selected"'; endforeach; } ?>><label for="<?php echo $key;?>"><input type="checkbox" name="icons" value="<?php echo $key;?>" id="<?php echo $key;?>" <?php if (is_array($myicons)) { foreach ($myicons as $icn) : if ($icn == $key) echo 'checked="checked"'; endforeach; } ?> /><div id="<?php echo $key;?>" style="background-image:url(<?php echo HB_IMG_URL; ?>icons-<?php echo $mysize; ?>.png);background-repeat:no-repeat;background-position:<?php echo $val[$mysize];?>;width:<?php echo $mysize; ?>px;height:<?php echo $mysize; ?>px;"></div><?php echo $val['name'];?></label></li>
			<?php endforeach; ?>

		</ol>

		<div id="hiddens"></div>
		
	</div><!-- #icons -->

	<h3><?php _e('Options', Config::domain); ?>:</h3>

		<ul id="options">
			<li><strong><?php _e('Icons bar type', Config::domain); ?>:</strong>
				<label><input id="option-floating" type="radio" name="panel" value="floating"<?php if ($mypanel == 'floating' || !$mypanel) echo ' checked="checked"'; ?> /> <?php _e('floating vertical', Config::domain); ?></label>
				<label><input id="option-horizontal" type="radio" name="panel" value="horizontal"<?php if ($mypanel == 'horizontal') echo ' checked="checked"'; ?> /> <?php _e('horizontal (under a post/page)', Config::domain); ?></label> 
			</li>
			<li id="panel-mtop"<?php if ($mypanel == 'horizontal') echo ' style="display:none;visibility:hidden;"'; ?>><strong><?php _e('Top indent', Config::domain); ?>: <span class="tooltip" title="<?php _e('Indent in pixels from the top of the visible screen area', Config::domain); ?>.">?</span></strong>
				<label><input type="text" name="mtop" style="margin-left:8px;width:75px;" value="<?php if (!$mtop) echo 0; else echo $mtop; ?>" /> px</label>
			</li>
			<li id="panel-float-li"<?php if ($mypanel == 'horizontal') echo ' style="display:none;visibility:hidden;"'; ?>><strong><?php _e('Alignment', Config::domain); ?>: <span class="tooltip" title="<?php _e('Icons bar location about the page template', Config::domain); ?>.">?</span></strong>
				<label><select id="panelfloat" name="panelfloat" style="margin-left:8px;width:75px;"><option value="left"<?php if (!$panelfloat || $panelfloat == 'left') echo ' selected="selected"'; ?>><?php _e('Left', Config::domain); ?></option><option value="right"<?php if ($panelfloat == 'right') echo ' selected="selected"'; ?>><?php _e('Right', Config::domain); ?></option></select></label>
			</li>
			<li id="panel-mside"<?php if ($mypanel == 'horizontal') echo ' style="display:none;visibility:hidden;"'; ?>><strong><?php _e('Side indent', Config::domain); ?>: <span class="tooltip" title="<?php _e('Indent in pixels from the left side of the post/page template. When aligning the right to pre-defined value is automatically added 900 pixels. Negative values ​​are permitted', Config::domain); ?>.">?</span></strong>
				<label><input type="text" name="mside" style="margin-left:8px;width:75px;" value="<?php if (!$mside) echo 0; else echo $mside; ?>" /> px</label>
			</li>
			<?php $downloadmsg = __('Display the <Download &laquo;Socialize It!&raquo; Plugin> icon', Config::domain); ?>
			<li><label><strong><?php echo $downloadmsg; ?>: <span class="tooltip" title="<?php _e('Would be useful to visitors of your blog who wish install this plugin too. Added after all the icons', Config::domain); ?>.">?</span></strong><input type="checkbox" id="hblogo" name="hblogo"<?php if ($hblogo == 'yes' || !$hblogo) echo ' checked="checked"'; ?> value="yes" style="margin-left:13px;" /></label></li>
		</ul>

	<h3><?php _e('PowerInviter', Config::domain); ?>:</h3>
	<p style="font-weight:bold;color:#7071be;font-size:11pt">
	<?php _e('Do you want effortlessly boost the number of visitors, subscribers, affiliates, and sales?!', Config::domain); ?><br />
	<?php _e('New Social Marketing Tool will increase traffic to your blog', Config::domain); ?>.
	</p>
	<p><?php _e('PowerInviter represents a new generation of "Tell a friend" widgets with many additional "PRO" features and viral marketing principles', Config::domain); ?>.</p>
	<p>
	<?php _e('Without interesting rewards, only a few visitors will feel the urge to tell their friends about your site, so PowerInviter creates motivation: people will get gifts for their recommendations!', Config::domain); ?><br />
	<?php _e('It is precisely this fact that explains the MULTIPLE EFFECTIVENESS of PowerInviter as compared with other "Tell a friend" solutions', Config::domain); ?>.
	</p>
	<p>
	<img src="http://static.<?php echo $invdomain; ?>/images/<?php echo $inviconname; ?>_32x32.gif" align="left" style="margin-right:7px" />
	<?php _e('This button allows people to recommend any page (post) to their friends with the title and short page description (teaser)', Config::domain); ?>.<br />
	<?php _e('The average effectiveness of the recommendations emails is up to <strong>60%</strong>; such a result is impossible using any other kind of advertising', Config::domain); ?>!
	</p>
	<p>
	<?php _e('Your "Tell a friend" message and the bonuses list are being created automatically with every click on the "Recommend it" button', Config::domain); ?>.<br />
	<strong><a href="http://www.<?php echo $invdomain; ?>/form/?url=<?php echo urlencode(site_url()); ?>&title=<?php urlencode('Socialize It!'); ?>&promo=reedycat&engine=blog&sitetitle=<?php urlencode(bloginfo('name')); ?>" target="_blank"><?php _e('Click Here for a Live Demonstration', Config::domain); ?></a></strong>
	</p>
	<p>
	<?php _e('To use the entire features and ability to change the "Tell a friend" message and bonuses list, you need to register at PowerInviter.com', Config::domain); ?>.<br />
	<?php _e('It is completely FREE! Click', Config::domain); ?> <a href="http://www.<?php echo $invdomain; ?>/promo/reedycat" target="_blank"><?php _e('here', Config::domain); ?></a> <?php _e('to open an account', Config::domain); ?>.</p>
	<p>
	<strong><?php _e('After registering and creating a "Tell a friend" form, enter your username (login) and Form ID here', Config::domain); ?>:</strong>
	</p>
	<label><p style="margin:0;"><?php _e('Your PowerInviter Username (login)', Config::domain); ?>:</p><input type="text" name="inviterusername" style="width:175px;color:#145EA6;" value="<?php if ($hbinviterusername) echo $hbinviterusername; ?>" /></label><br />
	<label><p style="margin:10px 0 0 0;"><?php _e('Your PowerInviter Form ID', Config::domain); ?>:</p><input type="text" name="inviterformid" style="width:175px;color:#145EA6;" value="<?php if ($hbinviterformid) echo $hbinviterformid; ?>" /></label>
	<br /><br />
	<h3><a href="#" id="hbsocializesubmit"><?php _e('Save Settings!', Config::domain); ?></a></h3>
	
	<?php wp_nonce_field( 'hb_admin_options', 'hb_admin_wpnonce' ) ?>


</form>
</div>
<!-- .section -->
<div id="hbcopyright"><?php _e('The plugin`s design based on ', Config::domain); ?> <a href="http://share42.com/" target="_blank"><img src="<?php echo HB_IMG_URL; ?>share42_logo.png" alt="share42" style="border:none;padding:7px 0 0 0" /></a> (<?php _e('the service author is', Config::domain); ?> <a href="http://dimox.name/" target="_blank">Dimox</a>).</div>
</div>