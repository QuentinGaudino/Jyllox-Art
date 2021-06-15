<?php
//Ce fichier viens écraser le fichier WooCommerce originel afin de modifier l'affichage d'un produit

/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
?>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

		<span class="sku_wrapper"><?php esc_html_e( 'SKU:', 'woocommerce' ); ?> <span class="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></span></span>

	<?php endif; ?>

	<?php echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>

	<?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>


	<!-- Affichage du nom de l'artiste-->

	<?php $direct_results = carbon_get_post_meta( get_the_ID(), 'crb_association' ); ?>
	<?php $id_artist = $direct_results[0]['id']; ?>
	<?php $name_artist = get_post($id_artist)->post_title; ?>
	<?php $url_artist = get_post($id_artist)->guid ?>
	
	<?php if ($name_artist) : ?>
	
		<p>Artiste: <a href="<?= $url_artist ?>"><?= $name_artist ?></a></p>

	<?php else: ?>
		<p>Artiste inconnu</p>
	<?php endif ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>