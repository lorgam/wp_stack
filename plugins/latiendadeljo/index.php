<?php
/**
 * Plugin Name: La tienda del jo
 * Description: mierdas para el jo
 * Requires at least: 5.4
 * Requires PHP: 7.0
 */


// Leer categorias de woocommerce
// Obtener nombre e imagen de la categoria
// Renderizar dentro de un bloque
// Crear css para el bloque

if (!defined('ABSPATH')) exit; // Exit if accessed directly

$active_plugins = get_option('active_plugins');
if (in_array('elementor/elementor.php', $active_plugins) && in_array('woocommerce/woocommerce.php', $active_plugins)) { // @TODO: This should be a requirement of the plugin
  add_action('init', 'load_elementor_widget');
}

function load_elementor_widget() {
  require_once('classes/class.categories-elementor.php');
}

