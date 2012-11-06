<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Basic CRUD interface
 *
 * @since 1.2
 * @package Commoneer
 * @category Controller
 * @author Ando Roots <ando@sqroot.eu>
 */
interface Controller_Interface_Crud {

	/**
	 * Display a list of resources or details about a single resource
	 * if <id> is set.
	 *
	 * @since 2.0
	 * @abstract
	 * @return void
	 */
	public function action_index();

	/**
	 * Edit or create a (new) resource
	 *
	 * @since 2.0
	 * @abstract
	 * @return void
	 */
	public function action_edit();

	/**
	 * View resource in read-only mode
	 *
	 * @return void
	 */
	public function action_view();

	/**
	 * Delete the resource
	 *
	 * @since 2.0
	 * @abstract
	 * @return void
	 */
	public function action_delete();
}