<?php
/**
 * Class TestPageSpider
 *
 * @package Wp_Rocker_Crawler
 */

/**
 * Test Crawl Manager operation case.s
 */
class TestCrawlerManager extends WP_UnitTestCase {

	function setUp() {
        parent::setUp();
		WP_ROCKET_Crawler_Db::build_table();
    }

    function tearDown() {
        parent::tearDown();
    }

	/**
	 * test_crawl_page.
	 */
	public function test_crawl_page() {

		WP_ROCKET_Crawler_Manager::crawl_page();
		$crawled_links = WP_ROCKET_Crawler_Db::get_saved_links();
		$this->assertTrue((count($crawled_links)>0) );
	}
}
