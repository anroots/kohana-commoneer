<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Input filtering functions
 * Used for filtering any kind of user data, usually in ORM filter() functions.
 *
 * @package Commoneer
 * @category Helpers
 * @author Ando Roots <ando@sqroot.eu>
 * @since 3.0
 */
class Commoneer_Filter {

	/**
	 * Convert comma to period in the input string
	 *
	 * @since 1.0
	 * @static
	 * @param string|int $input A numeric value
	 * @param int|bool $round How many decimal places to return?
	 * @return float A numeric value in MYSQL compatible format (decimal separated by periods)
	 */
	public static function mysql_float($input = 0, $round = false)
	{
		if (empty($input)) {
			return (float) 0;
		}
		$input = (float) rtrim(str_replace(',', '.', $input), ' 0');

		return $round === false ? $input : round($input, $round);
	}


	/**
	 * Returns NULL if value is empty (and not integer 0)
	 * Used to keep MYSQL field default NULL when $_POST gives an empty string
	 *
	 * @static
	 * @since 1.0
	 * @param mixed $input
	 * @return null|mixed NULL or the input itself
	 */
	public static function null_or_value($input)
	{
		return empty($input) && $input !== 0 && $input !== '0' ? null : $input;
	}

	/**
	 * Transform int 0 to NULL
	 *
	 * @since 3.0
	 * @static
	 * @param mixed $input
	 * @return mixed NULL or input value
	 */
	public static function int2null($input)
	{
		return $input == 0 ? null : $input;
	}

	/**
	 * Convert a string to a boolean value
	 * Works on other data types as well
	 *
	 * @since 1.4
	 * @param mixed $input An input string that will be cast to a boolean value
	 * @param bool $default The default value for when $input is empty
	 * @return bool
	 **/
	public static function str2bool($input, $default = false)
	{
		if (empty($input)) {
			return $default;
		}
		return (bool) $input;
	}
}
