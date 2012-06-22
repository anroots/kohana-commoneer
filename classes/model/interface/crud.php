<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Basic CRUD interface
 *
 * @since 1.2
 * @package Commoneer
 * @category Model
 * @author Ando Roots <ando@roots.ee>
 */
interface Model_Interface_Crud {

	/**
	 * Get returns 0, 1 or many rows.
	 *
	 * @abstract
	 * @param mixed $filters An array of filter parameters such as array(money => 20) OR row ID
	 * @param bool $execute Whether to execute the query (TRUE) or only apply the filters and return $this
	 * @return ORM
	 */
	public function get($filters = NULL, $execute = TRUE);

	/**
	 * Create or update an existing row
	 * Will create a new record if the model is unloaded, else update an existing row
	 *
	 * @abstract
	 * @param array $data Assoc array of parameters to set/update.
	 * @return bool|int Insert ID on success, FALSE on failure
	 */
	public function change(array $data);


	/**
	 * Mark the row as deleted by setting deleted = 1
	 * We never-ever permanently delete a record
	 *
	 * @abstract
	 * @return void
	 */
	public function delete();
}