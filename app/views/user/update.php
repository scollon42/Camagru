<section>
<h3> Hello <?php echo $user['login']; ?> !</h3>
<i>Update your account here : </i>
<div class="user-update">
	<fieldset>
	<legend>Update your password</legend>
		<form method='post' action='/me/update'>
			<label for="password">New password</label>
			<input type="password" placeholder="Your password" required="Required field" name="password" />
			<label for="confirm">Confirm</label>
			<input type="password" placeholder="Confirm it" required="Required field" name="confirm" />
 			<button type="submit">Change it !</button>
		</form>
	</fieldset>
</div>

<div class="user-update">
	<fieldset>
	<legend>Destroy your account</legend>
		<form method='post' action='/me/delete'>
			<input type="hidden" name="delete" value="true">
			<button type='submit' id='destroy' onclick="return confirm('Are you sure ?');">Destroy...</button></a>
		</form>
	</fieldset>
<div>
</section>
