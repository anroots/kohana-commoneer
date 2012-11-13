<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Commonly used date functions
 *
 * @package Commoneer
 * @category Helpers
 * @author Ando Roots <ando@sqroot.eu>
 * @since 1.0
 */
class Commoneer_Date extends Kohana_Date {

	/**
	 * Timestamp format of MYSQL, with time
	 *
	 * @since 2.0
	 * @see self::mysql_date()
	 */
	const MYSQL_LONG = 'Y-m-d H:i:s';

	/**
	 * Timestamp format of MYSQL, date only
	 *
	 * @since 2.0
	 * @see self::mysql_date()
	 */
	const MYSQL_SHORT = 'Y-m-d';

	/**
	 * @var string Long date format string
	 * @see Date::localized_date
	 * @static
	 */
	public static $_format_long = 'd.m.Y H:i';

	/**
	 * @var string Short date format string
	 * @see Date::localized_date
	 * @static
	 */
	public static $_format_short = 'd.m.Y';


	/**
	 * Load date format initial config
	 *
	 * @since 1.0
	 * @see Date::localized_date
	 */
	public function __construct()
	{
		parent::construct();

		$format_long = Kohana::$config->load('commoneer.date_format_long');
		if (! empty($format_long)) {
			self::$_format_long = $format_long;
		}

		$format_short = Kohana::$config->load('commoneer.date_format_short');
		if (! empty($format_short)) {
			self::$_format_short = $format_short;
		}
	}


	/**
	 * Converts input date to MYSQL format
	 * Numeric input will be treated as time from UNIX_EPOCH
	 *
	 * @example: Date::mysql_date(31.12.2001 00:00:06, FALSE) == '2011-12-31'
	 * @static
	 * @param string|int|null|DateTime $date Any valid date string. Leave empty to use NOW().
	 * @param bool $include_time If true, return H:i:s also
	 * @throws InvalidArgumentException
	 * @return string MYSQL format date
	 */
	public static function mysql_date($date = NULL, $include_time = TRUE)
	{
		if (empty($date)) {
			$date = time();
		} elseif ($date instanceof DateTime) {
			return $date->format($include_time ? self::MYSQL_LONG : self::MYSQL_SHORT);
		}

		if (! strtotime($date)) { // Assume date is a timestamp
			if (! is_numeric($date)) { // Malformed string!
				throw new InvalidArgumentException('Invalid $date, "'.(string) $date.'"!');
			}
			$date = date(self::MYSQL_LONG, $date);
		}

		return date($include_time ? self::MYSQL_LONG : self::MYSQL_SHORT, strtotime($date));
	}


	/**
	 * Returns the localized version of a date
	 * Set your local date format in the Commoneer config file
	 * or by dynamically modifying the static format variables
	 *
	 * @static
	 * @since 1.0
	 * @see Date::set_format()
	 * @see Date::$_format_long
	 * @see Date::$_format_short
	 * @param string|null|DateTime|int $date Date string in any format, timestamp, DateTime or empty for time()
	 * @param bool $include_time Whether to return the long format
	 * @return string Date string in the specified localized format
	 */
	public static function localized_date($date = NULL, $include_time = FALSE)
	{
		if (is_numeric($date) && $date > 1) {
			// Timestamp given, do nothing
		} elseif (is_string($date) && ! empty($date)) { // Date string
			$date = strtotime($date);
		} elseif ($date instanceof DateTime) {
			$date = $date->getTimestamp();
		} else { // Default: time()
			$date = time();
		}

		return date($include_time ? self::$_format_long : self::$_format_short, $date);
	}
}