# Notify Implementation Guide



### In the application

Notify can be called at any time when the user needs to be aware of something.

	Notify::msg('The email was successfully sent','success');
	
### In the view

Notify is better called inside the view of your project. Since Notify has it's own view, it 
can be configured to look just like your project, or to display something if there are no messages.

	<?php Notify::render(); ?>




### In your modules

If you are creating a module that sends messages to be later displayed, Notify could be the best way to deliver those messages.
the following should be the best practice of implementing Notify:

1) In your configuration file, allow the configuration of the message types that you will throwing:

	// Notify
	'notify' 						=> TRUE, // Use notify module
	'notify_type_on_message'		=> 'default',
	'notify_type_on_error'			=> 'error',


2) Additionally, if you have a special rendering inside the module, your configuration file should:

* Give the choice to disable your rendering of the notify object, so they can render them all later on. 
* Allow the setting of the Notify view
	

Example of a configuration group:

	// Notify
	'notify'							=> array
	(
	
		// Catch errors using Notify (Use Notify module)
		'enabled'						=> TRUE,
	
		// Render notifications? If FALSE, no notifications will be displayed, but all
		// are kept in the Notify object
		'render'						=> TRUE,
	
		// Notify View
		'view'							=> 'notify/notify',
	
		// Type of expected errors
		message_types					=> array
		(
			'information'				=> 'default',
			'general_error'				=> 'error',
			'error_on_creation'			=> 'warning',
			'success'					=> 'default',

		),
	),

