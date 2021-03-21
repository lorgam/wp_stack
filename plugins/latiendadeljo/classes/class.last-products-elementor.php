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
      <div class="woocommerce"><ul class="products columns-4">
        <?php while ($query->have_posts()):
          $query->the_post();
          $productId = $query->post->ID;
          $product = wc_get_product($productId);
          $productLink = $product->get_permalink();
          $price = wc_get_price_to_display($product);
          // Images of the product
          $img = $product->get_image_id();
          $img = ($img ? wp_get_attachment_image_src($img, [300, 300])[0] : wc_placeholder_img_src());
          // Add to cart
          if ($product->is_purchasable()) {
            // @TODO: Grouped products
            $addToCartLink = "?add-to-cart=$productId";
            $addToCartText = __('Añadir al carrito', 'latiendadeljo');
            $addToCartClass = "button product_type_simple add_to_cart_button ajax_add_to_cart";
          } else {
            $addToCartLink = $productLink;
            $addToCartText = __('+ Info', 'latiendadeljo');
            $addToCartClass = "button product_type_simple";
          }
?>

          <li class="ast-col-sm-12 ast-article-post product">
            <div class="astra-shop-thumbnail-wrap">
              <a href="<?= $productLink ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                <img class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" src="<?= $img ?>" alt="<?= the_title() ?>" />
              </a>
            </div>
            <div class="astra-shop-summary-wrap">
              <a href="<?= $productLink ?>" class="ast-loop-product__link">
                <h2 class="woocommerce-loop-product__title"><?= the_title() ?></h2>
              </a>
              <?php if($price): ?>
                <span class="price">
                  <span class="woocommerce-Price-amount amount">
                    <bdi>
                      <?= number_format($price, 2, ',', '.') ?>
                      <span class="woocommerce-Price-currencySymbol"><?= get_woocommerce_currency_symbol() ?></span>
                    </bdi>
                  </span>
                </span>
              <?php endif; ?>
            </div>
            <a class="<?= $addToCartClass ?>" href="<?= $addToCartLink ?>"><?= $addToCartText ?></a>
          </li>

          <?php endwhile; ?>
      </ul></div>
    <?php else:
      echo __('No hay productos', 'latiendadeljo');
    endif;

    wp_reset_postdata();
  }

}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor_Last_Products_Jo_Widget);
