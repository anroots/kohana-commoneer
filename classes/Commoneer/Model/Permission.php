<?php defined('SYSPATH') or die('No direct script access.');
/**
 * @since 2.0
 * @author Ando Roots <ando@sqroot.eu>
 */
class Commoneer_Model_Permission extends ORM {

	protected $_has_many = [
		'roles'=> ['through'=> 'permissions_roles']
	];

	// Permission modes for User::can
	const ANY = 1;
	const ALL = 2;

	// Add your permission constants here
	// const EDIT_USER = 1; // Roles with this permission can edit user accounts.
}