<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Modulename extends Controller {

	public function action_index()
	{
                // Say hi!
		$this->response->body('hello, module!');
	}

} // End Welcome
