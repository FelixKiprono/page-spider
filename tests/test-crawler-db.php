<?php

/**
 * Class TestCrawerlDb
 *
 * @package Wp_Rocker_Crawler
 */

/**
 * Test Crawl database operations.
 */
class TestCrawerlDb extends WP_UnitTestCase {

	function setUp() {
        parent::setUp();
		WP_ROCKET_Crawler_Db::build_table();
    }

    function tearDown() {
        parent::tearDown();
    }

	/**
	 * test_add_result.
	 */
	public function test_add_result() {
		$found_hyperlinks = ['https://wp-media.com'];
		WP_ROCKET_Crawler_Db::add_result($found_hyperlinks);
		$results = WP_ROCKET_Crawler_Db::get_saved_links();
		$this->assertCount(1,$results);
		$this->assertEquals("https://wp-media.com", $results[0]->link);
	}
	/**
	 * test_get_saved_links
	 *
	 * @return void
	 */
	public function test_get_saved_links() {
		WP_ROCKET_Crawler_Db::add_result(['https://wp-media.com']);
		$result = WP_ROCKET_Crawler_Db::get_saved_links();
		$this->assertCount(1,$result);
		$this->assertTrue((count($result)>0) );
	}
	/**
	 * test_delete_last_saved_links
	 *
	 * @return void
	 */
	public function test_delete_last_saved_links() {
		WP_ROCKET_Crawler_Db::delete_last_saved_links();
		$result = WP_ROCKET_Crawler_Db::get_saved_links();
		$this->assertEmpty($result);
	}
}
