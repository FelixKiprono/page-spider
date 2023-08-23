<?php
/**
 * Plugin Name: Page Spider
 * Plugin URI: https://spider.com
 * Description: The a simple WordPress crawler plugin.
 * Version: 0.0.1
 * Requires at least: 5.8
 * Requires PHP: 7.3
 * Code Name: Toulouse
 * Author: Felix Kiprono
 * Author URI: https://felixkiprono.me
 * Licence: GPLv2 or later
 *
 * Text Domain: wp_rocket
 * Domain Path: languages
 *
 * Copyright 2023 Spider
 */

defined( 'ABSPATH' ) || exit;

define( 'WP_ROCKET_PAGE_SPIDER_PATH', plugin_dir_path( __FILE__ ) );
define( 'WP_ROCKET_PAGE_SPIDER_URL', plugin_dir_url( __FILE__ ) );


require_once WP_ROCKET_PAGE_SPIDER_PATH . 'admin/admin.php';
require_once WP_ROCKET_PAGE_SPIDER_PATH . 'inc/class-page-spider-db.php';
require_once WP_ROCKET_PAGE_SPIDER_PATH . 'inc/class-page-spider.php';
require_once WP_ROCKET_PAGE_SPIDER_PATH . 'inc/functions/file.php';

require_once __DIR__ . '/vendor/autoload.php';

register_activation_hook( __FILE__, [ 'WP_ROCKET_PAGE_Spider_Db', 'build_table' ] );

