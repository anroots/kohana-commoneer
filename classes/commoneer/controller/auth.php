<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Default Auth controller - provides login/logout functionality
 *
 * @since 1.4
 * @abstract
 * @package Commoneer
 * @category Controller
 * @author Ando Roots <ando@roots.ee>
 */
class Commoneer_Controller_Auth extends Commoneer_Controller_Template {

	/**
	 * @var string The template for the login view
	 */
	public $template = 'templates/public/auth';

	/**
	 * @var string The URL to redirect to after successful authentication
	 */
	public $dash = 'dash';

	public function before(){
		$this->dash = Kohana::$config->load('auth.login_success_uri');
		parent::before();
	}

	/**
	 * Shows the login page and handles login
	 *
	 * @since 1.x
	 * @return void
	 */
	public function action_index()
	{
		// Can't authenticate twice
		if (Auth::instance()->logged_in()) {
			$this->request->redirect('');
		}

		// If the login form was posted...
		if ($this->request->post()) {

			// Try to login
			if (Auth::instance()->login($this->request->post('user'), $this->request->post('pass'))) {
				$this->request->redirect($this->dash);
			} else {
				Notify::msg('Authentication failed!', 'error');
			}

			// Auth failed
			$this->request->redirect($this->_login_url);
		}
	}

	/**
	 * Logout the user and redirect
	 *
	 * @since 1.x
	 */
	public function action_logout()
	{
		Auth::instance()->logout();
		$this->request->redirect(Kohana::$config->load('auth.logout_redirect_url'));
	}
}