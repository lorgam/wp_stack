<?php
/**
 */
class Elementor_Last_Products_Jo_Widget extends \Elementor\Widget_Base {

  public function get_name() {
    return 'last_products_jo';
  }

  public function get_title() {
    return __( 'Útimos productos Jo', 'latiendadeljo' );
  }

  public function get_icon() {
    return 'fa fa-code';
  }

  public function get_categories() {
    return [ 'general' ];
  }

  protected function _register_controls() {
  }

  protected function render() {
    $args = [
      'post_type' => 'product',
      'posts_per_page' => 6,
      'order_by' => 'date',
      'order' => 'DESC'
    ];

    $query = new WP_Query($args);

    if ($query->have_posts()): ?>
      <ul class="jo-last-posts">
        <?php while ($query->have_posts()):
          $query->the_post();
          $productId = $query->post->ID;
          $product = wc_get_product($productId);
          $productLink = $product->get_permalink();
          $price = wc_get_price_to_display($product);
          $priceDisplay = ($price ? number_format($price, 2, ',', '.') . get_woocommerce_currency_symbol() : '');
          // Images of the product
          $img = $product->get_image_id();
          $img = ($img ? wp_get_attachment_image_src($img, [300, 300])[0] : wc_placeholder_img_src());
          // Add to cart
          if ($product->is_purchasable()) {
            // @TODO: Grouped products
            $addToCartLink = "?add-to-cart=$productId";
            $addToCartText = __('Añadir al carrito', 'latiendadeljo');
            $addToCartClass = "jo-add-to-cart";
          } else {
            $addToCartLink = $productLink;
            $addToCartText = __('+ Info', 'latiendadeljo');
            $addToCartClass = "jo-read-more";
          }
?>

          <li class="content">
            <a href="<?= $productLink ?>">
              <img class="img" src="<?= $img ?>" alt="<?= the_title() ?>" />
            </a>
            <h3 class="title"><?= the_title() ?></h3>
            <span class="price"><?= $priceDisplay ?></span>
            <a class="<?= $addToCartClass ?>" href="<?= $addToCartLink ?>"><?= $addToCartText ?></a>
          </li>

          <?php endwhile; ?>
      </ul>
    <?php else:
      echo __('No hay productos', 'latiendadeljo');
    endif;

    wp_reset_postdata();
  }

}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor_Last_Products_Jo_Widget);
