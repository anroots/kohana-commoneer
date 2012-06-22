<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Extra validation rules
 *
 * @package Commoneer
 * @category Security
 * @author Ando Roots <ando@roots.ee>
 * @since 1.4
 */
class Commoneer_Valid extends Kohana_Valid {

	/**
	 * Check whether a string is not negative
	 *
	 * @see Kohana_Valid::numeric
	 * @since 1.4
	 * @static
	 * @param string $value
	 * @return bool
	 */
	public static function not_negative($value)
	{
		return Valid::numeric($value) && $value >= 0;
	}
}
