<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
	 	<link rel="stylesheet" href="/app/views/resources/style/global.css" />
		<link rel="stylesheet" href="/app/views/resources/style/flash.css" />
		<link rel="stylesheet" href="/app/views/resources/style/pagination.css" />
		
		<title>Camagru</title>
	</head>
	<body>
		<?php include (ROOT . '/app/views/includes/navigation.php'); ?>
		<!-- Page content -->
		<div id='global'>
			<?php echo $flash; ?>
			<?php echo $content; ?>
		</div>
		<footer style="padding:8px 16px">
			<p style="float:right;color:white">Scollon @ 2016</p>
		</footer>
	</body>
</html>
