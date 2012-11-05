<?php defined('SYSPATH') or die('No direct access allowed.');

/**
 * @since 1.0
 * @package Commoneer
 * @author Ando Roots <ando@sqroot.eu>
 */
interface Commoneer_Assets_Interface {

	/**
	 * Que a new javascript file
	 *
	 * @static
	 * @abstract
	 * @param $names
	 * @return void
	 */
	public static function use_script($names);

	/**
	 * Que a new stylesheet (by default, LESS)
	 *
	 * @static
	 * @abstract
	 * @param $names
	 * @return void
	 */
	public static function use_style($names);

	/**
	 * Que a new preset
	 *
	 * @static
	 * @abstract
	 * @param $names
	 * @return void
	 */
	public static function preset($names);

	/**
	 * Get the singleton instance
	 *
	 * @static
	 * @abstract
	 * @return Commoneer_Assets
	 */
	public static function instance();

	/**
	 * Output all queued files as HTML markup (used in template head)
	 *
	 * @static
	 * @abstract
	 * @param bool|string $type Render all or only one type of includes
	 * @return void
	 */
	public static function render($type = TRUE);
}