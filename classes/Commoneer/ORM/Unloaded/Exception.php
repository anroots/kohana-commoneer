<?php defined('SYSPATH') or die('No direct script access.');
class Commoneer_ORM_Unloaded_Exception extends Kohana_Exception
{

	public function __construct($message = "ORM model unloaded!", array $variables = NULL, $code = 1052,
		Exception $previous = NULL)
	{
		parent::__construct($message, $variables, $code, $previous);
	}

}