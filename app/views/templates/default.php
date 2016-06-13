<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
	 	<link rel="stylesheet" href="/app/views/style/style.css" />
		<title>Camagru</title>
	</head>
	<body>
		<header><h1>Camagru</h1></header>
		<nav>
			<ul>
				<li><a href="/">Home</a></li>
				<li><a href="#gallery">Gallery</a></li>
				<?php if (!$_SESSION['connected_as']): ?>
					<li><a href="/signIn">Sign In</a></li>
					<li><a href="/signUp">Sign Up</a></li>
				<?php else: ?>
					<li><a href="#studio">Studio</a></li>
					<li><a href="/me">My account</a></li>
					<li><a href="/me/logout">Logout</a></li>
				<?php endif; ?>
			</ul>
		</nav>
		<hr>
		<?php echo $flash; ?>
		<!-- Page content -->
		<div id='global'>
			<?php echo $content; ?>
		</div>
	</body>
</html>
