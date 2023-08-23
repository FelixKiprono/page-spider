<?php
defined( 'ABSPATH' ) || exit;
define( 'FS_METHOD', 'direct' );

/**
 * Create_table
 *
 * @return void
 */
function wp_rocket_page_spider_create_sitemap() {
}


/**
 * Wp_rocket_page_spider_create_homepage
 *
 * @param  mixed $content html content.
 * @return void
 */
function wp_rocket_page_spider_create_homepage( $content ) {

	global $wp_filesystem;

	if ( empty( $wp_filesystem ) ) {
		require_once ABSPATH . '/wp-admin/includes/file.php';
		WP_Filesystem();
	}
	$file_path = ABSPATH . 'homepage.html';
	$wp_filesystem->put_contents( $file_path, $content, 0644 );

}
