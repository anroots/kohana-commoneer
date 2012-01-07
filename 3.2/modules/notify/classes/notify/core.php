<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Stores messages of different types, and being a singleton it can be called
 * in any place of the code, collect all the messages and later render them
 * with a unified look.
 *
 * 
 * @package    Notify
 * @author     Ricardo de Luna <kaltar@kaltar.org>
 * @copyright  (c) 2010 Ricardo de Luna
 *
 */
class Notify_Core
{
	/**
	 * Singleton static instance
	 * 
 	 * (default value: NULL)
 	 *
	 * @var mixed
	 * @access protected
	 */
	protected static $instance				= NULL;

	/**
	 * 2-D Array storing message type($key) and messages ($value = array)
	 * 
	 * @var array
	 * @access protected
	 */
	protected static $msgs					= array(); 

	/**
	 * Stores the view to render the notices
	 * 
	 * (default value: NULL)
	 * 
	 * @var string
	 * @access protected
	 */
	protected static $view					= NULL;

	/**
	 * Stores if should always use persistent messages
	 * 
	 * (default value: NULL)
	 * 
	 * @var boolean
	 * @access protected
	 */
	protected static $persistent_messages	= NULL;

	/**
	 * Stores the session name to store persistent messages
	 * 
	 * (default value: NULL)
	 * 
	 * @var string
	 * @access protected
	 */
	protected static $session_name			= NULL;

	/**
	 * Stores the default message type
	 * 
	 * (default value: NULL)
	 * 
	 * @var string
	 * @access protected
	 */
	protected static $default_message_type	= NULL;
	
	/**
	 * Stores the message in an array
	 * 
	 * @access public
	 * @static
	 * @param string or array $msgs 
	 * @param string $type. (default: 'information')
	 * @return chainable
	 */
	public static function msg($msgs, $type = NULL, $session = FALSE)
	{
		// If we receive a message with no type
		if (is_null($type))
		{
			// If we haven't assigned a default message type
			if (is_null(self::$default_message_type))
			{
				// Get value from config file
				self::$default_message_type = trim(Kohana::$config->load('notify.default_message_type'));
			}
			// Assign value
			$type = self::$default_message_type;
		}
		else
		{
			$type = trim($type);
		}
		
		// See if we do not already have a key for that type of message
		// initialize the array
		if ( ! array_key_exists($type, self::$msgs))
		{
			self::$msgs[$type] = array();
		}
		
		// make array
		if ( ! is_array($msgs))
		{
			$msgs = array($msgs);
		}
		
		// loop thru array
		foreach ($msgs as  $msg)
		{
			// Force casting and sanitizing
			$msg = trim($msg);
			
			self::$msgs[$type][] = $msg;
	
			// If we haven't assigned a value for $persistent_messages		
			if (is_null(self::$persistent_messages))
			{
				// Get value from config file
				self::restore_persistent_messages();
			}
	
			// Check if message should be stored in session.
			if (self::$persistent_messages OR $session)
			{
				// Store the message in a session for later retrieval
				self::add_message_to_session($msg, $type);
			}
		}
				
		// Make it chainable
		return self::return_instance();
	}
	
	/**
	 * Sets the persistent_messages		
	 * 
	 * @access public
	 * @static
	 * @param boolean $value (example: 'error')
	 * @return chainable
	 */
	public static function persistent_messages($value = FALSE)
	{
		self::$persistent_messages		 = $value;
		return self::return_instance();
	}

	/**
	 * Restores the persistent_messages to the configuration file
	 * 
	 * @access public
	 * @static
	 * @return chainable
	 */
	public static function restore_persistent_messages()
	{
		// Get value from config file
		self::$persistent_messages = trim(Kohana::$config->load('notify.persistent_messages'));
		return self::return_instance();
	}


	/**
	 * Sets the default message type
	 * 
	 * @access public
	 * @static
	 * @param string $view. (example: 'error')
	 * @return chainable
	 */
	public static function default_message_type($type)
	{
		self::$default_message_type = trim($type);
		return self::return_instance();
	}

