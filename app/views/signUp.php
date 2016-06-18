<section>
 <form method="post" action="/signup">
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
<section>
<script>

	function comparePassword() {
		var pass_1 = document.getElementById('password');
		var pass_2 = document.getElementById('confirm');

		var v1 = pass_1.value;
		var v2 = pass_2.value;

		if (v1 && v2) {
			pass_1.style.border-color = pass_2.style.border-color = (v1 === v2) ? 'green' : 'red';
		}
	}

	var pass_1 = document.getElementById('password');
	var pass_2 = document.getElementById('confirm');

	if (pass_1 && pass_2) {
		pass_1.onkeyup = pass_2.onkeyup = pass_1.onblur = pass_2.onblur = comparePassword;
	}
</script>
