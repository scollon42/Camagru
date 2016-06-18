<head>
	<link rel="stylesheet" href="/app/views/resources/style/update-style.css" />
</head>
<section>
<h3> Hello <?php echo $user['login']; ?> !</h3>
<i>Update your account here : </i>
<div class="user-update">
	<fieldset>
	<legend>Update your mail</legend>
		<form method='post' action='/me'>
			<input type='hidden' name='type' value='mail' />
			<label for="mail">New mail</label>
			<input type="mail" required="Required field" name="mail" value="<?= $user['mail'] ?>"/>
			<label for="confirm">Confirm</label>
			<input type="mail" required="Required field" name="confirm" value="<?= $user['mail'] ?>"/>
 			<p style='width:20%;margin: 0 auto;'><button style='100%'type="submit">Change it</button>
		</form>
	</fieldset>
	<br />
	<br />
	<fieldset>
	<legend>Update your password</legend>
		<form method='post' action='/me'>
			<input type='hidden' name='type' value='password' />
			<label for="password">Old password</label>
			<input type="password" placeholder="Your old password" required="Required field" name="oldpassword" />
			<label for="password">New password</label>
			<input type="password" placeholder="Your new password" required="Required field" name="newpassword" />
			<label for="confirm">Confirm</label>
			<input type="password" placeholder="Confirm it" required="Required field" name="confirm" />
 			<p style='width:20%;margin: 0 auto;'><button style='100%'type="submit">Change it</button>
		</form>
	</fieldset>
</div>

<div class="user-update">
	<fieldset>
	<legend>Destroy your account</legend>
		<form method='post' action='/me/delete'>
			<input type="hidden" name="delete" value="true">
			<p style='width:20%;margin: 0 auto;'><button type='submit' id='destroy' onclick="return confirm('Are you sure ?');">Destroy...</button></a></p>
		</form>
	</fieldset>
<div>
</section>
