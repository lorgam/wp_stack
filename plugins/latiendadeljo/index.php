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
  add_action('astra_header_after', 'jo_header_after');
}

function load_elementor_widget() {
  require_once('classes/class.categories-elementor.php');
  require_once('classes/class.last-products-elementor.php');
}

function enqueue_jo_scripts() {
  wp_enqueue_style('latiendadeljo', plugins_url('styles.css', __FILE__), false);
}

function jo_header_after() {
    $categories = get_terms( ['taxonomy' => 'product_cat' ] );

    if (!empty($categories)): ?>
      <div class="jo-categories-container">
        <div class="jo-categories-main">

        <?php foreach ($categories as $category):
          $thumbnail = get_term_meta( $category->term_id, 'thumbnail_id', true );
          $img = wp_get_attachment_url( $thumbnail ); ?>

          <div class="category">
            <a href="<?= get_term_link($category->term_id) ?>" class="cat-link">
              <div class="img" style="background-image:url(<?= $img ?>)"></div>
              <span class="name"><?= $category->name ?></span>
            </a>
          </div>

        <?php endforeach; ?>
        </div>
      </div>

    <?php endif;
  }
