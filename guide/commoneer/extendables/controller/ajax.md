# The AJAX Controller

Extend the `Controller_Ajax` to inherit useful resources for handling AJAX queries.
The Ajax controller extends `Commoneer_Controller_Template`.

# Example controller

    class Controller_Post extends Controller_Ajax
	{
		// Require login
		public function before()
		{
			$this->require_login(TRUE);
			parent::before();
		}

		// Make a new post (this is an endpoint to an AJAX query)
		public function action_make() {

			// Do something with the incoming data
			Model_Post::make($this->request->post());

			// Echo the AJAX response and exit. The output from this will be as follows:
			// {"status":200,"response":'New post saved!'}
			$this->respond(parent::STATUS_OK, __('New post saved!'));
		}
	}

# Behaviour

`$this->respond()` has two formats, the main one takes a single associative array as an input and echoes the corresponding JSON output.
There's also a shorthand: status constant (see the API documentation) as the first and a message for the 2nd parameter.

The output usually includes 2 "mandatory" fields: _status_ and _response_. That behaviour can be disabled by setting `$this->_bare = TRUE;`.

# Invocation Examples
	$this->respond(parent::STATUS_ERROR, 'Something went wrong!');

	$this->respond(array('status' => parent::STATUS_UNAUTHORIZED, 'action_performed' => 'post');
