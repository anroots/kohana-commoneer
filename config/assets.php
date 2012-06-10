<?php defined('SYSPATH') or die('No direct access allowed.');

/**
 * Assets class configuration file
 *
 * @since 1.0
 * @package Commoneer
 * @subpackage Assets
 * @author Ando Roots <anroots@itcollege.ee>
 */
return array(

	/**
	 * In case you have some crazy routing going on.
	 * This will be appended between the base url and the asset path
	 * Normally it's fine to leave it to NULL
	 */
	'assets_url'     => NULL,

	/**
	 * Automatically search for (and include) a matching resource file for
	 * the current controller/action
	 * For action_dog() of the controller Controller_Pet
	 * the following files get included (if exist)
	 * css/pet/dog.css
	 * js/pet/dog.js
	 * less/pet/dog.less
	 *
	 * @since 1.2
	 */
	'auto_include'   => TRUE,

	/**
	 * Array of asset folder locations relative to the DOCROOT
	 * array('css' => array('assets/css/'), 'js' => array(), ...
	 * These paths will be searched for the assets you include
	 * **/
	'assets_paths'   => array(
		Assets::STYLE  => array(
			'assets/css/',
			'assets/shared/css/',
		),
		Assets::SCRIPT => array(
			'assets/js/', // Project specific
			'assets/shared/js/', // Shared is symlink to resource repository
		),
	),

	/**
	 * Predefined assets - a match from here will be searched for first.
	 * Syntax: alias (what you use to include the asset) => path (relative to the DOCROOT, no file extension
	 */
	'known_assets'   => array(

		Assets::SCRIPT => array(
			'tablesorter' => 'assets/js/libs/tablesorter-1.min',
			'ui'          => 'assets/shared/js/libs/jquery-ui-1.8.16.min',
		),
		Assets::STYLE  => array(
			'ui' => 'assets/shared/css/aristo/jquery-ui-1.8.7.custom',
		)
	),

	/**
	 * Define presets i.e. several includes with one alias
	 * Syntax: alias => array('first_include', 'second_include')
	 * Includes must be known assets (defined above)
	 * Each preset is identified by name and contains a list of predefined assets
	 *
	 * @since 1.4
	 */
	'presets'        => array(

		'ui' => array(
			Assets::STYLE  => array(
				'ui'
			),
			Assets::SCRIPT => array(
				'ui'
			),
		)
	),

	/**
	 * A list of assets to always include. Order of assets is important.
	 * These assets will always be rendered first
	 *
	 * @since 2.0
	 */
	'always_include' => array(
		Assets::SCRIPT => array(

		),
		Assets::STYLE  => array(

		)
	)
);

