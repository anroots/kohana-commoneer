<?php defined('SYSPATH') or die('No direct script access.');

return array(
	'default_message_type'	=> 'default',
	'view'					=> 'notify/jqueryui',
	
	// By default, should notify always create 
	// persistent messages (via session)?
	'persistent_messages'	=> TRUE,
	
	// Session name for the persistent messages
	'session_name'			=> 'notify_messages',
);
