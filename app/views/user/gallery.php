<section>
	<h3>This is the gallery of the site !</h3>
	<hr>
	<div style="background-color: rgba(198, 198, 198, 0.59); width:100% ; margin: 0 auto; padding: auto;text-align:center;">
	<?php foreach ($gallery as $image) { ?>
		<div style="margin: 1px auto;width:30% ; display:inline-block ; padding: 2px">
			<a href="/gallery/<?= $image['id']; ?>">
				<img style="width: 100%" src="<?= $image['image_path'] . '/' . $image['name']; ?>"/>
			</a>
			<p style="float:right"><img style="width:20px;margin-right:5px"src="http://www.aguainmaculada.com/path/official-facebook-logo-like.png"/><?php echo $image['image_like']; ?></p>
		</div>
	<?php } ?>
	</div>
	<center>
		<?php $pager->pagination(); ?>
	</center>
</section>
