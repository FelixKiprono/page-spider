<?php

/**
 * WP_ROCKET_Crawler_Db class file
 * This class deals with database operations.
 */
class WP_ROCKET_Crawler_Db {

	/**
	 * Build table for our links results.
	 *
	 * @return void
	 */
	public static function build_table() {
		global $wpdb;

		$charset_collate = $wpdb->get_charset_collate();
		$table_name      = $wpdb->prefix . 'page_spider';

		$sql = "CREATE TABLE $table_name (
			id INT NOT NULL AUTO_INCREMENT,
			PRIMARY KEY (id),
			link VARCHAR(255) NOT NULL,
			created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP()
		) $charset_collate;";

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta( $sql );
	}

	/**
	 * Add result
	 *
	 * @param  mixed $hyperlinks found hyperlinks.
	 * @return void
	 */
	public static function add_result( $hyperlinks ) {

		self::delete_last_saved_links();
		global $wpdb;
		$all_hyper_links = [];
		$table_name      = $wpdb->prefix . 'page_spider';
		if ( is_array( $hyperlinks ) ) {

			foreach ( $hyperlinks as $hyperlink ) {
				$wpdb->insert(
					$table_name,
					[
						'link' => $hyperlink,
					]
				); // db call ok.
			}
		} else {
			$wpdb->insert(
				$table_name,
				[
					'link' => $hyperlinks,
				]
			); // db call ok.
		}
	}

	//@codingStandardsIgnoreStart
	/**
	 * Get saved links/results
	 *
	 * @return array|object|stdClass[]|null
	 */
	public static function get_saved_links() {
		global $wpdb;
		$table_name = $wpdb->prefix . 'page_spider';
		return $wpdb->get_results( "SELECT * FROM $table_name " ); // db call ok; no-cache ok.
	}

	/**
	 * Delete all savedlinks
	 *
	 * @return void
	 */
	public static function delete_last_saved_links() {
		global $wpdb;
		$table_name = $wpdb->prefix . 'page_spider';
		$wpdb->query( "DELETE FROM $table_name WHERE 1" ); // db call ok; no-cache ok.
	}
	//@codingStandardsIgnoreEnd

}
