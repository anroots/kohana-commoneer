<?php defined('SYSPATH') or die('No direct script access.');
/**
 * @since 2.0
 * @author Ando Roots <ando@roots.ee>
 */
class Commoneer_Model_Role extends Model_Auth_Role {

	// Define your roles here
	const LOGIN = 1; // Allow login
	const ADMIN = 2; // Never-ever give this role to daily system users!

	protected $_has_many = [
		'permissions'=> ['through'=> 'permissions_roles'],
		'users'      => ['through'=> 'roles_users']
	];

	/**
	 * Check whether the current role can do some action
	 *
	 * @since 2.0
	 * @param int $permission_id See Permission constants
	 * @return bool True if the action is authorized for this role
	 */
	public function can($permission_id)
	{
		return $this->loaded() && $this->has('permissions', $permission_id);
	}
}