<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Commonly used array functions
 *
 * @package Commoneer
 * @category Helpers
 * @author Ando Roots <ando@sqroot.eu>
 * @since 1.0
 */
class Commoneer_Arr extends Kohana_Arr {

	/**
	 * Unset all keys that have empty string values
	 *
	 * @since 1.0
	 * @static
	 * @param array $input
	 * @return array
	 */
	public static function unset_empty(array $input)
	{
		if (! is_array($input) || empty($input)) {
			return array();
		}

		foreach ($input as $key => $value) {
			if (is_string($value) && $value == '') {
				unset($input[$key]);
			}
		}
		return $input;
	}


	/**
	 * ucwords for callback to array_walk
	 *
	 * @see ucwords
	 * @see array_walk
	 * @static
	 * @param $value
	 * @param $key
	 * @return string
	 */
	public static function ucwords(&$value, $key)
	{
		$value = ucwords($value);
	}
}
