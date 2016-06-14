<nav>
	<ul>
		<li style="background-color: #3a9598"><a href="/">Home</a></li>
		<li><a href="/gallery">Gallery</a></li>
		<?php if (!$_SESSION['connected_as']): ?>
			<li><a href="/signin">Sign in</a></li>
			<li><a href="/signup">Sign up</a></li>
		<?php else: ?>
			<li><a href="/studio">Studio</a></li>
			<li><a href="/me">My account</a></li>
			<li style="float:right; background-color: red"><a href="/me/logout">Logout</a></li>
		<?php endif; ?>
	</ul>
</nav>
