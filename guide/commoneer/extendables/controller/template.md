# Commoneer Template Controller

The Commoneer template controller makes it convenient to use Convention Over Configuration views, set authentication requirement and access common properties.

# Views

Commoneer assumes that most of the time, each controller action has a corresponding view file.

	class Controller_Pet extends Commoneer_Controller_Template {
		public function action_dog() {}
	}

...would have a view `APPPATH.'views/pet/dog.php`. Normally, you'd have to do something like `$this->template->content = View::factory('pet/dog');` to achieve this; Commoneer does that automatically for every action of child controller.

Additionally, `$this->template->content` is mapped to `$this->content` (`NULL` if no view is found) and `$this->template->title` is automatically loaded from `Kohana::$config->load('app.title');`

# Login

To set / unset the login requirement (using the Auth module), call `$this->require_login(TRUE);` in `before()` - before calling `parent::before();`.
If login is required and the user is not logged in, (s)he will be redirected to `$this->_login_url` (_public_ by default).

	class Controller_Pet extends Commoneer_Controller_Template {
		public function before() {
			$this->require_login(TRUE);
			parent::before();
		}
	}

# ORM auto-loading

Set `$_orm_name` value to the name of the ORM model and the controller automatically loads and assigns it to `$this->_orm`,
additionally, the model is bount to `$this->template->content->{$_orm_name}`.