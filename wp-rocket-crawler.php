<?php
/**
 * Plugin Name: WP Rocket Crawler
 * Plugin URI:
 * Description: The a simple WordPress crawler plugin.
 * Version: 0.0.1
 * Requires at least: 5.8
 * Requires PHP: 7.3
 * Code Name: Toulouse
 * Author: Felix Kiprono
 * Author URI:
 * Licence: GPLv2 or later
 *
 * Text Domain: wp_rocket_crawler
 * Domain Path: languages
 *
 * Copyright 2023 WP Media
 */

defined( 'ABSPATH' ) || exit;
define( 'FS_METHOD', 'direct' ); // @phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedConstantFound -- Valid use case as we need it defined.

define( 'WP_ROCKET_CRAWLER_VERSION', '0.0.1' );
define( 'WP_ROCKET_CRAWLER_PATH', plugin_dir_path( __FILE__ ) );
define( 'WP_ROCKET_CRAWLER_URL', plugin_dir_url( __FILE__ ) );

require_once WP_ROCKET_CRAWLER_PATH . 'admin/admin.php';
require_once WP_ROCKET_CRAWLER_PATH . 'inc/class-rocket-crawler-db.php';
require_once WP_ROCKET_CRAWLER_PATH . 'inc/class-rocket-crawler-manager.php';
require_once WP_ROCKET_CRAWLER_PATH . 'inc/functions/file.php';
require_once WP_ROCKET_CRAWLER_PATH . 'inc/functions/cron.php';

require_once __DIR__ . '/vendor/autoload.php';

register_activation_hook( __FILE__, [ 'WP_ROCKET_Crawler_Db', 'build_table' ] );


if ( ! wp_next_scheduled( 'crawl_hourly_event' ) ) {
	wp_schedule_event( time(), 'hourly', 'crawl_hourly_event' );
}

add_action( 'crawl_hourly_event', [ 'WP_ROCKET_Crawler_Manager', 'crawl_page' ] );
