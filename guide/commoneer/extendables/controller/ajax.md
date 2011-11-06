# AJAX Controller

Extend the `Controller_Ajax` to inherit useful resources for handling AJAX queries.
The Ajax controller extends `Commoneer_Controller_Template`.

An example controller using the Ajax functionality.

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