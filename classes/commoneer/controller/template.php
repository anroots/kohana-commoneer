<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Main controller template
 *
 * Adds common functionality such as convention-over-configuration templating,
 * common attributes and functions
 *
 * @since 1.1
 * @package Commoneer
 * @category Controller
 * @author Ando Roots 2011
 *
 */
abstract class Commoneer_Controller_Template extends Kohana_Controller_Template
{

	/**
	 * Default template
	 * @var string
	 */
	public $template = 'templates/theme';

	/**
	 * Whether accessing the current controller requires login
	 * @var bool
	 */
	protected $_require_login = FALSE;


	/**
	 * Additional view path
	 * Will be appended after the default view folder path
	 * Example: public for views/public
	 * @var string
	 */
	protected $_view_path = '';

	/**
	 * Default views folder
	 * @var string
	 */
	protected $_default_view_path = 'views';


	/**
	 * Alias to $this->template->content
	 * @var
	 */
	public $content;


	/**
	 * @var string Redirect there when login is required, but user is not authenticated
	 */
	protected $_login_url = 'public';


	/**
	 * Alias to $this->template->title
	 * @var
	 */
	public $title;

	/**
	 * Request::current()->param('id')
	 * @see Request::param()
	 * @var Current resource ID
	 */
	public $id;

	/**
	 * Request::current()->param('param');
	 * @var string URI Param
	 */
	public $param;

	/**
	 * Change login requirement for accessing the current controller
	 *
	 * Should be called before calling parent::before()
	 *
	 * @param bool $require TRUE if login is required for the current controller
	 * @return void
	 */
	public function require_login($require = TRUE)
	{
		$this->_require_login = (bool)$require;
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
		if ($this->_require_login && !Auth::instance()->logged_in()) {
			$this->request->redirect($this->_login_url);
		}
	}


	public function before()
	{
		parent::before();

		$this->id = $this->request->param('id');
		$this->param = $this->request->param('param');

		$this->_check_login();

		/**
		 * Assign all controllers and actions a default view - convention over configuration!
		 * View files shall be named like so: APPPATH/views/CONTROLLER/ACTION.php
		 * So controller "dash" action "index" will have the view APPPATH/views/dash/index
		 **/


		// DIRECTORY / CONTROLLER / ACTION
		// Ignore dir if empty
		$view_convention = $this->request->directory() === '/' ? $this->request->directory()
				: NULL . DIRECTORY_SEPARATOR .
				  $this->request->controller() . DIRECTORY_SEPARATOR . $this->request->action();


		// If view folder is not default append custom path to the view file path
		if ($this->_view_path) {
			$this->content = Kohana::find_file($this->_default_view_path . DIRECTORY_SEPARATOR . $this->_view_path, $view_convention)
					? View::factory($this->_view_path . DIRECTORY_SEPARATOR . $view_convention) : NULL;

		} else {
			// Default view folder
			$this->content = Kohana::find_file($this->_default_view_path, $view_convention)
					? View::factory($view_convention) : NULL;
		}
	}


	/**
	 * Assuming we have a config file app.php!
	 * @return void
	 */
	public function after()
	{
		if (!$this->request->is_ajax() && $this->template) {
			// The default application title
			$this->template->title = empty($this->title) ? Kohana::$config->load('app.title') : $this->title;
			$this->template->content = $this->content;
		}
		parent::after();
	}

}
