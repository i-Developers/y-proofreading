<?php
/**
 * @version 0.0.7
 * @author Technote
 * @since 0.0.1
 * @copyright Technote All Rights Reserved
 * @license http://www.opensource.org/licenses/gpl-2.0.php GNU General Public License, version 2
 * @link https://technote.space/
 */

if ( ! defined( 'Y_PROOFREADING' ) ) {
	exit;
}

return [

	9   => [
		'Main Setting' => [
			10 => [
				'yahoo_client_id' => [
					'label' => 'Yahoo API Client ID',
				],
				'no_filter'       => [
					'label' => 'exclude filter',
				],
			],
		],
	],
	100 => [
		'Performance' => [
			10 => [
				'is_valid_proofreading_cache' => [
					'label'   => 'Whether to use proofreading result cache',
					'type'    => 'bool',
					'default' => false,
				],
			],
		],
	],
];