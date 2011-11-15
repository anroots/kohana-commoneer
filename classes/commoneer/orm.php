<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Commoneer ORM extension
 * @since 1.1
 * @throws Exception_Not_Allowed
 * @package Commoneer
 * @author Ando Roots
 */
abstract class Commoneer_ORM extends Kohana_ORM
{

	/**
	 * Specify the allowed input filters for Commoneer_ORM::get()
	 *
	 * Attributes NOT in the array will be ignored.
	 * Set to FALSE to disable
	 *
	 * @var array
	 * @see Commoneer_ORM::get()
	 */
	protected $_allowed_filters = FALSE;

	/**
	 * @var bool Set to TRUE to enable automagical deleted column features
	 * If TRUE and the table has a deleted column, treats entities with deleted=1 as nonexistent
	 */
	protected $_is_deletable = FALSE;
	
	
	/**
	 * @var bool Whether or not the current model has 'deleted' column
	 */
	private $_has_deleted = FALSE;

	/**
	 * @param null $id
	 */
	public function __construct($id = NULL)
	{
		parent::__construct($id);
		$this->_has_deleted = array_key_exists('deleted', $this->table_columns());
	}

	/**
	 * Get a single or several ORM records, based on $filters
	 *
	 * @since 1.1
	 * @throws Exception_Not_Allowed
	 * @param mixed $filters Empty: find all, integer: find by ID, assoc. array: apply filters
	 * @param bool $execute Whether to execute the query or only apply the filters
	 * @return Database_Result|Haldaja_ORM|ORM
	 */
	public function get($filters = NULL, $execute = TRUE)
	{
		if ($this->loaded()) {
			$this->clear();
		}

		// We don't want deleted rows!
		if ($this->_is_deletable && $this->_has_deleted && !isset($filters['deleted'])) {
			$this->where('deleted', '=', 0);
		}

		// Get a single row by ID
		if (is_numeric($filters)) {
			return $this->where('id', '=', $filters)
					->find();

			// Get all rows that match input filters
		} elseif (is_array($filters)) {
			foreach ($filters as $key => $value) {

				// Filters must be explicitly allowed
				if ($this->_allowed_filters !== FALSE && !in_array($key, $this->_allowed_filters)) {
					throw new Exception_Not_Allowed();
				}

				// Apply filters
				switch ($key) {
					case 'limit':
						$this->limit($value);
						break;
					default:
						$this->where($key, '=', $value);
				}
			}
		}

		// Return an executed query or $this with filters applied
		return $execute ? $this->order_by('id', 'desc')
				->find_all() : $this;
	}


	/**
	 * Safe delete of a record
	 *
	 * Override the ORM::delete function since we usually
	 * don't want to permanently destroy data
	 *
	 * @since 1.1
	 * @param bool $force Deletes the data permanently if set to TRUE
	 * @return bool|ORM
	 */
	public function delete($force = FALSE)
	{

		// The deleted column does not exist, we have no choice
		if (!$this->_is_deletable || !array_key_exists('deleted', $this->table_columns())) {
			return parent::delete();
		}

		// Can not delete what isn't there...
		if (!$this->loaded()) {
			return FALSE;
		}

		$this->deleted = 1;
		try {
			return $this->save();
		} catch (ORM_Validation_Exception $e) {
		}
		return FALSE;
	}


	/**
	 * Find all matching rows
	 *
	 * This override adds deleted checking
	 * @return void
	 */
	public function find_all()
	{
		if ($this->_is_deletable && $this->_has_deleted) {
			$this->where(Inflector::singular($this->table_name()).'.deleted', '=', 0);
		}
		return parent::find_all();
	}

	/**
	 * @since 1.1
	 * @return array
	 */
	public function filters()
	{
		return array(
			TRUE => array(
				array('trim')
			)
		);
	}
}
