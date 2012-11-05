<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Validation extensions
 *
 * @author Ando Roots <ando@sqroot.eu>
 */
class Commoneer_Valid extends Kohana_Valid {


	/**
	 * Check that two values do not match
	 *
	 * @since 3.0
	 * @static
	 * @param mixed $value
	 * @param mixed $required
	 * @return bool Returns TRUE if $input is not exactly equal to $value
	 */
	public static function not_equal($value, $required)
	{
		return !Valid::equals($value,$required);
	}
}
