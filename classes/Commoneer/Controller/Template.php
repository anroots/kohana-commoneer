<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Main controller template
 * Adds common functionality such as auto-loaded convention-over-configuration views and shorthand view attributes.
 *
 * @since 1.1
 * @package Commoneer
 * @category Controller
 * @author Ando Roots <ando@sqroot.eu>
 */
abstract class Commoneer_Controller_Template extends Kohana_Controller_Template
{

	/**
	 * Default template
	 *
	 * @var string
	 */
	public $template = 'templates/default';

	/**
	 * Does accessing the current controller requires login
	 *
	 * @var bool
	 */
	protected $_require_login = FALSE;

	/**
	 * Alias to $this->template->content
	 *
	 * @var View
	 */
	public $content;

	/**
	 * @var string The name of the controller's matching ORM model.
	 * This model will be auto-instanced and loaded with $this->id as the PK
	 * The model name is auto-detected from the controller's class name
	 * @since 2.0
	 */
	protected $_orm_name;

	/**
	 * @var mixed ORM model associated with this controller
	 * @example Controller_User would hold an instance of Model_User
	 * @since 2.0
	 * @see self::$_orm_name
	 */
	protected $_orm;

	/**
	 * Alias to $this->template->title
	 *
	 * @var
	 */
	public $title;

	/**
	 * Request::current()->param('id')
	 *
	 * @see Request::param()
	 * @var string Current resource ID
	 */
	public $id;

	/**
	 * Check if the user is logged in
	 *
	 * @since 1.2
	 * @return void
	 */
	protected function _check_login()
	{
		if ($this->_require_login && ! Auth::instance()->logged_in()) {
			$this->redirect($this->_get_login_url());
		}
	}


	public function before()
	{
		parent::before();

		$this->id = $this->request->param('id');

		// Redirect if not logged in
		$this->_check_login();

		$this->_load_orm();

		// Load view that matches with the current directory / controller / action
		$this->_load_view();

		// Make the default ORM model accessible from the view
		if ($this->_orm instanceof ORM && $this->content instanceof View) {
			$this->content->{lcfirst($this->_orm_name)} = $this->_orm;
		}
	}

	/**
	 * Load the ORM model
	 */
	private function _load_orm()
	{
		if ($this->_orm_name === NULL) {
			$this->_orm_name = $this->_get_orm_name();
		}

		// Load associated ORM model
		if ($this->_orm_name !== FALSE) {
			$this->_orm = ORM::factory($this->_orm_name, $this->id);
		}
	}

	/**
	 * Load view for the current controller/action
	 *
	 * @since 3.0
	 */
	private function _load_view()
	{
		$dir = $this->request->directory();

		$dir       = empty($dir) ? NULL : $dir.DIRECTORY_SEPARATOR;
		$view_path = $dir.$this->request->controller().DIRECTORY_SEPARATOR.$this->request->action();
		$view_path = strtolower($view_path);

		$this->content = Kohana::find_file('views', $view_path)
			? View::factory($view_path) : NULL;
	}

	/**
	 * Assuming we have a config file app.php!
	 *
	 * @return void
	 */
	public function after()
	{
		if ($this->title !== FALSE && empty($this->title)) {
			$this->title = Kohana::$config->load('app.title');
		}

		$this->template->title   = $this->title;
		$this->template->content = $this->content;
		parent::after();
	}

	/**
	 * @return string URL to redirect to when login is required
	 */
	protected function _get_login_url()
	{
		return Kohana::$config->load('auth.uri').URL::query(array('r' => $this->request->uri()));
	}


	/**
	 * Get the name of the ORM model that corresponds to the current controller.
	 *
	 * @example Controller_Company would get back 'company'
	 * @return bool|string class name that can be fed to ORM::factory()
	 */
	private function _get_orm_name()
	{
		$controller_name = explode('Controller_', get_called_class(), 2)[1];
		$controller_name = ucfirst(Inflector::singular($controller_name));

		if (class_exists('Model_'.$controller_name)) {
			return $controller_name;
		}
		return FALSE;
	}
}
