<head>
	<link rel="stylesheet" href="/app/views/resources/style/home-style.css" />
</head>


<div class="home-banner1">
	<p>Share your imagination...</p>
</div>

<section>
<div class='home-content'>
	<div>
		<img src='/app/views/resources/img/home-image-lion.jpg'/>
		<p>Take it !</p>
	</div>
	<div>
		<img src='/app/views/resources/img/home-image-lion2.jpg'/>
		<p>Change it !</p>
	</div>
	<div>
		<img src='/app/views/resources/img/home-social-network.jpg'/>
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
	<?php foreach ($gallery as $image): ?>
		<div>
			<a href="/gallery/<?= $image['id']; ?>">
				<img style="border-radius: 0" src="<?= $image['imagepath'] . '/' . $image['name']; ?>"/>
			</a>
			
		</div>
	<?php endforeach; ?>
</div>
<p style='width:20%;margin: 0 auto;'><a href='/gallery'><button style='width:100%'>Show the gallery !</button></a></p>

<hr />
<? if (!\App\App::isAuth()): ?>
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
<? endif; ?>
<hr />
</session>
