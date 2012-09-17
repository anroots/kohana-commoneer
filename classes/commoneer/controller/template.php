<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Main controller template
 * Adds common functionality such as convention-over-configuration views,
 * common attributes and functions
 *
 * @since 1.1
 * @package Commoneer
 * @category Controller
 * @author Ando Roots <ando@roots.ee>
 */
abstract class Commoneer_Controller_Template extends Kohana_Controller_Template {

	/**
	 * Default template
	 *
	 * @var string
	 */
	public $template = 'templates/theme';

	/**
	 * Whether accessing the current controller requires login
	 *
	 * @var bool
	 */
	protected $_require_login = FALSE;

	/**
	 * Additional view path
	 * Will be appended after the default view folder path
	 * Example: public for views/public
	 *
	 * @var string
	 */
	protected $_view_path = '';

	/**
	 * Default views folder
	 *
	 * @var string
	 */
	protected $_default_view_path = 'views';

	/**
	 * Alias to $this->template->content
	 *
	 * @var
	 */
	public $content;

	/**
	 * @var string Redirect there when login is required, but user is not authenticated
	 */
	protected $_login_url = 'public';

	/**
	 * @var string The name of the controller's matching ORM model. This model will be auto-instanced and loaded with $this->id
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
	 * Request::current()->param('param');
	 *
	 * @var string URI Param
	 */
	public $param;

	/**
	 * Change login requirement for accessing the current controller
	 * Should be called before calling parent::before()
	 *
	 * @param bool $require TRUE if login is required for the current controller
	 * @return void
	 */
	public function require_login($require = TRUE)
	{
		$this->_require_login = (bool) $require;
	}


	/**
	 * Check login
	 *
	 * @since 1.2
	 * @return void
	 */
	protected function _check_login()
	{
		// Redirect if not logged in
		if ($this->_require_login && ! Auth::instance()->logged_in()) {
			$this->request->redirect($this->_get_login_url());
		}
	}


	public function before()
	{
		parent::before();

		$this->id = $this->request->param('id');
		$this->param = $this->request->param('param');

		$this->_login_url = Kohana::$config->load('auth.login_uri');

		$this->_check_login();

		// Load associated ORM model
		if ($this->_orm_name !== NULL) {
			$this->_orm = ORM::factory($this->_orm_name, $this->id);
		}

		/**
		 * Assign all controllers and actions a default view - convention over configuration!
		 * View files shall be named like so: APPPATH/views/CONTROLLER/ACTION.php
		 * So controller "dash" action "index" will have the view APPPATH/views/dash/index
		 **/

		// DIRECTORY / CONTROLLER / ACTION
		// Ignore dir if empty
		$dir = $this->request->directory();

		$dir = empty($dir) ? NULL : $dir.DIRECTORY_SEPARATOR;
		$view_convention = $dir.$this->request->controller().DIRECTORY_SEPARATOR.$this->request->action();


		// If view folder is not default append custom path to the view file path
		if ($this->_view_path) {
			$this->content = Kohana::find_file($this->_default_view_path.DIRECTORY_SEPARATOR.$this->_view_path, $view_convention)
				? View::factory($this->_view_path.DIRECTORY_SEPARATOR.$view_convention) : NULL;

		} else {
			// Default view folder
			$this->content = Kohana::find_file($this->_default_view_path, $view_convention)
				? View::factory($view_convention) : NULL;
		}

		// Make the default ORM model accessible from the view
		if (isset($this->content) && $this->_orm_name !== NULL && $this->_orm instanceof ORM) {
			$this->content->{$this->_orm_name} = $this->_orm;
		}
	}

	/**
	 * Assuming we have a config file app.php!
	 *
	 * @return void
	 */
	public function after()
	{
		if (! $this->request->is_ajax() && $this->template) {
			// The default application title
			$this->template->title = empty($this->title) && $this->title !== FALSE ? Kohana::$config->load('app.title') :
				$this->title;
			$this->template->content = $this->content;
		}
		parent::after();
	}

	/**
	 * @return string URL to redirect to when login is required
	 */
	protected function _get_login_url()
	{
		return $this->_login_url.URL::query(array('r' => $this->request->uri()));
	}
}
