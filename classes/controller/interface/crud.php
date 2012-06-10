<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Basic CRUD interface
 *
 * @since 1.2
 * @package Commoneer
 * @category Controller
 * @author Ando Roots <anroots@itcollege.ee>
 */
interface Controller_Interface_Crud {

	/**
	 * @abstract
	 * @return void
	 */
	public function action_read();

	/**
	 * Also contains action_create
	 *
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