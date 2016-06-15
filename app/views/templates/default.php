<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
	 	<link rel="stylesheet" href="/app/views/resources/style/style.css" />
		<title>Camagru</title>
		<style>
		ul.pagination {
			display: inline-block;
			list-style: none;
			padding: 0;
			margin: 0;
		}

		ul.pagination li {display: inline;}

		ul.pagination li a {
		    color: black;
		    float: left;
		    padding: 8px 16px;
			text-decoration: none;
		}

		ul.pagination li a.active {
			background-color: rgb(58, 149, 152);
			color: white;
		}


		ul.pagination li a.none:hover {
			background-color: rgb(185, 185, 185);
		}
	</style>
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
