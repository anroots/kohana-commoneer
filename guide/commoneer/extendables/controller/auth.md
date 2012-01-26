# The Auth Controller

Use this controller when you need a login page. Place an empty controller anywhere in your controller folder (where your routes reach it) and make it extend the `Commoneer_Controller_Auth` class.

The result is a Twitter Bootstrap styled login form (you can override the design by creating a file called `application/views/templates/public/auth.php` or by modifying the `$template` property of the extending class).

The controller displays login form via its `index` action, logs the user out via the `logout` action and tries authentication by receiving POST data to the `login` action.

Redirects are controlled via the `$dash` and `_login_url` properties.