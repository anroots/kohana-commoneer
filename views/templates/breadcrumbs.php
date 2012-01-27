<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Default breadcrumb template for HTML::breadcrumbs.
 * Tip: This template works wonders with Twitter Bootstrap 2.0
 */
 if (count($breadcrumbs)): ?>
<ul class="breadcrumb">
	<?foreach ($breadcrumbs as $i => $item): ?>
	<li<?=count($breadcrumbs) - 1 === $i ? ' class="active"' : NULL?>>
		<a href="<?=URL::base() . $item['link']?>"><?=$item['text']?></a> <span class="divider">/</span>
	</li>
	<? endforeach?>
</ul>
<? endif ?>