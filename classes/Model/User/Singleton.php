<?php defined('SYSPATH') or die('No direct script access.');
/**
 * @since 3.0
 * @author Ando Roots <ando@sqroot.eu>
 */
trait Model_User_Singleton {

	/**
	 * Get the singleton instance of the logged in user
	 *
	 * @since 3.0
	 * @static
	 * @return Model_User
	 */
	final public static function current()
	{
		static $_current;

		if ($_current === null) {
			$_current = Auth::instance()->get_user();
		}
		return $_current;
	}
}
