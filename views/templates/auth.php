<?php defined('SYSPATH') or die('No direct script access.')?><!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><?=$title?></title>
	<meta name="description" content="<?=Kohana::$config->load('app.description')?>">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width,initial-scale=1">

	<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.2.1/css/bootstrap-combined.min.css" rel="stylesheet">
	<style type="text/css">
		html {
			background-color: #e8e8e8
		}

		body {
			background-color: #e8e8e8
		}

		h1 {
			text-shadow: 1px 1px 3px #aaaaaa
		}

		#container {
			background-color: transparent;
			width: 30%;
			min-width: 300px;
			margin: 4% auto auto auto
		}
		header,
		#main {
			padding: 20px 20px 2px 20px;
			width: 80%;
			margin: auto;
		}

		#main {
			background: white;
			min-height: 36%;
			overflow: hidden;
			border-radius: 6px;
			-moz-border-radius: 6px;
			-webkit-border-radius: 6px;
			-webkit-box-shadow: 0 0 10px 1px #bcbcbc;
			-moz-box-shadow: 0 0 10px 1px #bcbcbc;
			box-shadow: 0 0 10px 1px #bcbcbc
		}

		footer {
			text-align: center;
			font-size: 10px;
			color: #777;
			margin-top: 2%;
			border-top-width: 0
		}
	</style>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.0.6/modernizr.min.js"></script>
</head>
<body>

<div id="container">
	<header>
		<h1><?=Kohana::$config->load('app.title')?></h1>
	</header>

	<div id="main" role="main">
		<?=Notify::render()?>

		<p><?=__('commoneer.auth.intro')?></p>

		<form action="" method="post" id="login-form" class="form-stacked">
			<div class="control-group">
				<label for="user"><?=__('commoneer.auth.username')?>:</label>

				<div class="controls">
					<input type="text" id="user" placeholder="<?=__("form.general.placeholder")?>"
						   maxlength="255" name="user" class="input-xlarge" autofocus required/>
				</div>
			</div>

			<div class="control-group">
				<label for="pass"><?=__('commoneer.auth.password')?>:</label>

				<div class="controls">
					<input type="password" placeholder="<?=__("form.general.placeholder")?>" maxlength="255"
						   name="pass" id="pass" class="input-xlarge" required/>
				</div>
			</div>
			<input type="submit" class="btn btn-large btn-block btn-primary" name="login" value="<?=__('Login')?>"/>
		</form>
	</div>

	<footer>
		<?=__(
		"commoneer.auth.version",
		[
			':codename' => Kohana::$config->load('app.codename'),
			':version'  => Kohana::$config->load('app.version')
		]
	)?>
	</footer>
</div>
</body>
</html>