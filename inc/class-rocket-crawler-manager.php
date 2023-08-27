<?php
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DomCrawler\Crawler;
use GuzzleHttp\Client;


class WP_ROCKET_Crawler_Manager {


	/**
	 * Crawl page nb: for now we are only crawling homepage.
	 *
	 * @return void
	 */
	public static function crawl_page() {
		$homepage_url = home_url();
		try {
			$client   = new \GuzzleHttp\Client();
			$response = $client->get( $homepage_url );
			$html     = (string) $response->getBody();

			wp_rocket_page_spider_create_homepage( $html );

			$crawler       = new Crawler( $html );
			$links         = $crawler->filter( 'a' );
			$crawled_links = [];
			foreach ( $links as $link ) {
				if ( filter_var( $link->getAttribute( 'href' ), FILTER_VALIDATE_URL ) ) {
					$crawled_links[] = $link->getAttribute( 'href' );
				}
			}
			WP_ROCKET_Crawler_Db::add_result( $crawled_links );
			wp_rocket_page_spider_create_sitemap( $crawled_links );
		} catch ( Exception $e ) {
			echo esc_html( '<p>Failed to crawl : ' . $homepage_url . $e->getMessage() . '</p>' );
		}
	}

}
