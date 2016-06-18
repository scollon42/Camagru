<head>
	<link rel="stylesheet" href="/app/views/resources/style/image-style.css" />
</head>
<section>
	<h3>From <?= $user['login']; ?></h3>
	<i>posted : <?= $image['creation_date']; ?></i>
	<?php if ($user['id'] == \App\App::getSession()->connected_as): ?>
		<p><a href='#'>Delete your image</a></p>
	<?php endif; ?>
	<hr />
	<div>
		<p class='image-like'><img src="/app/views/resources/img/like.png"/><?= $image['image_like']; ?></p>
	</div>
	<div class='image-content'>
		<img src="<?= $image['imagepath'] . $image['name']; ?>" alt='photo'/>
	</div>
	<hr />

	<!-- comments section -->

	<div>
		<?php if (\App\App::isAuth()): ?>
			<h3>Add your comment :</h3>
			<form method='post' action=''>
				<input type='textarea' name='content' required/>
				<button type='submit'>Add</button>
			</form>
		<?php endif; ?>

		<h3>Comment :</h3>
		<div>
			<?php if (empty($comment)): ?>
				<p class='comment-content'>No comments yet !</p>
			<?php else: ?>
				<?php foreach ($comment as $com) { ?>
					<div class='comment'>
						<img class='comment-user-img' src='http://century21midlands.com/real_estate/images/future_agent.png'/>
						<p class='comment-user-name'><?= ucfirst($com['login']); ?> : </p>
						<?php if ($com['user_id'] == \App\App::getSession()->get('connected_as')): ?>
							<p class='comment-delete'><a href='/comments/delete/<?= $com['0']; ?>'>Delete</a></p>
						<?php endif; ?>
						<p class='comment-content'><?= $com['content']; ?></p>
						<p class='comment-date'><?= $com['creation_date']; ?></p>
					</div>
					<hr />
				<?php } ?>
			<?php endif; ?>
		</div>
	</div>
</section>
