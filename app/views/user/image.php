<section>
	<h3>From <?php echo $user['login']; ?></h3>
	<i>posted : <?php echo $image['creation_date']; ?></i>
	<hr />
	<div>
		<p style="float:right"><img style="width:20px;margin-right:5px;border-radius:0 ;box-shadow:none"src="http://www.aguainmaculada.com/path/official-facebook-logo-like.png"/><?php echo $image['image_like']; ?></p>
	</div>
	<div style="width:70%;margin:0 auto;">
		<img style="width:100%"src="<?php echo $image['image_path'] . '/' . $image['name']; ?>"/>
	</div>
	<hr />
	<!-- comments section -->
	<div>
		<h3>Add your comment :</h3>
		<form method='post' action=''>
			<input type='textarea'/>
			<button type='submit'>Add</button>
		</form>
		<h3>Comment :</h3>
		<div>
			<center><p>There is no comments for now :(</p></center>
		</div>
	</div>
</section>
