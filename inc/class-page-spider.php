<?php
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DomCrawler\Crawler;
use GuzzleHttp\Client;


class WP_ROCKET_PAGE_Spider {

	/**
	 * Crawl
	 *
	 * @return void
	 */
	public static function crawl() {

		$client   = new \GuzzleHttp\Client();
		$response = $client->get( home_url() );
		$html     = (string) $response->getBody();

		wp_rocket_page_spider_create_homepage( $html );

		$crawler = new Crawler( $html );
		$links   = $crawler->filter( 'a' );

		WP_ROCKET_PAGE_Spider_Db::add_result( home_url(), $links );

		foreach ( $links as $link ) {
			$saved_link = $link->getAttribute( 'href' );
		}
	}

}
