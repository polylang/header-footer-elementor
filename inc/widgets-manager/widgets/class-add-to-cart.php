<?php
/**
 * Elementor Classes.
 *
 * @package Header Footer Elementor
 */

namespace HFE\WidgetsManager\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Scheme_Color;
use Elementor\Widget_Button;
use Elementor\Group_Control_Background;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}
/**
 * Class Add to Cart.
 */
class Add_To_Cart extends Widget_Base {

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
		return 'add-to-cart';
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
		return __( 'Add To Cart', 'header-footer-elementor' );
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
		return 'eicon-button';
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
	 * Retrieve Button sizes.
	 *
	 * @since x.x.x
	 * @access public
	 *
	 * @return array Button Sizes.
	 */
	public static function get_button_sizes() {
		return Widget_Button::get_button_sizes();
	}

	/**
	 * Register Add To Cart controls.
	 *
	 * @since x.x.x
	 * @access protected
	 */
	protected function _register_controls() {
		/* Button Control */
		$this->register_content_button_controls();
	}

	/**
	 * Register Content Button Controls.
	 *
	 * @since x.x.x
	 * @access protected
	 */
	protected function register_content_button_controls() {
		$this->start_controls_section(
			'section_button_field',
			[
				'label' => __( 'Button', 'header-footer-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label'        => __( 'Alignment', 'header-footer-elementor' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => [
					'left'    => [
						'title' => __( 'Left', 'header-footer-elementor' ),
						'icon'  => 'fa fa-align-left',
					],
					'center'  => [
						'title' => __( 'Center', 'header-footer-elementor' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'   => [
						'title' => __( 'Right', 'header-footer-elementor' ),
						'icon'  => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'header-footer-elementor' ),
						'icon'  => 'fa fa-align-justify',
					],
				],
				'prefix_class' => 'hfe-add-to-cart%s-align-',
				'default'      => 'left',
			]
		);

		$this->add_responsive_control(
			'btn_padding',
			[
				'label'      => __( 'Padding', 'header-footer-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .cart button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		/**
		 * Register Style Button Controls.
		 *
		 * @since x.x.x
		 * @access protected
		 */
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .cart button',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
			]
		);

		$this->start_controls_tabs( 'button_tabs_style' );

		$this->start_controls_tab(
			'button_normal',
			[
				'label' => __( 'Normal', 'header-footer-elementor' ),
			]
		);

		$this->add_control(
			'button_color',
			[
				'label'     => __( 'Text Color', 'header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cart button ' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'           => 'button_background_color',
				'label'          => __( 'Background Color', 'header-footer-elementor' ),
				'types'          => [ 'classic', 'gradient' ],
				'selector'       => '{{WRAPPER}} .cart button',
				'fields_options' => [
					'color' => [
						'scheme' => [
							'type'  => Scheme_Color::get_type(),
							'value' => Scheme_Color::COLOR_4,
						],
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'button_border',
				'placeholder' => '',
				'default'     => '',
				'selector'    => '{{WRAPPER}} .cart button',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label'      => __( 'Border Radius', 'header-footer-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .cart button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .cart button',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'button_hover',
			[
				'label' => __( 'Hover', 'header-footer-elementor' ),
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label'     => __( 'Text Hover Color', 'header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cart button:focus, {{WRAPPER}} .cart button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'           => 'button_background_hover_color',
				'label'          => __( 'Background Color', 'header-footer-elementor' ),
				'types'          => [ 'classic', 'gradient' ],
				'selector'       => '{{WRAPPER}} .cart button:focus, {{WRAPPER}} .cart button:hover',
				'fields_options' => [
					'color' => [
						'scheme' => [
							'type'  => Scheme_Color::get_type(),
							'value' => Scheme_Color::COLOR_4,
						],
					],
				],
			]
		);

		$this->add_control(
			'button_border_hover_color',
			[
				'label'     => __( 'Border Hover Color', 'header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				],
				'condition' => [
					'button_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .cart button:focus, {{WRAPPER}} .cart button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => __( 'Hover Animation', 'header-footer-elementor' ),
				'type'  => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();
		$this->end_controls_section();

	}

	/**
	 * Render Add to cart output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since x.x.x
	 * @access protected
	 */
	protected function render() {

		global $product;
		$product = wc_get_product();

		if ( empty( $product ) ) {
			return;
		}
		// $settings = $this->get_settings_for_display();
		?>

		<div class="hfe-woo-atc hfe-product-<?php echo esc_attr( wc_get_product()->get_type() ); ?>">
			<?php woocommerce_template_single_add_to_cart(); ?>
		</div>
		<?php
	}

}
