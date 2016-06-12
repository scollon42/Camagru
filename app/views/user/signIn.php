<?php
	if ($errors == True)
		echo "<p>Invalid ID ! Try again...</p>";
?>
<form action='signIn' method='post'>
	Login : <input type="text" name="login"/>
	password : <input type="password" name="password"/>
	<button type="submit" name="submit">connect</button>
</form>
