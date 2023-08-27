<?php
defined( 'ABSPATH' ) || exit;
/**
 * Wp_rocket_page_spider_create_sitemap.
 *
 * @param  mixed $urls list of urls.
 * @return void
 */
function wp_rocket_page_spider_create_sitemap( $urls ) {
	global $wp_filesystem;
	if ( empty( $wp_filesystem ) ) {
		require_once ABSPATH . '/wp-admin/includes/file.php';
		WP_Filesystem();
	}

	$sitemap_content = '';
	if ( $urls ) {
		foreach ( $urls as $url ) {
			$sitemap_content .= "<li><a href='{$url}'>{$url}</a></li>";
		}
	}

	$file_path = ABSPATH . 'sitemap.html';
	$wp_filesystem->put_contents( $file_path, $sitemap_content, 0644 );
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
