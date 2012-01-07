# Notify Usage

### Adding a Message

Being a singleton, you can add a new message at any moment (in any controller, module or view) by calling Notify::msg

	Notify::msg('This is a message');

The previous example will be set as a message type 'default'. You can specify the message type by assigning it as the second argument.

	Notify::msg('The email was successfully sent','success');
	Notify::msg('The email entered is not valid','error');


### Rendering Messages

Rendering all messages.

	Notify::render();

Rendering all messages of type 'error'.

	Notify::render('error');
	
### Changing the default message type

Notify will change the default message type for all the messages that are added **AFTER** Notify::default_message_type is called.
Notify::restore_default_message_type() will restore the default message type to the one set on the config file.

	// The following message will be type 'default'
	Notify::msg('The astronauts are entering the spaceship');
	
	// Change default message type
	Notify::default_message_type('warning');
	
	// The following message will be type 'warning'
	Notify::msg('The spaceship fuel is low');
	
	// The following message will be type 'alert'
	Notify::msg('The spaceship is about to explode!','alert');
	
	// The following message will be type 'warning'
	Notify::msg('The weather today is nice');
	
	// Restore the default message type
	Notify::restore_default_message_type()
	
	// The following message will be type 'default'
	Notify::msg('The weather today is cool');


Notify does accept an array of messages as the argument:

	Notify::msg(array('The weather today is cool', 'and you should get an tan'));


### Counting messages

Notify::count($msg_type) returns the number of messages stored of type $msg_type. Do not set $msg_type for a count of all messages

	
	Notify::msg('a message','default');
	Notify::msg('a message','default');
	Notify::msg('a message','warning');	
	
	// Return the number of messages
	echo Notify::count(); // 3
	
	// Return the number of messages of type 'default'
	echo Notify::count('default'); // 2

	// Return the number of messages of type 'warning'
	echo Notify::count('warning'); // 1

	// Return the number of messages of type 'kohana'
	echo Notify::count('kohana'); // 0


### Persistent Messages

Persistent messages are useful for displaying notices after a redirect. This messages are stored in a session, and will be retrieved on the next render() called, even if it's on another request (a different page). Once they are displayed via render, all messages in the session are deleted.
The default value of this behavior is set in the config file:

		
	// By default, should notify always create 
	// persistent messages (via session)?
	'persistent_messages'	=> FALSE,

Similarly to the default message type, Notify will change the default value for the use of persistent messages, and will add to a session all the messages that are added **AFTER** Notify::persistent_messages is called.
Notify::restore_persistent_messages() will restore the default message type to the one set on the config file.

	// The following message will be type persistent or not persistent as config file says
	Notify::msg('The astronauts are entering the spaceship');
	
	// Change default
	Notify::persistent_messages(TRUE);
	
	// The following will be stored in a session
	Notify::msg('The spaceship fuel is low');
	
	// Change default
	Notify::persistent_messages(FALSE;

	// This message will NOT be stored in the session
	Notify::msg('The spaceship is about to explode!','alert');


If you require a single message to be persistent, without calling Notify::persistent_messages(TRUE); you can add the parameter when calling the msg() method. Asuming that on config persistent_messages = FALSE, we have that:

	Notify::msg('this is not persistent');
	
	Notify::msg('this is still not persistent','warning');
	
	Notify::msg('this IS persistent','warning', TRUE);
	
	Notify::msg('this IS persistent', NULL, TRUE);


### Changing the view

Changes the view to be used for rendering the messages.

	Notify::view('notify/admin');

It's usefull for rendering inside a controller view that needs to change the default Notify view.

	Notify::view('notify/jqueryui')->render();


### Chainable

All methods are chainable, with the exception of render() and count().

	Notify::default_message_type('warning')
		->view('notify/space_alert')
		->msg('Approaching black hole')
		->msg('Almost there')
		->msg('We are dead','failed')
		->render();


For the suggested use of Notify, please read the [Implementation Guide](notify.implementation)
