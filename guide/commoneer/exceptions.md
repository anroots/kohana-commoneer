# Exceptions

Commoneer includes some new throwable exceptions, currently only for semantics.

* Exception_Not_Allowed
* Exception_Not_Implemented
* Exception_Sarcasm
* Exception_Config

Custom Error Design on Production
=================================

You can have Commoneer override the default error handler in a production environment by placing the following file in `application/classes/kohana/exception.php`. This can prove unnecessary in the future when the author figures out how to auto-include it using the Cascading File System.

	<?php defined('SYSPATH') or die('No direct script access.');
	/**
	 * Override Kohana's default Exception handler with Commoneer's
	 *
	 * Override applies only in a non-development environment
	 *
	 * @see Kohana::$environment
	 * @author Ando Roots <ando@roots.ee>
	 * @package Commoneer
	 * @subpackage Exception
	 * @since 1.3
	 */
	class Kohana_Exception extends Kohana_Kohana_Exception
	{
	    /**
	     * Overrides the Exception handler
	     *
	     * @static
	     * @since 1.3
	     * @param Exception $e
	     * @return bool|void
	     */
	    public static function handler(Exception $e)
	    {
	        return Commoneer_Exception::handler($e);
	    }
	}
