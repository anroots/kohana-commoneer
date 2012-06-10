<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Commonly used validation functions
 *
 * @package Commoneer
 * @category Security
 * @author Ando Roots <anroots@itcollege.ee>
 * @since 1.0
 */
class Commoneer_Validation extends Kohana_Validation {

	/**
	 * Displays validation exceptions
	 *
	 * @since 1.0
	 * @static
	 * @uses Notify::msg A flash-message module https://github.com/kaltar/Notify
	 * @param $e array ORM_Validation_Exception array
	 * @return void
	 */
	public static function show_errors($e)
	{
		if (is_string($e)) {
			Notify::msg($e, 'error');
			return;
		}

		if (is_object($e)) {
			$e = $e->errors('validation');
		}
		if (! empty($e) && is_array($e)) {
			foreach ($e as $error) {
				Notify::msg($error, 'error');
			}
		}
	}
}
