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

		WP_ROCKET_PAGE_Spider::crawl_page();

		echo '<p>Finished crawling homepage.</p>';
	}

	$nonce_field = wp_nonce_field( 'spider_crawler_action', 'spider_crawler_nonce' );
	echo '<p><form method="post" action="">
            <input type="submit" name="crawl" value="' . esc_html__( 'Start Crawl', 'rocket' ) . '">'
		. $nonce_field // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		. '</form></p>';
	$links = WP_ROCKET_PAGE_Spider_Db::get_savedlinks();
	if ( ! empty( $links ) ) {
		echo '</br><p>' . esc_html__( 'View Sitemap List', 'rocket' ) . " <a href='../sitemap.html' target='_blank'>" . esc_html__( 'sitemap.html', 'rocket' ) . '</a>';
		echo '</br>' . esc_html__( 'View Sitemap Detailed', 'rocket' ) . " <a href='../sitemap.html' target='_blank'>" . esc_html__( 'sitemap.html', 'rocket' ) . '</a></p>';
		echo '<p>' . esc_html__( 'Last Home page content snapshot. View', 'rocket' ) . " <a href='../homepage.html' target='_blank'>" . esc_html__( 'homepage.html', 'rocket' ) . '</a></p>';
		echo '<h3>' . count( $links ) . esc_html__( ' Found Results', 'rocket' ) . ':</h3>';
		echo '</ul>';
		echo '<table style="border-collapse: collapse;width: 100%;">';
		echo '<tr style="padding: 8px;
		text-align: left;
		border-bottom: 1px solid #ddd;"><th >Link</th><th>Modification Date</th></tr>';
		foreach ( $links as $link ) {
			echo '<tr style="padding: 8px;
			text-align: left;
			border-bottom: 1px solid #ddd;">';
			echo '<td>' . esc_html( $link->link ) . '</td>';
			echo '<td>';
				echo esc_html( $link->created_at ) . '</br>';
			echo '</td>';
			echo '</tr>';
		}
		echo '</table>';
	}
}
