<?php

/*
=== WP Article Spinner ===

Plugin Name: WP Article Spinner 
Plugin URI: http://www.danielwachtel.com/products/wp-article-spinner/
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=7JN7YZ53YA2A4
Description: Spin your articles with random images & videos, save them, and post to your WordPress blogs in a click of a button! Anchor text spinner included.
Requires at least: 3.4
Tested up to: 3.5
Version: 1.2
Stable tag: 1.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Tags: wp, spin, spinner, article, free, post, xml-rpc, anchor, text, blogs, manage, backlinks
Author: Daniel Wachtel
Author URI: http://www.danielwachtel.com/
Contributors: daniel_wachtel
*/

global $wpdb;

define('WPAS_TABLE',        $wpdb->prefix . 'wpas_table');
define('WPAS_BLOGS_TABLE',        $wpdb->prefix . 'wpas_blogs_table');
define('WPAS_ANCHOR_TABLE',        $wpdb->prefix . 'wpas_anchor_table');

define('WPAS_DOCROOT',    dirname(__FILE__));
define('WPAS_WEBROOT',    str_replace(getcwd(), home_url(), dirname(__FILE__)));

register_activation_hook(__FILE__, 'wp_article_spinner_install');
register_activation_hook(__FILE__, 'wp_article_spinner_blogs_install');
register_activation_hook(__FILE__, 'wp_anchor_text_spinner_install');
register_deactivation_hook(__FILE__, 'wp_article_spinner_uninstall');
register_deactivation_hook(__FILE__, 'wp_article_spinner_blogs_uninstall');
register_deactivation_hook(__FILE__, 'wp_anchor_text_spinner_uninstall');

add_option("wpas_key", rand(), "", "no");

// create plugin menu page
if ( is_admin() ){
    add_action('admin_menu', 'wp_article_spinner_admin_menu');
    add_action('admin_init', 'wp_article_spinner_admin_init');
    wp_enqueue_script("wpas_javascript", plugins_url( 'wp-article-spinner/js/wpas_javascript.js' , dirname(__FILE__) ), array( 'jquery' ) );
    wp_enqueue_style("wpas_stylesheet", plugins_url( 'wp-article-spinner/css/wpas_stylesheet.css' , dirname(__FILE__) ));
}

function wp_article_spinner_admin_init() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-form');
}

function curl_enable_notice(){
    if(!function_exists('curl_init')) {
	echo '<div class="error"><p>It seems that cURL is disabled on your server. Please contact your server administrator to install / enable cURL.</p></div>'; 
    }
}

include 'lib/model.php';
include 'lib/install.php';
include 'lib/controller.php';
include 'lib/helper.php';
?>
