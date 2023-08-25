<?php

class WP_ROCKET_PAGE_Spider_Db {

	/**
	 * Build_table
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
	 * Add_result
	 *
	 * @param  mixed $url crawled link.
	 * @param  mixed $result found hyperlinks.
	 * @return void
	 */
	public static function add_result( $url, $result ) {

		self::delete_all_savedlinks();
		global $wpdb;
		$all_hyper_links = [];
		$table_name      = $wpdb->prefix . 'page_spider';
		foreach ( $result as $link ) {

			$wpdb->insert(
				$table_name,
				[
					'link' => $link,
				]
			); // db call ok.
		}
	}

	//@codingStandardsIgnoreStart
	/**
	 * Get_savedlinks
	 *
	 * @return array|object|stdClass[]|null
	 */
	public static function get_savedlinks() {
		global $wpdb;
		$table_name = $wpdb->prefix . 'page_spider';
		return $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name ",  ) ); // db call ok; no-cache ok.
	}

	/**
	 * Delete_all_savedlinks
	 *
	 * @return void
	 */
	public static function delete_all_savedlinks() {
		global $wpdb;
		$table_name = $wpdb->prefix . 'page_spider';
		$wpdb->query( "DELETE FROM $table_name WHERE 1" ); // db call ok; no-cache ok.
	}
	//@codingStandardsIgnoreEnd

}
