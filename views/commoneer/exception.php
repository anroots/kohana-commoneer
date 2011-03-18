<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title><?=__('Error')?> :(</title>
	<!-- Original page design by Paul Irish (HTML5 Boilerplate) -->
	<style>
		body {
			text-align: center;
		}

		h1 {
			font-size: 50px;
			text-align: center
		}

		span[frown] {
			transform: rotate(90deg);
			display: inline-block;
			color: #bbb;
		}

		body {
			font: 20px Constantia, 'Hoefler Text', "Adobe Caslon Pro", Baskerville, Georgia, Times, serif;
			color: #999;
			text-shadow: 2px 2px 2px rgba(200, 200, 200, 0.5);
		}

		::-moz-selection {
			background: #FF5E99;
			color: #fff;
		}

		::selection {
			background: #FF5E99;
			color: #fff;
		}

		article {
			display: block;
			text-align: left;
			width: 600px;
			margin: 0 auto;
		}

		a {
			color: rgb(36, 109, 56);
			text-decoration: none;
		}

		a:hover {
			color: rgb(96, 73, 141);
			text-shadow: 2px 2px 2px rgba(36, 109, 56, 0.5);
		}
	</style>
</head>
<body>
<article>
	<h1><?=__('Error :code', array(':code' => $code))?> <span frown>:(</span></h1>

	<div>
		<p><?=__('Sorry, but there was an error while processing your request.')?></p>

		<? if ($message): ?>
		<p><?=$message?></p>
		<? endif ?>
		<p><a href="<?=URL::base()?>"><?=__('Home')?></a></p>
	</div>
</article>
</body>
</html>