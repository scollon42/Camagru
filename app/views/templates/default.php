<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Camagru</title>
	</head>
	<body>
		<header><h1>Camagru</h1></header>
		<nav>
			<ul>
				<li><a href="/">Home</a></li>
				<?php if (!$_SESSION['connected_as']): ?>
					<li><a href="/signIn">Sign In</a></li>
					<li><a href="/signUp">Sign Up</a></li>
				<?php else: ?>
					<li><a href="/me">My account</a></li>
					<li><a href="Logout">Logout</a></li>
				<?php endif; ?>
			</ul>
		</nav>
		<!-- Page content -->
		<?php echo $content; ?>
	</body>
</html>
