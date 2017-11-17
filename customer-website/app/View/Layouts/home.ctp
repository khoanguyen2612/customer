<!DOCTYPE html>
<html>
<head>
	<title>VTC Cloud</title>
	<?php echo $this->html->meta('icon','vtc-logo.png',array('type' => 'icon'));?>
	<?php echo $this->Html->charset() . "\n"; ?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo $this->Html->css('bootstrap.min.css') . "\n"; ?>
	<?php echo $this->Html->script('jquery.min.js') . "\n"; ?>
	<?php echo $this->Html->script('bootstrap.min.js') . "\n"; ?>
	<?php echo $this->Html->css('customer_home.css') . "\n"; ?>
</head>
<body>
	<?php echo $this->element('header'); ?>
	<?php echo $this->fetch('content'); ?>
	<?php echo $this->element('footer'); ?>
	<?php echo $this->fetch('script'); ?>
</body>
</html>
