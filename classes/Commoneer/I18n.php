<?php defined('SYSPATH') or die('No direct script access.');
/**
 * 118n helpers
 *
 * @author Ando Roots <ando@sqroot.eu>
 * @since 2.0
 */
class Commoneer_I18n extends Kohana_I18n {

	/**
	 * Translate an array of values
	 *
	 * @since 2.0
	 * @static
	 * @param array $array An array of key => value pairs
	 * @return array The same array with translated values
	 */
	public static function arr(array $array)
	{
		if (count($array)) {
			foreach ($array as $key => $value) {
				$array[$key] = __($value);
			}
		}
		return $array;
	}
}