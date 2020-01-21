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
 * HFE Product Meta.
 *
 * HFE widget for Product Meta.
 *
 * @since x.x.x
 */
class Product_Meta extends Widget_Base {

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
		return 'hfe-product-meta';
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
		return __( 'Product Meta', 'header-footer-elementor' );
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
	 * Register Product Meta General Controls.
	 *
	 * @since x.x.x
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_product_meta_style',
			[
				'label' => __( 'Style', 'header-footer-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'view',
			[
				'label'        => __( 'View', 'header-footer-elementor' ),
				'type'         => Controls_Manager::SELECT,
				'label_block'  => false,
				'default'      => 'inline',
				'options'      => [
					'table'   => __( 'Table', 'header-footer-elementor' ),
					'stacked' => __( 'Stacked', 'header-footer-elementor' ),
					'inline'  => __( 'Inline', 'header-footer-elementor' ),
				],
				'prefix_class' => 'product-meta-view-',
			]
		);
		$this->add_responsive_control(
			'space_between',
			[
				'label'     => __( 'Space Between', 'header-footer-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}}:not(.product-meta-view-inline) .hfe-product-meta .hfe-detail-container:not(:last-child)' => 'padding-bottom: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}}:not(.product-meta-view-inline) .hfe-product-meta  .hfe-detail-container:not(:first-child)' => 'margin-top: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}}.product-meta-view-inline .hfe-product-meta  .hfe-detail-container' => 'margin-right: calc({{SIZE}}{{UNIT}}/2); margin-left: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}}.product-meta-view-inline .hfe-product-meta ' => 'margin-right: calc(-{{SIZE}}{{UNIT}}/2); margin-left: calc(-{{SIZE}}{{UNIT}}/2)',
					'body:not(.rtl) {{WRAPPER}}.product-meta-view-inline .hfe-detail-container:after' => 'right: calc( (-{{SIZE}}{{UNIT}}/2) + (-{{divider_weight.SIZE}}px/2) )',
					'body:not.rtl {{WRAPPER}}.product-meta-view-inline .hfe-detail-container:after' => 'left: calc( (-{{SIZE}}{{UNIT}}/2) - ({{divider_weight.SIZE}}px/2) )',
				],
			]
		);
		$this->add_control(
			'divider',
			[
				'label'        => __( 'Divider', 'header-footer-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_off'    => __( 'Off', 'header-footer-elementor' ),
				'label_on'     => __( 'On', 'header-footer-elementor' ),
				'selectors'    => [
					'{{WRAPPER}} .hfe-product-meta .hfe-detail-container:not(:last-child):after' => 'content: ""',
				],
				'return_value' => 'yes',
				'separator'    => 'before',
			]
		);

		$this->add_control(
			'divider_style',
			[
				'label'     => __( 'Style', 'header-footer-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'solid'  => __( 'Solid', 'header-footer-elementor' ),
					'double' => __( 'Double', 'header-footer-elementor' ),
					'dotted' => __( 'Dotted', 'header-footer-elementor' ),
					'dashed' => __( 'Dashed', 'header-footer-elementor' ),
				],
				'default'   => 'solid',
				'condition' => [
					'divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}:not(.product-meta-view-inline) .hfe-product-meta .hfe-detail-container:not(:last-child):after' => 'border-top-style: {{VALUE}}',
					'{{WRAPPER}}.product-meta-view-inline .hfe-product-meta .hfe-detail-container:not(:last-child):after' => 'border-left-style: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'divider_weight',
			[
				'label'     => __( 'Weight', 'header-footer-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 1,
				],
				'range'     => [
					'px' => [
						'min' => 1,
						'max' => 20,
					],
				],
				'condition' => [
					'divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}:not(.product-meta-view-inline) .hfe-product-meta .hfe-detail-container:not(:last-child):after' => 'border-top-width: {{SIZE}}{{UNIT}}; margin-bottom: calc(-{{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}}.product-meta-view-inline .hfe-product-meta .hfe-detail-container:not(:last-child):after' => 'border-left-width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'divider_width',
			[
				'label'      => __( 'Width', 'header-footer-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'default'    => [
					'unit' => '%',
				],
				'condition'  => [
					'divider' => 'yes',
					'view!'   => 'inline',
				],
				'selectors'  => [
					'{{WRAPPER}} .hfe-product-meta .hfe-detail-container:not(:last-child):after' => 'width: {{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->add_control(
			'divider_height',
			[
				'label'      => __( 'Height', 'header-footer-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'default'    => [
					'unit' => '%',
				],
				'range'      => [
					'px' => [
						'min' => 1,
						'max' => 100,
					],
					'%'  => [
						'min' => 1,
						'max' => 100,
					],
				],
				'condition'  => [
					'divider' => 'yes',
					'view'    => 'inline',
				],
				'selectors'  => [
					'{{WRAPPER}} .hfe-product-meta .hfe-detail-container:not(:last-child):after' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->add_control(
			'divider_color',
			[
				'label'     => __( 'Color', 'header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ddd',
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'condition' => [
					'divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .hfe-product-meta .hfe-detail-container:not(:last-child):after' => 'border-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'heading_text_style',
			[
				'label'     => __( 'Text', 'header-footer-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'text_typography',
				'selector' => '{{WRAPPER}}',
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => __( 'Color', 'header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'heading_link_style',
			[
				'label'     => __( 'Link', 'header-footer-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'link_typography',
				'selector' => '{{WRAPPER}} .hfe-product-meta .detail-content a',
			]
		);

		$this->add_control(
			'link_color',
			[
				'label'     => __( 'Color', 'header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hfe-product-meta .detail-content a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_product_meta_captions',
			[
				'label' => __( 'Captions', 'header-footer-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'heading_category_caption',
			[
				'label' => __( 'Category', 'header-footer-elementor' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'category_caption_single',
			[
				'label'       => __( 'Singular', 'header-footer-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Category', 'header-footer-elementor' ),
			]
		);

		$this->add_control(
			'category_caption_plural',
			[
				'label'       => __( 'Plural', 'header-footer-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Categories', 'header-footer-elementor' ),
			]
		);

		$this->add_control(
			'heading_tag_caption',
			[
				'label'     => __( 'Tag', 'header-footer-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'tag_caption_single',
			[
				'label'       => __( 'Singular', 'header-footer-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Tag', 'header-footer-elementor' ),
			]
		);

		$this->add_control(
			'tag_caption_plural',
			[
				'label'       => __( 'Plural', 'header-footer-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Tags', 'header-footer-elementor' ),
			]
		);

		$this->add_control(
			'heading_sku_caption',
			[
				'label'     => __( 'SKU', 'header-footer-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'sku_caption',
			[
				'label'       => __( 'SKU', 'header-footer-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'SKU', 'header-footer-elementor' ),
			]
		);

		$this->add_control(
			'sku_missing_caption',
			[
				'label'       => __( 'Missing', 'header-footer-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'N/A', 'header-footer-elementor' ),
			]
		);

		$this->end_controls_section();
	}
	/**
	 * Get $single.
	 *
	 * Get $plural.
	 *
	 * Get $count.
	 *
	 * @param string $single for single.
	 * @param string $plural for plural.
	 * @param string $count for count.
	 * @since x.x.x
	 * @access protected
	 */
	private function get_hfe_plural_or_single( $single, $plural, $count ) {
		return 1 === $count ? $single : $plural;
	}

	/**
	 * Render Product Meta output on the frontend.
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
		$sku                     = $product->get_sku();
		$settings                = $this->get_settings_for_display();
		$sku_caption             = ! empty( $settings['sku_caption'] ) ? $settings['sku_caption'] : __( 'SKU', 'header-footer-elementor' );
		$sku_missing             = ! empty( $settings['sku_missing_caption'] ) ? $settings['sku_missing_caption'] : __( 'N/A', 'header-footer-elementor' );
		$category_caption_single = ! empty( $settings['category_caption_single'] ) ? $settings['category_caption_single'] : __( 'Category', 'header-footer-elementor' );
		$category_caption_plural = ! empty( $settings['category_caption_plural'] ) ? $settings['category_caption_plural'] : __( 'Categories', 'header-footer-elementor' );
		$tag_caption_single      = ! empty( $settings['tag_caption_single'] ) ? $settings['tag_caption_single'] : __( 'Tag', 'header-footer-elementor' );
		$tag_caption_plural      = ! empty( $settings['tag_caption_plural'] ) ? $settings['tag_caption_plural'] : __( 'Tags', 'header-footer-elementor' );
		?>
		<div class="hfe-product-meta">
			<?php do_action( 'woocommerce_product_meta_start' ); ?>
			<?php if ( wc_product_sku_enabled() && ( $sku || $product->is_type( 'variable' ) ) ) : ?>
			<span class="hfe-sku_wrapper hfe-detail-container"><span class="hfe-detail-label"><?php echo esc_html( $sku_caption ); ?></span> <span class="hfe-sku"><?php echo $sku ? $sku : esc_html( $sku_missing ); ?></span></span>
		<?php endif; ?>

		<?php if ( count( $product->get_category_ids() ) ) : ?>
			<span class="hfe-posted_in hfe-detail-container"><span class="hfe-detail-label"><?php echo esc_html( $this->get_hfe_plural_or_single( $category_caption_single, $category_caption_plural, count( $product->get_category_ids() ) ) ); ?></span> <span class="detail-content"><?php echo get_the_term_list( $product->get_id(), 'product_cat', '', ', ' ); ?></span></span>
		<?php endif; ?>

		<?php if ( count( $product->get_tag_ids() ) ) : ?>
			<span class="hfe-tagged_as hfe-detail-container"><span class="hfe-detail-label"><?php echo esc_html( $this->get_plural_or_single( $tag_caption_single, $tag_caption_plural, count( $product->get_tag_ids() ) ) ); ?></span> <span class="hfe-detail-content"><?php echo get_the_term_list( $product->get_id(), 'product_tag', '', ', ' ); ?></span></span>
		<?php endif; ?>
		<?php do_action( 'woocommerce_product_meta_end' ); ?>
	</div>
		<?php
	}
}
