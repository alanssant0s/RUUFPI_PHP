<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo $this->webroot; ?>img/favicon.ico">

    <title>RU UFPI</title>
    <?php
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('signin');
	?>
  </head>

  <body>

	<?php echo $this->Session->flash(); ?>
	<?php echo $this->fetch('content'); ?>
  </body>
</html>