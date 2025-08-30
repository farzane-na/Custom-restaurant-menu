<?php
/*
 * Plugin Name:       Custom Restaurant Menu
 * Plugin URI:        https://farzanenazmabadi.ir
 * Description:       A plugin to create a beautiful and professional restaurant menu
 * Version:           1.0.0
 * Requires PHP:      7.4
 * Author:            Farzane Nazmabadi
 * Author URI:        https://farzanenazmabadi.ir
 * Update URI:        https://github.com/farzane-na/Custom-restaurant-menu
 * Text Domain:       restaurant-menu
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Load plugin textdomain
 */
function restaurant_menu_load_textdomain() {
    load_plugin_textdomain(
        'restaurant-menu',
        false,
        dirname( plugin_basename( __FILE__ ) ) . '/languages/'
    );
}
add_action( 'init', 'restaurant_menu_load_textdomain' );

/**
 * Check dependencies: Elementor & WooCommerce
 */
function restaurant_menu_check_dependencies() {
    if ( ! did_action( 'elementor/loaded' ) || ! class_exists( 'WooCommerce' ) ) {
        add_action( 'admin_notices', function () {
            echo '<div class="notice notice-error"><p>'
                . esc_html__( 'Custom Restaurant Menu requires Elementor and WooCommerce to be installed and active.', 'restaurant-menu' )
                . '</p></div>';
        } );
        return false;
    }
    return true;
}

/**
 * Register custom Elementor widgets
 */
function restaurant_menu_register_widgets( $widgets_manager ) {
    require_once __DIR__ . '/widgets/menu-items.php';

    $widgets_manager->register( new \Menu_Items_Widget() );
}

/**
 * Init Elementor widgets
 */
function restaurant_menu_init_elementor_widgets() {
    if ( ! restaurant_menu_check_dependencies() ) {
        return;
    }

    add_action( 'elementor/widgets/register', 'restaurant_menu_register_widgets' );
}
add_action( 'elementor/init', 'restaurant_menu_init_elementor_widgets' );


deactivate_plugins( plugin_basename( __FILE__ ) );
