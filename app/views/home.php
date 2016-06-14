
<div class="home-banner1">
	<p>Share your imagination...</p>
</div>

<section>
<div class='home-content'>
	<div>
		<img src='http://www.rajnikantvscidjokes.in/wp-content/uploads/2015/07/Q6S8rOv.jpg'/>
		<p>Take it !</p>
	</div>
	<div>
		<img src='/app/views/toto.jpg'/>
		<p>Change it !</p>
	</div>
	<div>
		<img src='http://www.ehulool.com/wp-content/uploads/2012/07/Social-Media-Icons1.png'/>
		<p>Share it!</p>
	</div>
</div>
</section>

<div class="home-banner2">
	<p>Best way to know your friends !</p>
</div>

<section>
<h1>Last pictures added :</h1>
<div class='home-content'>
	<?php foreach ($gallery as $image) { ?>
		<div>
			<a href="/gallery/<?php echo $image['id']; ?>">
				<img style="border-radius: 0" src="<?php echo $image['image_path'] . '/' . $image['name']; ?>"/>
			</a>
			<p style="float:right"><img style="width:20px;margin-right:5px;border-radius:0 ;box-shadow:none"src="http://www.aguainmaculada.com/path/official-facebook-logo-like.png"/><?php echo $image['image_like']; ?></p>
		</div>
	<?php } ?>
</div>

<hr />
<div class='home-content'>
	<h3>Not one of us ? Sign up !</h3>
	<form method='post' action="/signup">
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
</div>
<hr />
</session>
