<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Basic CRUD interface
 * @since 1.2
 * @package Commoneer
 * @category Controller
 * @author Ando Roots 2011
 */
interface Controller_Interface_Crud
{

	/**
	 * @abstract
	 * @return void
	 */
	public function action_read();

	/**
	 * Also contains action_create
	 * @abstract
	 * @return void
	 */
	public function action_update();

	/**
	 * @abstract
	 * @return void
	 */
	public function action_delete();
}