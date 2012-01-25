<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Default Auth controller - provides login/logout functionality
 *
 * @since 1.4
 * @abstract
 * @package Commoneer
 * @category Controller
 * @author Ando Roots 2011
 */
class Commoneer_Controller_Auth extends Commoneer_Controller_Template
{

	/**
	 * @var string The template for the login view
	 */
	public $template = 'templates/public/auth';

	/**
	 * @var string The URL to redirect to after successful authentication
	 */
	public $dash = 'dash';


	/**
	 * The login view for unauthenticated users
	 */
	public function action_index()
	{
		// Don't allow already authenticated users access to this page
		if (Auth::instance()->logged_in()) {
			$this->request->redirect('');
		}
	}

	/**
	 * Shows the login page and handles login
	 *
	 * @return void
	 */
	public function action_login()
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
		}

		// Auth failed
		$this->request->redirect($this->_login_url);
	}

	/**
	 * Logout the user and redirect
	 */
	public function action_logout()
	{
		Auth::instance()->logout();
		$this->request->redirect($this->_login_url);
	}

}