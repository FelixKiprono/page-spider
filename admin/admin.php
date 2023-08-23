<?php

/**
 * Wp_rocket_page_spider_admin_page
 *
 * @return void
 */
function wp_rocket_page_spider_admin_page() {
	add_options_page( 'Page Spider', 'Page Spider', 'manage_options', 'page-spider', 'wp_rocket_spider_page_content' );
}

add_action( 'admin_menu', 'wp_rocket_page_spider_admin_page' );

/**
 * Wp_rocket_spider_page_content
 *
 * @return void
 */
function wp_rocket_spider_page_content() {
	if ( isset( $_POST['crawl'] ) ) {
		$nonce = isset( $_POST['spider_crawler_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['spider_crawler_nonce'] ) ) : '';
		if ( ! wp_verify_nonce( $nonce, 'spider_crawler_action' ) ) {
			die( 'Nonce verification failed!' );
		}

		WP_ROCKET_PAGE_Spider::crawl();

		echo '<p>Crawling task finished.</p>';
	}

	$nonce_field = wp_nonce_field( 'spider_crawler_action', 'spider_crawler_nonce' );
	echo '<form method="post" action="">
            <input type="submit" name="crawl" value="' . esc_html__( 'Start Crawl', 'rocket' ) . '">'
		. $nonce_field // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		. '</form>';
}
