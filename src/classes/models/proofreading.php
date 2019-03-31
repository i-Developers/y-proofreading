<?php /** @noinspection PhpUndefinedFieldInspection */

/**
 * @version 0.0.1
 * @author Technote
 * @since 0.0.1
 * @copyright Technote All Rights Reserved
 * @license http://www.opensource.org/licenses/gpl-2.0.php GNU General Public License, version 2
 * @link https://technote.space/
 */

namespace Y_Proofreading\Classes\Models;

if ( ! defined( 'Y_PROOFREADING' ) ) {
	exit;
}

/**
 * Class Proofreading
 * @package Y_Proofreading\Classes\Models
 */
class Proofreading implements \WP_Framework_Core\Interfaces\Singleton, \WP_Framework_Core\Interfaces\Hook, \WP_Framework_Presenter\Interfaces\Presenter {

	use \WP_Framework_Core\Traits\Singleton, \WP_Framework_Core\Traits\Hook, \WP_Framework_Presenter\Traits\Presenter, \WP_Framework_Common\Traits\Package;

	/**
	 * @return bool
	 */
	public function is_valid() {
		return ! empty( $this->apply_filters( 'yahoo_client_id' ) );
	}

	/**
	 * @param string $content
	 *
	 * @return array
	 */
	public function get_result( $content ) {
		try {
			if ( ! $this->is_valid() ) {
				throw new \Exception( $this->translate( 'Not available' ) );
			}

			$sentence  = $this->get_sentence( $content );
			$url       = $this->app->get_config( 'yahoo', 'request_url' );
			$client_id = $this->apply_filters( 'yahoo_client_id' );
			$params    = [
				'sentence' => $this->get_sentence( $sentence ),
			];

			$ch = curl_init( $url );
			curl_setopt_array( $ch, [
				CURLOPT_POST           => true,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_USERAGENT      => "Yahoo AppID: {$client_id}",
				CURLOPT_POSTFIELDS     => http_build_query( $params ),
			] );
			$results = curl_exec( $ch );
			$errno   = curl_errno( $ch );
			$error   = curl_error( $ch );
			curl_close( $ch );

			if ( CURLE_OK !== $errno ) {
				throw new \RuntimeException( $error, $errno );
			}
			if ( false === $results ) {
				throw new \Exception( $this->translate( 'Invalid API Response.' ) );
			}

			$results = new \SimpleXMLElement( $results );
			if ( $results->Message ) {
				throw new \Exception( (string) $results->Message );
			}

			return $this->parse_result( $sentence, $results );
		} catch ( \Exception $e ) {
			return [
				'result'  => false,
				'message' => $e->getMessage(),
			];
		}
	}

	/**
	 * @param string $content
	 *
	 * @return string
	 */
	private function get_sentence( $content ) {
		foreach ( $this->apply_filters( 'remove_tags', [ 'pre', 'code', 'blockquote' ] ) as $target ) {
			$content = preg_replace( '#<' . $target . '[\s>].*?</' . $target . '>#is', "\n", $content );
		}
		$content = wp_strip_all_tags( $content );
		$content = strip_shortcodes( $content );
		$content = htmlspecialchars( $content );
		$content = str_replace( '&amp;nbsp;', '', $content );
		$content = preg_replace( '/&(([a-zA-Z]{2,}[a-zA-Z0-9]*)|(#[0-9]{2,4})|(#x[a-fA-F0-9]{2,4}))?;/', '', $content );
		$content = html_entity_decode( $content );
		$content = normalize_whitespace( $content );
		$content = stripslashes( $content );

		return $content;
	}

	/**
	 * @param string $sentence
	 * @param \SimpleXMLElement $results
	 *
	 * @return array
	 */
	private function parse_result( $sentence, $results ) {
		$items   = [];
		$hash    = [];
		$result  = [];
		$filters = $this->app->get_config( 'yahoo', 'filter' );
		foreach ( $results->Result as $value ) {
			$start = (int) $value->StartPos;
			$len   = (int) $value->Length;
			if ( '' === (string) $value->Surface ) {
				$surface = mb_substr( $sentence, $start, $len );
			} else {
				$surface = (string) $value->Surface;
			}
			$r = [
				'start'   => $start,
				'end'     => $start + $len,
				'surface' => $surface,
				'word'    => (string) $value->ShitekiWord,
				'info'    => (string) $value->ShitekiInfo,
				'index'   => $this->app->array->get( $filters, (string) $value->ShitekiInfo . '.index', 0 ),
			];
			$h = $r['surface'] . '-' . $r['word'] . '-' . $r['info'];
			if ( ! in_array( $h, $hash ) ) {
				$hash[]  = $h;
				$items[] = [ 'surface' => $r['surface'], 'word' => $r['word'], 'info' => $r['info'] ];
			}
			$r['item_index'] = array_search( $h, $hash );
			$result[]        = $r;
		}
		$result = array_reverse( $result );

		$html  = $sentence;
		$index = 0;
		foreach ( $result as $r ) {
			$text = [];
			if ( $r['info'] ) {
				$text [] = '指摘詳細情報: ' . $r['info'];
			}
			if ( $r['word'] ) {
				$text [] = '言い換え候補: ' . $r['word'];
			}
			$html = $this->str_insert( $html, $r['end'], '</span>' );
			$text = esc_attr( implode( '<br>', $text ) );
			$html = $this->str_insert( $html, $r['start'], "<span class='proofreading-item color{$r['index']}' data-text='{$text}' data-index='{$r['item_index']}' data-i='{$index}'>" );
			$index ++;
		}

		$items_html = $this->get_view( 'admin/result', [
			'items' => $items,
		] );

		return [
			'result'   => true,
			'sentence' => $sentence,
			'html'     => nl2br( $html ),
			'items'    => $items_html,
			'message'  => $this->translate( 'Succeeded' ),
		];
	}

	/**
	 * @param string $string
	 * @param int $pos
	 * @param string $insert
	 *
	 * @return string
	 */
	private function str_insert( $string, $pos, $insert ) {
		$str1 = mb_substr( $string, 0, $pos );
		$str2 = mb_substr( $string, $pos );

		return $str1 . $insert . $str2;
	}
}