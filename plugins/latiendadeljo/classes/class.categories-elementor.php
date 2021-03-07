<?php
/**
 */
class Elementor_Categories_Jo_Widget extends \Elementor\Widget_Base {

  public function get_name() {
    return 'categories_jo';
  }

  public function get_title() {
    return __( 'Menú categorías Jo', 'latiendadeljo' );
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
    $categories = get_terms( ['taxonomy' => 'product_cat' ] ); // @TODO: Hide empty on control

    if (!empty($categories)): ?>
      <div class="jo-categories-main">

      <?php foreach ($categories as $category):
        $thumbnail = get_term_meta( $category->term_id, 'thumbnail_id', true );
        $img = wp_get_attachment_url( $thumbnail ); ?>

        <div class="category" style="background-image:url(<?= $img ?>)">
          <span class="name"><?= $category->name ?></span>
        </div>

      <?php endforeach; ?>
      </div>

    <?php endif;
  }

}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor_Categories_Jo_Widget);
