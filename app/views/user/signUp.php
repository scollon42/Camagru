<?php
	if ($errors == True)
		echo "<p>Something happened ! Try again...</p>";
 ?>

 <form method="post" action="signUp">
 	<label for="login">Login</label>
 	<input type="text" placeholder="Your login" required="Required field" class="form" id="login" name="login" />
 	<label for="password">Password</label>
 	<input type="password" placeholder="Your password" required="Required field" class="form" id="password" name="password" />
 	<label for="confirm">Confirm</label>
 	<input type="password" placeholder="Confirm it" required="Required field" class="form" id="confirm" name="confirm" />
 	<label for="mail">Mail</label>
 	<input type="mail" placeholder="Your@mail.ex" required="Required field" class="form" id="mail" name="mail" />
 	<button type="submit">Sign Up</button>
 </form>
