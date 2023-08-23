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
			crawled_url VARCHAR(255) NOT NULL,
			hyperlinks VARCHAR(255) NOT NULL,
			created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
			metadata VARCHAR(255) NULL
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

		$all_hyper_links = [];
		foreach ( $result as $link ) {
			$all_hyper_links[] = $link->getAttribute( 'href' );
		}
		global $wpdb;
		$table_name = $wpdb->prefix . 'page_spider';
		$wpdb->insert(
			$table_name,
			[
				'crawled_url' => $url,
				'hyperlinks'  => wp_json_encode( $all_hyper_links ),
				'metadata'    => ' ',
			]
		); // db call ok.
	}

	/**
	 * Get_savedlinks
	 *
	 * @return array|object|stdClass[]|null
	 */
	public static function get_savedlinks() {
		global $wpdb;
		$table_name = $wpdb->prefix . 'page_spider';

		return $wpdb->get_results( $wpdb->prepare( 'SELECT * FROM %s', $table_name ) ); // db call ok; no-cache ok.
	}

	/**
	 * Delete_all_savedlinks
	 *
	 * @return void
	 */
	public static function delete_all_savedlinks() {
		global $wpdb;
		$table_name = $wpdb->prefix . 'page_spider';
		$wpdb->query( $wpdb->prepare( 'DELETE FROM %s WHERE id>%d', $table_nam, 1 ) ); // db call ok; no-cache ok.
	}



}
