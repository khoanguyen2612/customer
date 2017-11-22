
<!DOCTYPE html>
    <html>

    <head>
        <title>Đăng nhập</title>

        <?php echo $this->html->meta('icon',
            'vtc-logo.png',
            array('type' => 'icon'));
        ?>
        <?php echo $this->Html->charset() . "\n"; ?>
        <?php
        echo $this->Html->meta(array('http-equiv' => 'X-UA-Compatible', 'content' => 'IE=edge,chrome=1'));
        echo $this->Html->meta(array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1.0'));
        echo $this->Html->css('bootstrap.min.css') . "\n";
        echo $this->Html->script('jquery.min.js') . "\n";
        echo $this->Html->script('bootstrap.min.js') . "\n";
        echo $this->Html->css('login') . "\n";
        ?>

    </head>

<body>
	<div class="header">
		<!-- <img src="img/vtc-logo.png"> -->
		<?php echo $this->Html->image('vtc-logo.png'); ?>
	</div>
	<?php echo $this->fetch('content'); ?>

    <?php echo $this->fetch('script'); ?>

</body>
</html>