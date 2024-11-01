<?php
if ( ! defined( 'ABSPATH' ) ) 
	exit;
function xyz_wfp_admin_notice()
{
	add_thickbox();
	$sharelink_text_array_wfp = array
						(
						    "I use WP Filter Posts wordpress plugin from @xyzscripts and you should too.",
						    "WP Filter Posts wordpress plugin from @xyzscripts is awesome",
						    "Thanks @xyzscripts for developing WP Filter Posts, a wonderful post filter wordpress plugin",
						    "I was looking for a post filter plugin and I found WP Filter Posts. Thanks @xyzscripts",
						    "Its very easy to use WP Filter Post wordpress plugin from @xyzscripts",
						    "I installed WP Filter Posts from @xyzscripts,it works flawlessly",
						    "WP Filter Posts wordpress plugin that i use works terrific",
						    "I am using WP Filter Posts wordpress plugin from @xyzscripts and I like it",
						    "The WP Filter Posts plugin from @xyzscripts is simple and works fine",
						    "I've been using this WP Filter Posts plugin for a while now and it is really good",
						    "WP Filter Posts wordpress plugin is a fantastic plugin",
						    "WP Filter Posts wordpress plugin is easy to use and works great. Thank you!",
						    "WP Filter Posts  is a good and flexible  post filter plugin especially for beginners",
						    "WP Filter Posts is the best post filer wordpress plugin I have used ! THANKS @xyzscripts",
						);

	$sharelink_text_wfp = array_rand($sharelink_text_array_wfp, 1);
	$sharelink_text_wfp = $sharelink_text_array_wfp[$sharelink_text_wfp];
	$xyz_wfp_link = admin_url('admin.php?page=xyz-wpf-filter-manage&wpf_blink=en');
	$xyz_wfp_link = wp_nonce_url($xyz_wfp_link,'wfp-blk');
	$xyz_wfp_notice = admin_url('admin.php?page=xyz-wpf-settings&wpf_notice=hide');
	$xyz_wfp_notice = wp_nonce_url($xyz_wfp_notice,'wpf-shw');

	
	echo '<style>
	#TB_window { width:50% !important;  height: 100px !important;
	margin-left: 25% !important; 
	left: 0% !important; 
	}
	</style>
	<script type="text/javascript">
	function xyz_wfp_share(){
	tb_show("Share on","#TB_inline?width=500&amp;height=75&amp;inlineId=show_share_icons_wfp&class=thickbox");
	}
	</script>
	<div id="xyz_wfp_notice_td" class="error" style="color: #666666;margin-left: 2px; padding: 5px;line-height:16px;">
	<p>Thank you for using <a href="https://wordpress.org/plugins/wp-filter-posts/" target="_blank"> WP Filter Posts </a> plugin from <a href="https://xyzscripts.com/" target="_blank">xyzscripts.com</a>. Would you consider supporting us with the continued development of the plugin using any of the below methods?</p>
	<p>
	<a href="https://wordpress.org/support/plugin/wp-filter-posts/reviews/" class="button xyz_rate_btn" target="_blank">Rate it 5★\'s on wordpress</a>';
	
	if(get_option('xyz_credit_link')=="0")
		echo '<a href="'.$xyz_wfp_link.'" class="button xyz_backlink_btn xyz_blink">Enable Backlink</a>';
	
	echo '<a class="button xyz_share_btn" onclick=xyz_wfp_share();>Share on</a>
	
		<a href="https://xyzscripts.com/donate/5" class="button xyz_donate_btn" target="_blank">Donate</a>
		
		
		
	<a href="'.$xyz_wfp_notice.'" class="button xyz_show_btn">Don\'t Show This Again</a>
	</p>
	
	<div id="show_share_icons_wfp" style="display: none;">
	<a class="button" style="background-color:#3b5998;color:white;margin-right:4px;margin-left:100px;margin-top: 25px;" href="https://www.facebook.com/sharer/sharer.php?u=https://wordpress.org/plugins/wp-filter-posts/&text='.$sharelink_text_wfp.'" target="_blank">Facebook</a>
	<a class="button" style="background-color:#00aced;color:white;margin-right:4px;margin-left:70px;margin-top: 25px;" href="https://twitter.com/share?url=https://wordpress.org/plugins/wp-filter-posts/&text='.$sharelink_text_wfp.'" target="_blank">Twitter</a>
	<a class="button" style="background-color:#007bb6;color:white;margin-right:4px;margin-left:70px;margin-top: 25px;" href="https://www.linkedin.com/shareArticle?mini=true&url=https://wordpress.org/plugins/wp-filter-posts/" target="_blank">LinkedIn</a>
	</div>
	</div>';	
	
}

$xyz_wfp_installed_date = get_option('xyz_wpf_installed_date');
if ($xyz_wfp_installed_date=="") {
	$xyz_wfp_installed_date = time();
}

if($xyz_wfp_installed_date < ( time() - (30*24*60*60)))
{
    
	if (get_option('xyz_wfp_dnt_shw_notice') != "hide"){
		add_action('admin_notices', 'xyz_wfp_admin_notice');
	}
}
?>