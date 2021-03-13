<?php
/**
 * Plugin Name: La tienda del jo
 * Description: mierdas para el jo
 * Requires at least: 5.4
 * Requires PHP: 7.0
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

$active_plugins = get_option('active_plugins');
if (in_array('elementor/elementor.php', $active_plugins) && in_array('woocommerce/woocommerce.php', $active_plugins)) { // @TODO: This should be a requirement of the plugin
  add_action('init', 'load_elementor_widget');
  add_action('wp_enqueue_scripts', 'enqueue_jo_scripts');
}

function load_elementor_widget() {
  require_once('classes/class.categories-elementor.php');
  require_once('classes/class.last-products-elementor.php');
}

function enqueue_jo_scripts() {
  wp_enqueue_style('latiendadeljo', plugins_url('styles.css', __FILE__), false);
}

