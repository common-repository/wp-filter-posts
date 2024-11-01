<?php 
if (!defined( 'ABSPATH' ))
     exit;
    
function xyz_wpf_network_install($networkwide){
	global $wpdb;
	
	if (function_exists('is_multisite') && is_multisite()) {
	 
		// check if it is a network activation - if so, run the activation function for each blog id
		if ($networkwide) {
			$old_blog = $wpdb->blogid;
			// Get all blog ids
			$blogids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
			foreach ($blogids as $blog_id) {
				switch_to_blog($blog_id);
				xyz_wpf_install();
			}
			switch_to_blog($old_blog);
			return;
		}
	}
	
	xyz_wpf_install();
}

function xyz_wpf_install(){
	global $wpdb;
	
	if(get_option('xyz_credit_link')==""){
		add_option("xyz_credit_link", '0');
	}

	add_option("xyz_wpf_credit_dismiss", '0');
	add_option('xyz_wpf_page_size', '20');
	
	$queryMapping ="CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."xyz_wp_posts_filter` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`xyz_wpf_name` text COLLATE utf8_unicode_ci NOT NULL,
			`xyz_wpf_categories` text COLLATE utf8_unicode_ci NOT NULL,
			`xyz_wpf_cat_post_from` int(11) NOT NULL COMMENT '0:Any,1:All',
			`xyz_wpf_tags` text COLLATE utf8_unicode_ci NOT NULL,
			`xyz_wpf_tag_post_from` int(11) NOT NULL COMMENT '0:Any,1:All',
			`xyz_wpf_authors` text COLLATE utf8_unicode_ci NOT NULL,
			`xyz_wpf_skip_posts` int(11) NOT NULL,
			`xyz_wpf_no_of_posts` int(11) NOT NULL,
			`xyz_wpf_pagination` int(11) NOT NULL COMMENT '0:Yes,1:No',
			`xyz_wpf_pagination_limit` int(11) NOT NULL,
			`xyz_wpf_sort` int(11) NOT NULL COMMENT '0:Publish Date,1:Update Date',
			`xyz_wpf_order` int(11) NOT NULL COMMENT '0:Asc,1:Desc',
			`xyz_wpf_msg_format` text COLLATE utf8_unicode_ci NOT NULL,
			`xyz_wpf_status` int(11) NOT NULL COMMENT '0:Inactive,1:Active',
			PRIMARY KEY (`id`)
	)  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1" ;
	
	$wpdb->query($queryMapping);
	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_wp_posts_filter");
    
	
	
	if(!in_array("xyz_wpf_fid_en", $tblcolums))
	{

	    
	    $wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_wp_posts_filter ADD `xyz_wpf_fid_en` int(20)  COMMENT '0:No,1:Yes' NOT NULL DEFAULT '0',
								ADD `xyz_wpf_fid` TEXT COLLATE utf8_unicode_ci NOT NULL,
                                ADD `xyz_wpf_exc_id` TEXT COLLATE utf8_unicode_ci NOT NULL,
	                            ADD `xyz_wpf_cat_en` int(20) COMMENT '0:No,1:Yes' NOT NULL   DEFAULT '1',
								ADD `xyz_wpf_tag_en` int(20) COMMENT '0:No,1:Yes' NOT NULL DEFAULT '1',
                                ADD `xyz_wpf_auth_en` int(20) COMMENT '0:No,1:Yes' NOT NULL DEFAULT '1',         
								ADD `xyz_wpf_img_size` varchar(50) NOT NULL default 'thumbnail' ");
	    

	}
	
	


	$currentversion=xyz_wpf_plugin_get_version();
	if($version=="")
	{
		add_option("xyz_wpf_free_version", $currentversion);
	}
	else{
		update_option('xyz_wpf_free_version', $currentversion);
	}

	$xyz_wpf_installed_date = get_option('xyz_wpf_installed_date');
    	if ($xyz_wpf_installed_date==""){
    		$xyz_wpf_installed_date = time();
   			update_option('xyz_wpf_installed_date', $xyz_wpf_installed_date);
    	}
}

register_activation_hook(XYZ_WPF_PLUGIN_FILE,'xyz_wpf_network_install');
?>
