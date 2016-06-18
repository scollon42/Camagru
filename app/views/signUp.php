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
			pass_1.style.color = pass_2.style.color = (v1 === v2) ? 'green' : 'red';
		}
	}

	function checkPassword(password) {
		var pass = password;
		var content = pass.value;
		var regex = new RegExp(/^\w{8,15}$/);
		
		if (content) {
			alert(content);
			pass.style.color = (regex.test(content)) ? 'green' : 'red';
		}
	}

	function checkLogin() {
		var login = document.getElementById('login');
		var content = login.value;
		var regex = new RegExp(/^\w{6,15}$/);
		
		if (content) {
			login.style.color = (regex.test(content)) ? 'green' : 'red';
		}
	}

	function checkMail() {
		var mail = document.getElementById('mail');
		var content = mail.value;
		var regex = new RegExp(/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/);
		
		if (content) {
			mail.style.color = (regex.test(content)) ? 'green' : 'red';
		}
	}
	var login = document.getElementById('login');
	var pass_1 = document.getElementById('password');
	var pass_2 = document.getElementById('confirm');
	var mail = document.getElementById('mail');

	if (login) {
		login.onkeyup = login.onblur = checkLogin;
	}

	if (pass_1) {
		pass_1.onkeyup = pass_1.onblur = checkPassword(pass_1);
	}

	if (pass_2) {
		pass_2.onkeyup = pass_2.onblur = checkPassword(pass_2);
	}

	if (pass_1 && pass_2) {
		pass_1.onkeyup = pass_2.onkeyup = pass_1.onblur = pass_2.onblur = comparePassword;
	}
	if (mail) {
		mail.onkeyup = mail.onblur = checkMail;
	}
</script>
