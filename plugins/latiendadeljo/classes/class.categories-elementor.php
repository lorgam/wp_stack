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
    echo '<div>La tienda del Jo</div>';
  }

}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor_Categories_Jo_Widget);
