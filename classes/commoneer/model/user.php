<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Common user functions.
 * Implements the singleton pattern for the currently logged in user.
 *
 * @since 2.0
 * @@author Ando Roots <ando@roots.ee>
 */
class Commoneer_Model_User extends Model_Auth_User {

	protected $_has_many = [
		'roles'       => ['model'   => 'role',
		                  'through' => 'roles_users'
		],
	];

	protected $_created_column = array('column'=> 'created',
	                                   'format'=> 'Y-m-d H:i:s'
	);
	protected $_updated_column = array('column'=> 'updated',
	                                   'format'=> 'Y-m-d H:i:s'
	);

	/**
	 * Do not access directly, use the instance() static function.
	 *
	 * @var Model_User Stores the singleton instance of the logged in user
	 */
	protected static $_current;

	public function rules()
	{
		return [
			'username'  => [
				['max_length', array(':value', 32)]
			],
			'name'      => [
				['not_empty'],
			]
		];
	}

	public function filters()
	{
		return [
			'password'   => [
				[[Auth::instance(), 'hash']]
			],
			'name'       => [
				['ucwords']
			],
		];
	}

	/**
	 * Checks if the user can perform a certain action.
	 * User has roles and roles have permissions.
	 *
	 * @param int|array $permission Permission as a integer (ID from `permissions`)
	 * @param int $mode Permission::ANY or Permission::ALL
	 * @see Model_Permission::define
	 * @see Model_Role::can
	 * @return bool
	 * @since 0.2
	 */
	public function can($permission = 0, $mode = Permission::ANY)
	{
		if ((! is_int($permission) && ! is_array($permission)) || ! $this->loaded() || ! $this->roles->count_all()) {
			return FALSE;
		}

		// Sorry... but the admin is all-powerful
		if ($this->has('roles', Role::ADMIN)) {
			return TRUE;
		}

		if (! is_array($permission) && $this->_check_permission($permission)) {
			return TRUE;
		}

		// An array of permissions
		if (is_array($permission)) {

			foreach ($permission as $perm) {
				// Any of the specified permissions
				if ($mode === Permission::ANY) {
					if ($this->_check_permission($perm)) {
						return TRUE;
					}
				} else { // All specified permissions
					if (! $this->_check_permission($perm)) {
						return FALSE;
					}
					return TRUE;
				}
			}
		}

		return FALSE;
	}

	/**
	 * Check if a user has the specified permission.
	 *
	 * @param int $permission
	 * @see Model_Permission
	 * @return bool
	 * @since 2.0
	 */
	private function _check_permission($permission = 0)
	{
		foreach ($this->roles->find_all() as $role) {
			if ($role->can($permission)) {
				return TRUE;
			}
		}
		return FALSE;
	}

	/**
	 * Get the singleton instance of the currently logged in user.
	 *
	 * @since 2.0
	 * @static
	 * @return Model_User
	 */
	final public static function current()
	{
		if (Model_User::$_current === NULL) {
			Model_User::$_current = Auth::instance()->get_user();
		}
		return Model_User::$_current;
	}
}