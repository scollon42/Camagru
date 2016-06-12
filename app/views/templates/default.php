<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Camagru</title>
		<!-- TMP -->
		<style>
			input {
				width: 100%;
				padding: 12px 20px;
				margin: 8px 0;
				box-sizing: border-box;
			}
			input:focus {
				background-color: lightblue;
				border: 3px solid #555
			}

			button {
				width: 100%;
				background-color: #4CAF50;
    			border: none;
    			color: white;
    			padding: 16px 32px;
    			text-decoration: none;
    			margin: 4px 2px;
    			cursor: pointer;
			}

			button:hover {
				background-color: #4ce652;
			}

			#destroy {
				background-color: #cd1212;
			}

			#destroy:hover {
				background-color: #ff0303;
			}

			#global {
				width: 70%;
				margin-left: 15%
			}

		</style>
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
					<li><a href="Logout">Logout</a></li>
				<?php endif; ?>
			</ul>
		</nav>
		<hr>
		<!-- Page content -->
		<div id='global'>
			<?php echo $content; ?>
		</div>
	</body>
</html>
