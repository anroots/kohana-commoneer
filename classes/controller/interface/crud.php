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

	public function action_show();

	public function action_edit();

	public function action_destroy();
}