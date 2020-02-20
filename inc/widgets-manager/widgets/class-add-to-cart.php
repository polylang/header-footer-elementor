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
		/* Button Style */
		$this->register_style_button_controls();
	}

	/**
	 * Register Content Button Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_content_button_controls() {
		$this->start_controls_section(
			'section_button_field',
			array(
				'label' => __( 'Button', 'header-footer-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'btn_text',
			array(
				'label'   => __( 'Text', 'header-footer-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Add to cart', 'header-footer-elementor' ),
				'dynamic' => array(
					'active' => true,
				),
			)
		);

		$this->add_responsive_control(
			'align',
			array(
				'label'        => __( 'Alignment', 'header-footer-elementor' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => array(
					'left'    => array(
						'title' => __( 'Left', 'header-footer-elementor' ),
						'icon'  => 'fa fa-align-left',
					),
					'center'  => array(
						'title' => __( 'Center', 'header-footer-elementor' ),
						'icon'  => 'fa fa-align-center',
					),
					'right'   => array(
						'title' => __( 'Right', 'header-footer-elementor' ),
						'icon'  => 'fa fa-align-right',
					),
					'justify' => array(
						'title' => __( 'Justified', 'header-footer-elementor' ),
						'icon'  => 'fa fa-align-justify',
					),
				),
				'prefix_class' => 'uael-add-to-cart%s-align-',
				'default'      => 'left',
			)
		);

		$this->add_control(
			'size',
			array(
				'label' => __( 'Size', 'header-footer-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'sm',
				'options' => self::get_button_sizes(),
			)
		);

		$this->add_responsive_control(
			'btn_padding',
			array(
				'label'      => __( 'Padding', 'header-footer-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'new_btn_icon',
			array(
				'label'            => __( 'Icon', 'header-footer-elementor' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'btn_icon',
				'default'          => array(
					'value'   => 'fa fa-shopping-cart',
					'library' => 'fa-solid',
				),
			)
		);

		$this->add_control(
			'btn_icon_align',
			array(
				'label'      => __( 'Icon Position', 'uael' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'left',
				'options'    => array(
					'left'  => __( 'Before', 'uael' ),
					'right' => __( 'After', 'uael' ),
				),

			)
		);

		$this->add_control(
			'btn_icon_indent',
			array(
				'label'      => __( 'Icon Spacing', 'uael' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'max' => 50,
					),
				),
			)
		);
		$this->end_controls_section();
	}
	/**
	 * Register Style Button Controls.
	 *
	 * @since x.x.x
	 * @access protected
	 */
	protected function register_style_button_controls() {

		$this->start_controls_section(
			'section_design_button',
			array(
				'label' => __( 'Button', 'header-footer-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .uael-button',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
			)
		);

		$this->start_controls_tabs( 'button_tabs_style' );

		$this->start_controls_tab(
			'button_normal',
			array(
				'label' => __( 'Normal', 'header-footer-elementor' ),
			)
		);

		$this->add_control(
			'button_color',
			array(
				'label'     => __( 'Text Color', 'uael' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .uael-button' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'           => 'button_background_color',
				'label'          => __( 'Background Color', 'uael' ),
				'types'          => array( 'classic', 'gradient' ),
				'selector'       => '{{WRAPPER}} .uael-button',
				'fields_options' => array(
					'color' => array(
						'scheme' => array(
							'type'  => Scheme_Color::get_type(),
							'value' => Scheme_Color::COLOR_4,
						),
					),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'button_border',
				'placeholder' => '',
				'default'     => '',
				'selector'    => '{{WRAPPER}} .uael-button',
			)
		);

		$this->add_control(
			'border_radius',
			array(
				'label'      => __( 'Border Radius', 'uael' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .uael-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .uael-button',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'button_hover',
			array(
				'label' => __( 'Hover', 'uael' ),
			)
		);


		$this->add_control(
					'button_hover_color',
					array(
						'label'     => __( 'Text Hover Color', 'uael' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							'{{WRAPPER}} .uael-button:focus, {{WRAPPER}} .uael-button:hover' => 'color: {{VALUE}};',
						),
					)
				);

		$this->add_group_control(
					Group_Control_Background::get_type(),
					array(
						'name'           => 'button_background_hover_color',
						'label'          => __( 'Background Color', 'uael' ),
						'types'          => array( 'classic', 'gradient' ),
						'selector'       => '{{WRAPPER}} .uael-button:focus, {{WRAPPER}} .uael-button:hover',
						'fields_options' => array(
							'color' => array(
								'scheme' => array(
									'type'  => Scheme_Color::get_type(),
									'value' => Scheme_Color::COLOR_4,
								),
							),
						),
					)
				);

		$this->add_control(
					'button_border_hover_color',
					array(
						'label'     => __( 'Border Hover Color', 'uael' ),
						'type'      => Controls_Manager::COLOR,
						'scheme'    => array(
							'type'  => Scheme_Color::get_type(),
							'value' => Scheme_Color::COLOR_4,
						),
						'condition' => array(
							'button_border_border!' => '',
						),
						'selectors' => array(
							'{{WRAPPER}} .uael-button:focus, {{WRAPPER}} .uael-button:hover' => 'border-color: {{VALUE}};',
						),
					)
				);

		$this->add_control(
					'hover_animation',
					array(
						'label' => __( 'Hover Animation', 'uael' ),
						'type'  => Controls_Manager::HOVER_ANIMATION,
					)
				);

		$this->end_controls_tab();

	}



}