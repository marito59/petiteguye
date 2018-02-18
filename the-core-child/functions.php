<?php if ( ! defined( 'WP_DEBUG' ) ) {
	die( 'Direct access forbidden.' );
}

function the_core_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'the_core_theme_enqueue_styles' );

// CMA : ajoute une CSS spéciale pour l'admin afin d'afficher des logos sur des boutons dans la liste des commandes de WooCommerce
function change_admin_css() {
	wp_enqueue_style( 'add-extra-admin-stylesheet', get_stylesheet_directory_uri() . '/css/adminstyle.css' );
}
	
if (is_admin()) {
	add_action( 'admin_enqueue_scripts', 'change_admin_css');
}
	


if (class_exists('Woocommerce')) { 	
	function cma_init_woo_actions() {
		function go_hooks() {
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
		}
		

		go_hooks();
			
	}

	add_action( 'wp', 'cma_init_woo_actions' , 10);
}