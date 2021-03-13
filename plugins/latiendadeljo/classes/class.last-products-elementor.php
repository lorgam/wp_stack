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
      'order' => DESC
    ];

    $query = new WP_Query($args);

    if ($query->have_posts()): ?>
      <div class="jo-last-posts">
        <?php while ($query->have_posts()):
          $query->the_post();
          $product = wc_get_product($query->post->ID);
          $img = $product->get_image_id();
          $img = ($img ? wp_get_attachment_image_src($img)[0] : wc_placeholder_img_src()); ?>

          <div class="content">
            <a href="<?= the_permalink() ?>">
              <div class="img" style="background-image:url(<?= $img ?>)"></div>
              <span class="title"><?= the_title() ?></span>
            </a>
          </div>

          <?php
          /*echo the_permalink();
          echo '<br>';
          //var_dump($query->post);
          //var_dump(get_post_custom());
          echo '<br>';
          echo '<br>';*/
        endwhile; ?>
      </div>
    <?php else:
      echo __('No hay productos', 'latiendadeljo');
    endif;

    wp_reset_postdata();
  }

}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor_Last_Products_Jo_Widget);
