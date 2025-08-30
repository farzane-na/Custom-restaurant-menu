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
 * Requires Plugins:  elementor,woocommerce
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
function translate_plugin() {
    load_plugin_textdomain( 'farzane-widget', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}

add_action( 'plugins_loaded', 'translate_plugin' );


// Register the widget.
add_action( 'elementor/init', 'init_custom_elementor_widgets' );
function init_custom_elementor_widgets() {
    require_once __DIR__ . '/widgets/menu-items.php';

    add_action( 'elementor/widgets/widgets_registered', 'register_custom_widget_elementor' );
}
function register_custom_widget_elementor( $widgets_manager ) {
    $widgets_manager->register( new \Menu_Items_Widget() );
}