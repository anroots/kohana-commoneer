<?php foreach ($msgs as $msg_type => $msgs_of_type): ?>
	<?php 
	switch (strtolower($msg_type))
	{
		case 'error':
			$class	= 'ui-state-error';
			$icon	= 'ui-icon-alert';
			$title	= 'Error';
		break;
		case 'default':
			$class	= 'ui-state-highlight';
			$icon	= 'ui-icon-info';
			$title	= 'Information';
		break;
		default:
			$class	= 'ui-state-highlight';
			$icon	= 'ui-icon-info';
			$title	= ucwords($msg_type);
		break;
	}
	?>
	<div class="<?php echo $class; ?> ui-corner-all" style="margin-bottom: 20px; padding: 10px;"> 
			<span class="ui-icon <?php echo $icon; ?>" style="float: left; margin-right: 2px;"></span>
			<div style="padding-left: 20px;">
				<strong><?php echo $title;?>:&nbsp;</strong><?php if (count($msgs_of_type) > 1): ?><br><?php endif;?>
				<?php echo implode('<br>',$msgs_of_type);?>
			</div>
	</div>
<?php endforeach ?>
