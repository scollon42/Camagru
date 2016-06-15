<section>
	<h3>From <?= $user['login']; ?></h3>
	<i>posted : <?= $image['creation_date']; ?></i>
	<hr />
	<div>
		<p style="float:right"><img style="width:20px;margin-right:5px;border-radius:0 ;box-shadow:none"src="http://www.aguainmaculada.com/path/official-facebook-logo-like.png"/><?= $image['image_like']; ?></p>
	</div>
	<div style="width:70%;margin:0 auto;">
		<img style="width:100%"src="<?= $image['image_path'] . '/' . $image['name']; ?>"/>
	</div>
	<hr />
	<!-- comments section -->

	<!-- Ugly way to do comment section but it's temporary
		 I just wanted to see how it could be work... sry  -->

	<div>
		<? if (\App\App::isAuth()): ?>
			<h3>Add your comment :</h3>
			<form method='post' action=''>
				<input type='textarea' name='content'/>
				<button type='submit'>Add</button>
			</form>
		<? endif; ?>

		<h3>Comment :</h3>
		<div>
			<? if (empty($comment)): ?>
				<p style='padding:16px 32px'>No comments yet !</p>
			<? else: ?>
				<? foreach ($comment as $com) { ?>
					<div style="box-shadow:2px 2px 2px black;background-color:rgba(168, 231, 222, 0.59);padding:4px 8px;border-radius:5px;">
						<img style='width:60px;display:inline;margin:10px' src='http://century21midlands.com/real_estate/images/future_agent.png'/>
						<p style='font-size:20px;display:inline'><?= ucfirst($com['login']); ?> : </p>
						<? if ($com['user_id'] == $_SESSION['connected_as']): ?>
							<p style='font-size:13px;text-align: right'><a href='/comments/delete/<?= $com['0']; ?>'>Delete</a></p>
						<? endif; ?>
						<p style='padding:16px 32px'><?= $com['content']; ?></p>
						<p style='font-size:13px;text-align: right'><?= $com['creation_date']; ?></p>
					</div>
					<hr />
				<? } ?>
			<? endif; ?>
		</div>
	</div>
</section>
