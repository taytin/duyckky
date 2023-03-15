<?php // Simple Ajax Chat > Process Chats

define('WP_USE_THEMES', false);

require(dirname(dirname(dirname(dirname(__FILE__)))) .'/wp-load.php');

if (!defined('ABSPATH')) exit;

$sac_die = esc_html__('Please do not load this page directly. Thanks!', 'simple-ajax-chat');

if (isset($_COOKIE['PHPSESSID']) && $_COOKIE['PHPSESSID'] !== session_id()) {
	
	session_unset();
	wp_die($sac_die);
	
}

if (function_exists('sac_default_options')) $sac_options = get_option('sac_options', sac_default_options());

$sac_registered_only = isset($sac_options['sac_registered_only']) ? $sac_options['sac_registered_only'] : false;

if (!current_user_can('read') && $sac_registered_only) {
	
	wp_die($sac_die);
	
}

$sac_host    = isset($_SERVER['HTTP_HOST'])    ? sanitize_text_field($_SERVER['HTTP_HOST'])    : '';
$sac_request = isset($_SERVER['REQUEST_URI'])  ? sanitize_text_field($_SERVER['REQUEST_URI'])  : '';
$sac_referer = isset($_SERVER['HTTP_REFERER']) ? sanitize_text_field($_SERVER['HTTP_REFERER']) : '';
$sac_address = isset($_SERVER['REMOTE_ADDR'])  ? sanitize_text_field($_SERVER['REMOTE_ADDR'])  : '';

$sac_name = isset($_POST['sac_name']) ? sanitize_text_field($_POST['sac_name']) : false;
$sac_chat = isset($_POST['sac_chat']) ? sanitize_text_field($_POST['sac_chat']) : false;
$sac_url  = isset($_POST['sac_url'])  ? sanitize_url($_POST['sac_url']) : '';

$use_url = (isset($sac_options['sac_use_url']) && !empty($sac_options['sac_use_url'])) ? true : false;

if (empty($use_url) && !empty($sac_url)) wp_die($sac_die);

//

$sac_time = current_time('timestamp') + 60 * 60 * 24 * 30 * 3;

$sac_protocol = is_ssl() ? 'https://' : 'http://';

$sac_chat_url = $sac_protocol . $sac_host . $sac_request;

$sac_nonce = isset($_POST['sac_nonce']) ? $_POST['sac_nonce'] : false;

$sac_verify = isset($_POST['sac_verify']) && empty($_POST['sac_verify']) ? true : false;

$sac_no_js = isset($_POST['sac_no_js']) ? true : false;

$sac_nonces = array(
	'tXyV48eupK[g,8u[M_mI]p]A',
	'uy73B:G%~rJ%a?sVBxB+ci~~',
	'?vpK=%+SqCaN$/q3WFY//Tae',
	'{RYS;Y]WErcnxk@}ShN{sH0v',
	'bz/MjPvzw,Yo3}Rfyp[_J_5:',
	'-wgfX][~s|-|4nc;pF9Mt!pi',
	'pCfUnfmS:aCUH/DkGGUd%|*-',
	'4iXNg)6*c;3UHV|NhQYYS/VK',
	'nRWAs6,b8Q29zip0A#qk99fw',
	'2j(z_b1UeZLAuttY-7?nWdju',
);

$sac_js_nonce = isset($_POST['sac_js_nonce']) ? base64_decode($_POST['sac_js_nonce']) : false;

$sac_error_message = esc_html__('WP Plugin SAC: JavaScript not enabled. Please enable JavaScript and try again.', 'simple-ajax-chat');

if ($sacSendChat === 'yes' && !in_array($sac_js_nonce, $sac_nonces)) {
	
	// error_log($sac_error_message, 0);
	
	wp_die($sac_error_message, 200);
	
}

$sac_error_message = esc_html__('WP Plugin SAC: Name and comment required. Please complete all required fields and try again.', 'simple-ajax-chat');



// process chats
if (wp_verify_nonce($sac_nonce, 'sac_nonce')) {
	
	if ($sac_no_js && $sac_verify) {
		
		if ($sac_name && $sac_chat) {
			
			$sac_name = apply_filters('sac_process_chat_name', $sac_name);
			$sac_chat = apply_filters('sac_process_chat_text', $sac_chat);
			$sac_url  = apply_filters('sac_process_chat_url',  $sac_url);
			
			$simple_ajax_chat_domain = sanitize_text_field($_SERVER['HTTP_HOST']);
			
			do_action('sac_process_chat', $sac_name, $sac_chat, $sac_url);
			
			sac_addData($sac_name, $sac_chat, $sac_url);
			sac_deleteOld();
			
			setcookie('sacUserName', $sac_name, $sac_time, '/', $simple_ajax_chat_domain, false, true);
			setcookie('sacUrl',      $sac_url,  $sac_time, '/', $simple_ajax_chat_domain, false, true);
				
		} else {
			
			wp_die($sac_error_message, 200);
			
		}
		
	} else {
		
		if (!empty($sac_user_name) && !empty($sac_user_text) && $sacSendChat === 'yes') {
			
			$sac_user_name = apply_filters('sac_process_chat_name', $sac_user_name);
			$sac_user_text = apply_filters('sac_process_chat_text', $sac_user_text);
			$sac_user_url  = apply_filters('sac_process_chat_url',  $sac_user_url);
			
			do_action('sac_process_chat', $sac_user_name, $sac_user_text, $sac_user_url);
			
			sac_addData($sac_user_name, $sac_user_text, $sac_user_url);
			sac_deleteOld();
			
		} else {
			
			wp_die($sac_error_message, 200);
			
		}
		
	}
	
}

exit();