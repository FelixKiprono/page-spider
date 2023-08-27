<?php
defined( 'ABSPATH' ) || exit;

/**
 * Crawl every hour.
 *
 * @return void
 */
function wp_rocket_crawl_every_hour() {
	if ( ! wp_next_scheduled( 'crawl_hourly_event' ) ) {
		wp_schedule_event( time(), 'hourly', 'crawl_hourly_event' );
	}
	add_action( 'crawl_hourly_event', [ 'WP_ROCKET_Crawler_Manager', 'crawl_page' ] );
}

