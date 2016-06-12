<legend>Update your password</legend>
<form method='post' action='/me/update'>
	<label for="password">New password</label>
	<input type="password" placeholder="Your password" required="Required field" name="password" />
	<label for="confirm">Confirm</label>
	<input type="password" placeholder="Confirm it" required="Required field" name="confirm" />
 	<button type="submit">Change it !</button>
</form>
<legend>Destroy your account</legend>

<a href='destroyMe'><button type='submit' id='destroy'>Destroy...</button></a>
