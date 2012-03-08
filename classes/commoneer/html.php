<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Commonly used HTML helpers
 *
 * @package Commoneer
 * @category Helpers
 * @author Ando Roots 2012
 * @since 1.4
 */
class Commoneer_HTML extends Kohana_HTML
{

	/**
	 * Holds the current array of breadcrumbs
	 *
	 * Filled via calls to HTML::breadcrumbs
	 *
	 * @var array Array of breadcrumbs
	 * @since 1.4
	 * @example array(0 => array('link' => 'admin', 'text' => 'Admin page'));
	 */
	public static $_breadcrumbs = array();

	/**
	 * Breadcrumb builder. Use to build the contents of the breadcrumb bar.
	 *
	 * Call with no parameters to output current breadcrumbs.
	 * Use $link and $text to add a new breadcrumb to the stack
	 * Call this method in your controller(s) to build the breadcrumb stack
	 * ...and echo the result in your template view
	 *
	 * @example HTML::breadcrumbs('admin', 'Main page'); echo HTML::breadcrumbs();
	 * @since 1.4
	 * @static
	 * @param null|string|array $link The link of the breadcrumb. Base URL is appended automatically.
	 * @param null|string $text The text of the breadcrumb. Automatically translated
	 * @return bool|null|View True when adding breadcrumbs, HTML string of all added breadcrumbs when called with no params.
	 */
	public static function breadcrumbs($link = NULL, $text = NULL)
	{
		// Add a new breadcrumb?
		if (($link !== NULL && $text !== NULL) || is_array($link)) {

			if (!is_array($link)) {
				$link = array($link => $text);
			}

			// Add all input breadcrumbs (1...n)
			foreach ($link as $url => $text) {
				HTML::$_breadcrumbs[] = array('link' => $url, 'text' => __($text));
			}

			return TRUE;
		}

		// Any breadcrumbs to display?
		if (empty(HTML::$_breadcrumbs)) {
			return NULL;
		}

		// Return HTML for all added breadcrumbs
		return View::factory('templates/breadcrumbs', array('breadcrumbs' => HTML::$_breadcrumbs));
	}
}
