<?php defined('SYSPATH') or die('No direct access allowed.');

return array(

	'driver'       => 'ORM',
	'hash_method'  => 'sha256',
	'hash_key'     => 'WHEREISMYTOWEl',
	'lifetime'     => 56448,
	'session_type' => Session::$default,
	'session_key'  => 'auth_user',

);