	/**
	 * Restores the default message type to the configuration file
	 * 
	 * @access public
	 * @static
	 * @return chainable
	 */
	public static function restore_default_message_type()
	{
		// Get value from config file
		self::$default_message_type = trim(Kohana::$config->load('notify.default_message_type'));
		return self::return_instance();
	}
	
	/**
	 * Sets the view to use while rendering
	 * 
	 * @access public
	 * @static
	 * @param string $view. (example: 'notify/notify')
	 * @return chainable
	 */
	public static function view($view)
	{
		self::$view = trim($view);
		return self::return_instance();
	}

	/**
	 * Renders the messages in the view
	 * if $message_type is specified, will only render 
	 * the messages of the type $message_type
	 * 
	 * @access public
	 * @static
	 * @param mixed $message_type. (default: NULL)
	 * @return string
	 */
	public static function render($message_type = NULL)
	{
		// If view is not assigned, get from config file
		if (is_null(self::$view))
		{
			self::$view = Kohana::$config->load('notify.view');
		}
		
		// Merge session messages with normal ones
		self::merge_session_messages();
		
		// If it's valid $message_type received, we should only render the messages of that type
		if ( ! is_null($message_type) AND array_key_exists($message_type, self::$msgs))
		{
			$vars = array('msgs' => array($message_type => self::$msgs[$message_type]));
		}
		else
		{
			// Render all messages
			$vars = array('msgs' => self::$msgs);
		}

		// Render the view		
		$messages =  View::factory(self::$view, $vars)->render();

		// Return the rendered messages
		return $messages;
	}

	/**
	 * retrieves session name
	 *
	 */
	protected static function get_session_name()
	{
		// If we haven't assigned a default session name
		if (is_null(self::$session_name))
		{
			// Get value from config file
			self::$session_name = trim(Kohana::$config->load('notify.session_name'));
		}
		
		return self::$session_name;
	}
	
	/**
	 * Add message into session
	 *
	 */
	protected static function add_message_to_session($msg, $type)
	{
		$session_msgs = Session::instance()->get(self::get_session_name(), array());
		$session_msgs[$type][] = Kohana::$config->load('notify.translate') ? __($msg) : $msg;
		Session::instance()->set(self::get_session_name(), $session_msgs);
	}

	/**
	 * Merge session messages into the regular messages 
	 *
	 */
	protected static function merge_session_messages()
	{
		// Extract session messages
		$session_msgs = Session::instance()->get(self::get_session_name(), array());
		
		// Delete session
		Session::instance()->delete(self::get_session_name());

		foreach($session_msgs as $message_type => $msgs)
		{
			if (array_key_exists($message_type, self::$msgs))
			{
				// Merge carefully to avoid dups
				foreach($msgs as $msg)
				{
					// Search session message in regular messages.
					if( ! in_array($msg, self::$msgs[$message_type]))
					{
						self::$msgs[$message_type][] = $msg;
					}
				}
			}
			else
			{
				// plain assignment
				self::$msgs[$message_type] = $session_msgs[$message_type];
			}
		}
	}


	/**
	 * Clear all messages
	 * @todo Add type param
	 * @static
	 * @return void
	 */
	public static function clear() {
		Session::instance()->delete(self::get_session_name());
		self::$msgs = array();
	}


	/**
	 * Get the number of messages stored.
	 *
	 * @return integer
	 */
	public static function count($type = NULL)
	{
		$msg_count = 0;
		
		// If requested a especific message type.	
		if ( ! empty($type) AND array_key_exists($type, self::$msgs))
		{
			$msg_count = count(self::$msgs[$type]);
		}
		else if (empty($type))
		{
			// Get the count of all messages
			foreach (self::$msgs as $type_msgs)
			{
				$msg_count += (is_array($type_msgs) ? count($type_msgs) : 0);
			}
		}
		
		return $msg_count;
	}

	/**
	 * Get the singleton instance of Kohana_Notify.
	 *
	 * @return  Kohana_Notify
	 */
	protected static function return_instance()
	{
		if (self::$instance === NULL)
		{
			// Assign self
			self::$instance = new self;
		}

		return self::$instance;
	}
	
	final private function __construct()
	{
		// Enforce singleton behavior
	}

	final private function __clone()
	{
		// Enforce singleton behavior
	}

}

