<?php defined('SYSPATH') or die('No direct access allowed.');

/**
 * Assets class config
 * @since 1.0
 * @package Commoneer
 * @subpackage Assets
 * @category Base
 * @author Ando Roots 2011
 * @copyright GPL v2 http://www.gnu.org/licenses/gpl-2.0.html
 */
return array(

	/**
	 * In case you have some crazy routing going on.
	 * This will be appended between the base url and the asset path
	 * Normally it's fine to leave it to NULL
	 */
	'assets_url' => NULL,

	/**
	 * Array of asset folder locations relative to the DOCROOT
	 * array('css' => array('assets/css/'), 'js' => array(), ...
	 * These paths will be searched for the assets you include
	 * **/
	'assets_paths' => array(
		'css' => array(
			'assets/css/',
			'assets/shared/css/',
		),
		'js' => array(
			'assets/js/', // Project specific
			'assets/shared/js/', // Shared is symlink to resource repository
		),
		'less' => array(
			'assets/less/',
		)
	),

	/**
	 * Predefined assets - a match from here will be searched for first.
	 * Syntax: alias (what you use to include the asset) => path (relative to the DOCROOT, no file extension
	 */
	'known_assets' => array(
		'css' => array(

		),
		'js' => array(
			'hoverintent' => 'shared/js/libs/hoverintent-v6.min',
		),
		'less' => array(

		)
	)
);

