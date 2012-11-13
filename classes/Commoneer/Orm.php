<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Commoneer ORM extension
 *
 * @since 1.1
 * @throws Exception_Not_Allowed
 * @package Commoneer
 * @author Ando Roots <ando@sqroot.eu>
 */
abstract class Commoneer_ORM extends Kohana_ORM
{

	/**
	 * Auto-fill created column in DB tables on record create.
	 *
	 * @var array
	 */
	protected $_created_column = array(
		'column' => 'created',
		'format' => 'Y-m-d H:i:s'
	);

	/**
	 * Auto-fill updated column in DB tables on record update
	 *
	 * @var array
	 */
	protected $_updated_column = array(
		'column' => 'updated',
		'format' => 'Y-m-d H:i:s'
	);

	/**
	 * @var string The name of the column in the database that fills the role of the 'deleted' column
	 * @since 2.0
	 */
	protected $_deleted_column_name = 'deleted';

	/**
	 * @var bool Set to TRUE to enable automagical deleted column features
	 * @since 1.2
	 * If TRUE and the table has a deleted column, treats entities with deleted=1 as nonexistent
	 */
	protected $_is_deletable = FALSE;


	/**
	 * @var bool Whether or not the current model has 'deleted' column
	 * @since 1.2
	 */
	private $_has_deleted = FALSE;

	/**
	 * @since 1.2
	 * @param null $id
	 */
	public function __construct($id = NULL)
	{
		parent::__construct($id);
		$this->_has_deleted = array_key_exists($this->_deleted_column_name, $this->table_columns());
	}

	/**
	 * Exclude deleted rows from the result set
	 *
	 * @since 1.1
	 * @return Database_Result
	 */
	public function exclude_deleted()
	{
		if ($this->_is_deletable && $this->_has_deleted) {
			$this->where($this->_deleted_column_name, '=', 0);
		}

		return $this;
	}


	/**
	 * Safe delete of a record.
	 * Override the ORM::delete function since we usually
	 * don't want to permanently destroy data.
	 *
	 * @since 1.1
	 * @param bool $force Deletes the data permanently if set to TRUE
	 * @throws ORM_Unloaded_Exception
	 * @return bool|ORM
	 */
	public function delete($force = FALSE)
	{
		// The deleted column does not exist, we have no choice
		if (! $this->_is_deletable || ! array_key_exists($this->_deleted_column_name, $this->table_columns())) {
			return parent::delete();
		}

		// Can not delete what isn't there...
		if (! $this->loaded()) {
			throw new ORM_Unloaded_Exception;
		}

		$this->{$this->_deleted_column_name} = 1;
		return $this->save();
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

	/**
	 * Return an array of changed properties with their old => new values.
	 * Used in logging functions.
	 *
	 * @since 2.0
	 * @param bool $html TRUE to get back HTML string instead of an array
	 * @return array|string|null
	 */
	public function changed_log($html = TRUE)
	{
		if ($this->loaded() && count($this->changed())) {

			$log      = [];
			$original = $this->original_values();

			// Create a map of changed properties
			foreach ($this->changed() as $property) {
				$log[$property] = [$original[$property], $this->{$property}];
			}

			// Return HTML?
			if ($html) {
				$string = '<ul>';
				foreach ($log as $key => $changes) {
					$string .= '<li><strong>'.$key.'</strong>: '.$changes[0].' => '.$changes[1].'</li>';
				}
				return $string.'</ul>';
			}

			return $log;
		}
		return NULL;
	}
}