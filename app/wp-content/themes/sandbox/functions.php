<?php
/**
 * sandbox functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package sandbox
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

function sandbox_setup() {
	load_theme_textdomain( 'sandbox', get_template_directory() . '/languages' );


	add_theme_support( 'title-tag' );

	add_theme_support( 'post-thumbnails' );

}
add_action( 'after_setup_theme', 'sandbox_setup' );


function sandbox_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'sandbox_content_width', 640 );
}
add_action( 'after_setup_theme', 'sandbox_content_width', 0 );



function sandbox_scripts() {
	wp_enqueue_style( 'sandbox-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'sandbox-style', 'rtl', 'replace' );

}
add_action( 'wp_enqueue_scripts', 'sandbox_scripts' );

remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10);
remove_action('wp_head', 'parent_post_rel_link', 10);
remove_action('wp_head', 'adjacent_posts_rel_link', 10);
remove_action('wp_head', 'wp_shortlink_wp_head', 10);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );

add_filter( 'show_admin_bar', '__return_false' );

add_action('admin_menu', 'remove_comment_admin');
function remove_comment_admin()
{
    remove_menu_page('edit-comments.php');
}

function showJson($data)
{
    header("Content-type: application/json");
    $json = json_encode($data, JSON_PRETTY_PRINT);
    if ($json) {
        die($json);
    } else {
        die('error in json encoding');
    }
}

function cleanInput($data)
{
    $data = trim($data);
    $data = strip_tags($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

function wpc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'wpc_mime_types');

// Package Meta
include get_template_directory() . "/inc/package_meta/page-meta.php";
include get_template_directory() . "/inc/package_meta/ajaxMeta.php";
include get_template_directory() . "/inc/package_meta/ajaxPost.php";
include get_template_directory() . "/inc/customCms.php";



