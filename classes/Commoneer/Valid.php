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

	/**
	 * Check if the start date is smaller than the end date
	 * Useful in validation rules
	 *
	 * @since 1.0
	 * @param string|int|DateTime $start Any date string or timestamp value
	 * @param string|int|DateTime $end Any date string or timestamp value
	 * @return bool TRUE if $start is strictly smaller than $end
	 */
	public static function date_smaller_than($start, $end)
	{
		if ($start instanceof DateTime) {
			$start = $start->getTimestamp();
		}

		if ($end instanceof DateTime) {
			$end = $end->getTimestamp();
		}

		if (
			(! is_numeric($start) && ! is_string($start))
			|| (! is_numeric($end) && ! is_string($end))
		) {
			return FALSE;
		}

		// Converts input to timestamps if needed
		if (! $ts1 = strtotime($start)) {
			$ts1 = $start;
		}
		if (! $ts2 = strtotime($end)) {
			$ts2 = $end;
		}

		return $ts1 < $ts2;
	}
}
