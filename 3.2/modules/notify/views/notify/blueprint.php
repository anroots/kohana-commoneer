<?php foreach ($msgs as $msg_type => $msgs_of_type): ?>
	<?php 
	switch (strtolower($msg_type))
	{
		case 'error':
			$class	= 'error';
		break;
		case 'success':
			$class	= 'success';
		break;
		default:
			$class	= 'notice';
		break;
	}
	foreach($msgs_of_type as $msg):?>
		<div class="<?php echo $class; ?>"><?php echo $msg;?>.</div>
	<?php endforeach ?>
<?php endforeach ?>
