<section>
	<h3>This is the gallery of the site !</h3>
	<hr>
	<div style="background-color: rgba(198, 198, 198, 0.59); width:100% ; margin: 0 auto; padding: auto;text-align:center;">
	<?php foreach ($gallery as $image) { ?>
		<div style="margin: 1px auto;width:30% ; display:inline-block ; padding: 2px">
			<a href="/gallery/<?php echo $image['id']; ?>">
				<img style="width: 100%" src="<?php echo $image['image_path'] . '/' . $image['name']; ?>"/>
			</a>
			<p style="float:right"><img style="width:20px;margin-right:5px"src="http://www.aguainmaculada.com/path/official-facebook-logo-like.png"/><?php echo $image['image_like']; ?></p>
		</div>
	<?php } ?>
	</div>
	<center>
	<ul class='pagination'>
			<?php
				$prev = ($cpage - 1) <= 0 ? false : ($cpage - 1);
				$next = ($cpage + 1) > $nbpage ? false : ($cpage + 1);
				if ($prev)
					echo "<li><a class='none' href='/gallery?p=" . $prev . "'> << </a></li>";
				for ($i = 1 ; $i <= $nbpage ; $i++) {
					if ($i == $cpage)
						$class = 'active';
					else
						$class = 'none';
					echo "<li><a class='$class' href='/gallery?p=$i'>$i</a></li>";
				}
				if ($next)
					echo "<li><a class='none' href='/gallery?p=" . $next . "'> >> </a></li>";
			?>
	</ul>
	</center>
</section>
