<?php
/** 
*Plugin Name: Hide Flat Rate WoocCommerce Addon
*Plugin URI: https://github.com/MatildadDS?tab=repositories
*Description: Par défaut, WooCommerce affiche toutes les méthodes d'expédition qui correspondent au contenu du panier. Cela signifie que la livraison gratuite est affichée avec le tarif forfaitaire. Ceci peut prêter à confusion. Développement d'une extension WordPress qui permettera de masquer toutes les autres méthodes et d'afficher uniquement la livraison gratuite, si cette dernière s'applique au panier.
*Author: Madd DS
*Version: 1.0
*Author URI: https://github.com/MatildadDS?tab=repositories
*/

function my_hide_shipping_when_free_is_available( $rates ) {
	$free = array();
	foreach ( $rates as $rate_id => $rate ) {
		if ( 'free_shipping' === $rate->method_id ) {
			$free[ $rate_id ] = $rate;
			break;
		}
	}
	return ! empty( $free ) ? $free : $rates;
}
add_filter( 'woocommerce_package_rates', 'my_hide_shipping_when_free_is_available', 100 );

