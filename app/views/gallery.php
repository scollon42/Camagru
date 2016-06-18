<head>
	<link rel="stylesheet" href="/app/views/resources/style/gallery-style.css" />
</head>

<section>
	<h3>This is the gallery of the site !</h3>
	<hr>
	<div id='gallery-content'>
	<?php if (empty($galley)): ?>
		<p>No photos yet :( !</p>
	<?php else: ?>
		<?php foreach ($gallery as $image): ?>
			<div id='gallery-image'>
				<a href="/gallery/<?= $image['id']; ?>">
					<img  src="<?= $image['imagepath'] . '/' . $image['name']; ?>"/>
				</a>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
	</div>
	<center>
		<!-- The pager will generate the pagination HTML -->
		<?php $pager->pagination(); ?>
	</center>
</section>
