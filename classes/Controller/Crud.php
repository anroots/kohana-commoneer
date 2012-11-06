<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Mixin for controllers that implement CRUD functionality
 *
 * @since 3.0
 * @author Ando Roots <ando@sqroot.eu>
 */
trait Controller_Crud
{

	/**
	 * Basic DELETE controller action
	 *
	 * @since 3.0
	 */
	public function action_delete()
	{
		if ($this->_orm instanceof ORM and $this->_orm->loaded()) {
			$this->_orm->delete();
		}

		$this->redirect($this->request->controller());
	}
}