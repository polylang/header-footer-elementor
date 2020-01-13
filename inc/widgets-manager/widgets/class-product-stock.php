<?php
/**
 * Elementor Classes.
 *
 * @package header-footer-elementor
 */

namespace HFE\WidgetsManager\Widgets;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Widget_Base;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Scheme_Color;


if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

/**
 * HFE Product Stock
 *
 * HFE widget for Product Stock.
 *
 * @since x.x.x
 */
class Product_Stock extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since x.x.x
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'product-stock';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since x.x.x
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Product Stock', 'header-footer-elementor' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since x.x.x
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fas fa-search';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since x.x.x
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'hfe-widgets' ];
	}

	/**
	 * Register site title controls controls.
	 *
	 * @since x.x.x
	 * @access protected
	 */
	protected function _register_controls() {

		$this->register_general_content_controls();
		$this->register_style_controls();
	}

	/**
	 * Registers general controls for stock status.
	 *
	 * @since x.x.x
	 * @access protected
	 */
	function register_general_content_controls() {
		$this->start_controls_section(
			'section_general_fields',
			[
				'label' => __( 'Stock Status', 'header-footer-elementor' ),
			]
		);

		$this->add_control(
			'custom_text',
			[
				'label'        => __( 'Custom Stock Text', 'header-footer-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'header-footer-elementor' ),
				'label_off'    => __( 'Hide', 'header-footer-elementor' ),
				'default'      => 'no',
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'custom_stock',
			[
				'label'     => __( 'Stock Text', 'header-footer-elementor' ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => [
					'active' => true,
				],
				'condition' => [
					'custom_text' => 'yes',
				],
			]
		);

		$this->add_control(
			'custom_out_of_stock',
			[
				'label'     => __( 'Out Of Stock Text', 'header-footer-elementor' ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => [
					'active' => true,
				],
				'condition' => [
					'custom_text' => 'yes',
				],
			]
		);

		$this->add_control(
			'custom_on_backorder',
			[
				'label'     => __( 'On Backorder Text', 'header-footer-elementor' ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => [
					'active' => true,
				],
				'condition' => [
					'custom_text' => 'yes',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Registers styling controls for stock status.
	 *
	 * @since x.x.x
	 * @access protected
	 */
	function register_style_controls() {

		$this->start_controls_section(
			'section_product_stock_style',
			[
				'label' => __( 'Style', 'header-footer-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'Color_heading',
			[
				'label'     => __( 'Color', 'uael' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'instock_text_color',
			[
				'label'     => __( 'Stock/On Backorder Color', 'header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hfe-product-stock .stock' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'outofstock_text_color',
			[
				'label'     => __( 'Out Of Stock Color', 'header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hfe-product-stock .out-of-stock' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'text_typography',
				'label'    => __( 'Typography', 'header-footer-elementor' ),
				'selector' => '{{WRAPPER}} .hfe-product-stock',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since x.x.x
	 *
	 * @access protected
	 */
	function render() {

		global $product;

		if ( empty( $product ) || ! $product->is_visible() ) {
			return;
		}

		$settings     = $this->get_settings_for_display();
		$post_id      = $product->get_id();
		$stock_status = get_post_meta( $post_id, '_stock_status', true );

		?>
		<div class="hfe-product-stock">
			<?php
			if ( 'instock' === $stock_status ) {
				$stock_status_str_one = ucfirst( substr( $stock_status, 0, 2 ) );
				$stock_status_str_two = substr( $stock_status, 2, strlen( $stock_status ) );
				?>
					<div class="hfe-in-stock stock">
						<?php
						if ( 'yes' === $settings['custom_text'] && '' !== $settings['custom_stock'] ) {
							echo wp_kses_post( $settings['custom_stock'] );
						} else {
							echo esc_attr( $stock_status_str_one ) . ' ' . esc_attr( $stock_status_str_two );
						}
						?>
					</div>
			<?php } ?> 
			<?php
			if ( 'outofstock' === $stock_status ) {
				$stock_status_str_one   = ucfirst( substr( $stock_status, 0, 3 ) );
				$stock_status_str_two   = substr( $stock_status, 3, 2 );
				$stock_status_str_three = substr( $stock_status, 5, 5 );
				?>
					<div class="hfe-out-of-stock out-of-stock">
						<?php
						if ( 'yes' === $settings['custom_text'] && '' !== $settings['custom_stock'] ) {
							echo wp_kses_post( $settings['custom_out_of_stock'] );
						} else {

							echo esc_attr( $stock_status_str_one ) . ' ' . esc_attr( $stock_status_str_two ) . ' ' . esc_attr( $stock_status_str_three );
						}
						?>
					</div>
			<?php } ?> 
			<?php
			if ( 'onbackorder' === $stock_status ) {
				$stock_status_str_one = 'Available on backorder';
				?>
					<div class="hfe-on-backorder stock">
						<?php echo wp_kses_post( $stock_status_str_one ); ?>
						<?php
						if ( 'yes' === $settings['custom_text'] && '' !== $settings['custom_stock'] ) {
							echo $settings['custom_on_backorder'];
						} else {
							echo esc_attr( $stock_status_str_one ) . ' ' . esc_attr( $stock_status_str_two ) . ' ' . esc_attr( $stock_status_str_three );
						}
						?>
					</div>
			<?php } ?> 		 	
		</div>
		<?php
	}
}
