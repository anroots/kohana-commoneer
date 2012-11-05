<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Commonly used HTML helpers
 *
 * @package Commoneer
 * @category Helpers
 * @author Ando Roots <ando@sqroot.eu>
 * @since 1.4
 */
class Commoneer_HTML extends Kohana_HTML {

	/**
	 * Holds the current array of breadcrumbs
	 * Filled via calls to HTML::breadcrumbs
	 *
	 * @var array Array of breadcrumbs
	 * @since 1.4
	 * @example array(0 => array('link' => 'admin', 'text' => 'Admin page'));
	 */
	public static $_breadcrumbs = array();

	/**
	 * Breadcrumb builder. Use to build the contents of the breadcrumb bar.
	 * Call with no parameters to output current breadcrumbs.
	 * Use $link and $text to add a new breadcrumb to the stack
	 * Call this method in your controller(s) to build the breadcrumb stack
	 * ...and echo the result in your template view
	 *
	 * @example HTML::breadcrumbs('admin', 'Main page'); echo HTML::breadcrumbs();
	 * @example HTML::breadcrumbs(array('admin' => 'Main page'));
	 * @example HTML::breadcrumbs(array('admin' => 'Main page'), array('admin/users' => 'Users'));
	 * @since 1.4
	 * @static
	 * @param null|string|array $link The link(s) of the breadcrumb. Base URL is appended automatically.
	 * @param null|string $text The text of the breadcrumb. Automatically translated. Can be empty if $link is an array.
	 * @return string|null|bool Rendered HTML when called with no params or TRUE
	 */
	public static function breadcrumbs($link = NULL, $text = NULL)
	{
		if (empty($link) && empty($text)) {
			// Return HTML for all added breadcrumbs
			return View::factory('templates/breadcrumbs', array('breadcrumbs' => self::$_breadcrumbs));
		}

		// Add a new breadcrumb?
		if ($link !== NULL) {

			// Add only one breadcrumb
			if (! is_array($link)) {
				self::$_breadcrumbs[] = array('link' => $link,
				                              'text' => __((string) $text)
				);
				return TRUE;
			}

			// The function can also be called with undefined number of array arguments
			$args = func_get_args();

			// Add all input breadcrumbs (1...n)
			foreach ($args as $crumb) {
				self::$_breadcrumbs[] = array('link' => key($crumb),
				                              'text' => __($crumb[key($crumb)])
				);
			}

		}
		return TRUE;
	}
}
