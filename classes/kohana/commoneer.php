<?php defined('SYSPATH') or die('No direct access allowed.');

class Kohana_Commoneer {


  protected static $instance = NULL;
	/**
	 * Get the singleton instance of Kohana_Commoneer.
	 *
	 * @return  Kohana_Commoneer
	 */
	protected static function return_instance()
	{
		if (self::$instance === NULL)
		{
			// Assign self
			self::$instance = new self;
		}

		return self::$instance;
	}

	final private function __construct()
	{
		// Enforce singleton behavior
	}

	final private function __clone()
	{
		// Enforce singleton behavior
	}

}