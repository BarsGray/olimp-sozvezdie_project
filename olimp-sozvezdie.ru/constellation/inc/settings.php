<?php
	
	define('MAIN_PAGE',get_option('page_on_front'));
	define('VERSION',wp_get_theme(basename(dirname(__DIR__)))->get('Version'));
	define('THEME',get_bloginfo('template_directory'));
	define('IMG_LOGO',THEME.'/img/logo.png');
	define('IMG_LOGO_WHITE',THEME.'/img/logo_white.png');
	define('NO_IMG_NEWS',THEME.'/img/NO_IMG_NEWS.jpg');
	define('NO_IMG_300x300',THEME.'/img/NO_IMG_300x300.jpg');
	define('NO_IMG_CLINIC',THEME.'/img/NO_IMG_CLINIC.jpg');
	define('NO_IMG_SALE',THEME.'/img/NO_IMG_SALE.jpg');
	define('NO_IMG_VIDEO',THEME.'/img/NO_IMG_VIDEO.jpg');

	register_nav_menus();
	add_theme_support('post-thumbnails');
	add_theme_support('html5',array('style','script'));
	
	add_image_size('img_clinic',600,360,true);
	add_image_size('img_gallery_fix',370,270,true);
	add_image_size('img_gallery_fix_vertical',370,523,true);
	
	add_filter('wp_revisions_to_keep',function($num,$post){
		return $num=10;
	},10,2);
	add_filter('xmlrpc_enabled','__return_false');
	add_filter('wpcf7_autop_or_not','__return_false');
	add_filter('aioseop_prev_link','__return_empty_string');
	add_filter('aioseop_next_link','__return_empty_string');
	add_filter('wp_img_tag_add_auto_sizes','__return_false');
	
	remove_filter('the_content_feed','wp_staticize_emoji');
	remove_filter('comment_text_rss','wp_staticize_emoji'); 
	remove_filter('wp_mail','wp_staticize_emoji_for_email');
	remove_filter('render_block','wp_render_duotone_support',10);
	
	remove_action('wp_head','feed_links',2);
	remove_action('wp_head','feed_links_extra',3);
	remove_action('wp_head','rsd_link');
	remove_action('wp_head','wlwmanifest_link');
	remove_action('wp_head','wp_generator'); 
	remove_action('wp_head','wp_shortlink_wp_head',10,0);
	remove_action('wp_head','adjacent_posts_rel_link_wp_head',10,0);
	remove_action('wp_head','wp_resource_hints',2);
	remove_action('wp_head','print_emoji_detection_script',7);
	remove_action('wp_head','wp_oembed_add_discovery_links');
	remove_action('wp_head','rest_output_link_wp_head');
	remove_action('admin_print_scripts','print_emoji_detection_script');
	remove_action('wp_print_styles','print_emoji_styles');
	remove_action('admin_print_styles','print_emoji_styles');
	
?>