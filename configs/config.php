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

	// required wordpress version
	'required_wordpress_version'     => '5.0', // for gutenberg

	// main menu title
	'main_menu_title'                => 'Y Proofreading',

	// db version
	'db_version'                     => '0.0.1',

	// update
	'update_info_file_url'           => 'https://raw.githubusercontent.com/technote-space/y-proofreading/develop/update.json',

	// menu image url
	'menu_image'                     => 'icon-24x24.png',

	// suppress setting help contents
	'suppress_setting_help_contents' => true,

	// setting page title
	'setting_page_title'             => 'Detail Settings',

	// setting page priority
	'setting_page_priority'          => 100,

	// setting page slug
	'setting_page_slug'              => 'dashboard',

	// detail url
	'detail_url'                     => 'https://technote.space/y-proofreading',

	// twitter
	'twitter'                        => 'technote15',

	// github repo
	'github_repo'                    => 'technote-space/y-proofreading',

	// delete cache group
	'delete_cache_group'             => [ 'y-proofreading_classes_models_proofreading' ],
];
