<?php defined('SYSPATH') or die('No direct script access.')?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?=__("commoneer.error.title")?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootswatch/2.1.0/united/bootstrap.min.css"/>
	<style type="text/css">
		body {
			padding-top: 40px;
			padding-bottom: 40px;
			background-color: #f5f5f5;
		}

		.error-container {
			max-width: 500px;
			padding: 19px 29px 29px;
			margin: 0 auto 20px;
			background-color: #fff;
			border: 1px solid #e5e5e5;
			-webkit-border-radius: 5px;
			-moz-border-radius: 5px;
			border-radius: 5px;
			-webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
			-moz-box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
			box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
		}
	</style>
</head>
<body>

<div class="container">
	<form class="error-container">
		<h2>
			<?=__('commoneer.error.heading', array(':code' => $code))?>
		</h2>

		<p class="alert alert-block alert-error">
			<?=__('commoneer.error.intro')?>
		</p>

		<? if (! empty($message)): ?>
		<blockquote><?=$message?></blockquote>
		<? endif ?>

		<p>
			<a href="<?=URL::base()?>"><?=__('commoneer.error.home')?></a>
		</p>
	</form>
</div>
</body>
</html>