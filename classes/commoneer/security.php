<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Commonly used security functions
 *
 * @package Commoneer
 * @category Security
 * @author Ando Roots <anroots@itcollege.ee>
 * @since 1.0
 */
class Commoneer_Security extends Kohana_Security {


	/**
	 * Returns a safe string for aliases/url-s/file names
	 *
	 * @since 1.0
	 * @static
	 * @param string $input Arbitrary string
	 * @deprecated Since 2.0, identical to URL::title
	 * @return string Cleaned input string
	 */
	public static function safe_string($input)
	{
		return URL::title($input);
	}
}