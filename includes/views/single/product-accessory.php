<?php
/**
 * Template for displaying an individual product accessory on the single product page
 */
?>
<li class="single-accessory">
	<div class="single-accessory__thumbnail">
		<?php echo $productInfo['thumbnail'] ?>
	</div>
	<div class="single-accessory__description">
		<a href="<?php echo $productInfo['permalink'] ?>">
			<?php echo $productInfo['name'] ?>
		</a>
		<p>
			<?php echo $productInfo['description'] ?>
		</p>
	</div>
</li>
