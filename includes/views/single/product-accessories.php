<?php

/**
 * Product accessories template
 */

?>

<div id="product-accessories">

	<?php foreach ( $accessories as $accessoryCat ) : ?>
		<?php
		$catTitle = $accessoryCat['name'];
		?>

		<?php if ( ! empty( $accessoryCat['products'] ) ) : ?>
            <div class="product-accessory" aria-expanded="true">
                <header class="product-accessory__header">
                    <h4 class="product-accessory__title" data-js="toggle-accessories" aria-expanded="false"><?php print( $catTitle ) ?></h4>
                </header>

                <ul class="accessory-list list--plain" aria-hidden="true">
					<?php

					foreach ( $accessoryCat['products'] as $product ) {

						$productInfo = [
							'name'        => $product->get_name(),
							'description' => $product->get_short_description(),
							'thumbnail'   => $product->get_image(),
							'permalink'   => $product->get_permalink(),
						];

						include 'product-accessory.php';
					}

					?>
                </ul>
            </div>
		<?php endif; ?>
	<?php endforeach; ?>
</div>
