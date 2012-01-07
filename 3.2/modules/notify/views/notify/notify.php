<?php foreach ($msgs as $msg_type => $msgs_of_type): ?>
	<div>
		<b><?php echo $msg_type;?></b><br>
		<?php foreach ($msgs_of_type as $msg): ?>
			<?php echo $msg;?><br>
		<?php endforeach ?>
	</div>
<?php endforeach ?>