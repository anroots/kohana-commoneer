<?php defined('SYSPATH') or die('No direct access allowed.');
return array(

	'driver'              => 'ORM',
	'hash_method'         => 'sha256',
	'hash_key'            => 'CHANGE_ME',
	'lifetime'            => 1209600,
	'session_type'        => Session::$default,
	'session_key'         => 'auth_user',

	/**
	 * URI path to the "login" page (without the base URI)
	 *
	 * @since 2.0
	 */
	'login_uri' => 'public',

	/**
	 * Users will be redirected there after logout. FULL (http://) URL please.
	 *
	 * @since 2.0
	 **/
	'logout_redirect_uri' => URL::base('http').'public',

	/**
	 * URI to redirect to after successful login (without base URI)
	 *
	 * @since 2.0
	 */
	'login_success_uri' => 'dash'
);