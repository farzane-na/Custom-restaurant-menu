<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Responsive;
use Elementor\Utils;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Controls_Stack;
use Elementor\Base\Data_Control;
use Elementor\Plugin;
use Elementor\Frontend;
use Elementor\Editor;
use Elementor\Element_Base;
use Elementor\Group_Control_Css_Filter;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Menu_Items_Widget extends Elementor\Widget_Base{
    public function get_name() {
        return 'menu_items';
    }
    public function get_title() {
        return esc_html__('Menu Items','restaurant-menu');
    }
    public function get_icon() {
        return 'eicon-post-list';
    }
    public function get_categories(){
        return ['basic'];
    }
    public function get_style_depends() {
        return [ 'menu-item-style' ];
    }
    public function get_script_depends(): array {
        return [ 'menu-item-script' ];
    }
    protected function register_controls(){
        $this->start_controls_section(
            'products_items_grid_template',
            [
                'label' => esc_html__( 'item template column', 'restaurant-menu' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'products_grid_columns',
            [
                'label' => esc_html__( 'Columns', 'restaurant-menu' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 6,
                'default' => 3,
                'selectors' => [
                    '{{WRAPPER}} .products-item' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'menu_item_category_style',
            [
                'label'=>esc_html__('category title','restaurant-menu'),
                'tab'=>\Elementor\Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'menu_category_title_typography',
                'label' => esc_html__( 'Category Title Typography', 'restaurant-menu' ),
                'selector' => '{{WRAPPER}} .category-title',
            ]
        );
        $this->add_control(
            'menu_category_title_color',
            [
                'label' => esc_html__( 'Category Title Color', 'restaurant-menu' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .category-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'menu_category_title_alignment',
            [
                'label' => esc_html__( 'Category Title Alignment', 'restaurant-menu' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'right' => [
                        'title' => esc_html__( 'right', 'restaurant-menu' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'restaurant-menu' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'left'=>[
                        'title'=>esc_html__('left','restaurant-menu'),
                        'icon'=>'eicon-text-align-left'
                    ],
                ],
                'default' => 'right',
                'selectors' => [
                    '{{WRAPPER}} .category-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'menu_item_card_style',
            [
                'label'=>esc_html__('menu item card','restaurant-menu'),
                'tab'=>\Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'menu_item_card_padding',
            [
                'label' => esc_html__( 'menu item card padding', 'restaurant-menu' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .product-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'menu_item_card_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'restaurant-menu' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .product-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'menu_item_card_background',
                'label' => esc_html__('card background','restaurant-menu'),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .product-item',
            ]
        );
        $this->add_control(
            'card_style_divider',
            [
                'type'=>\Elementor\Controls_Manager::DIVIDER,
            ]
        );
        $this->add_responsive_control(
            'menu_item_image_width',
            [
                'label' => esc_html__( 'image width', 'restaurant-menu' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .product-item__image' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'menu_item_image_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'restaurant-menu' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .product-item__image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'menu_item_image_divider',
            [
                'type'=>\Elementor\Controls_Manager::DIVIDER,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'menu_item_title_typography',
                'label' => esc_html__( 'Title Typography', 'restaurant-menu' ),
                'selector' => '{{WRAPPER}} .product-item__title',
            ]
        );
        $this->add_control(
            'menu_item_title_color',
            [
                'label' => esc_html__( 'Title Color', 'restaurant-menu' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .product-item__title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'menu_item_title_alignment',
            [
                'label' => esc_html__( 'Title Alignment', 'restaurant-menu' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'right' => [
                        'title' => esc_html__( 'right', 'restaurant-menu' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'restaurant-menu' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'left'=>[
                        'title'=>esc_html__('left','restaurant-menu'),
                        'icon'=>'eicon-text-align-left'
                    ],
                ],
                'default' => 'right',
                'selectors' => [
                    '{{WRAPPER}} .product-item__title' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'menu_item_title_divider',
            [
                'type'=>\Elementor\Controls_Manager::DIVIDER,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'menu_item_caption_typography',
                'label' => esc_html__( 'Details Typography', 'restaurant-menu' ),
                'selector' => '{{WRAPPER}} .product-item__details',
            ]
        );
        $this->add_control(
            'menu_item_detail_color',
            [
                'label' => esc_html__( 'Details Color', 'restaurant-menu' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .product-item__details' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'menu_item_caption_alignment',
            [
                'label' => esc_html__( 'Details Alignment', 'restaurant-menu' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'right' => [
                        'title' => esc_html__( 'right', 'restaurant-menu' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'restaurant-menu' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'left'=>[
                        'title'=>esc_html__('left','restaurant-menu'),
                        'icon'=>'eicon-text-align-left'
                    ],
                ],
                'default' => 'right',
                'selectors' => [
                    '{{WRAPPER}} .product-item__details' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'menu_item_details_divider',
            [
                'type'=>\Elementor\Controls_Manager::DIVIDER,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'menu_item_price_typography',
                'label' => esc_html__( 'Price Typography', 'restaurant-menu' ),
                'selector' => '{{WRAPPER}} .product-item__price',
            ]
        );
        $this->add_control(
            'menu_item_price_color',
            [
                'label' => esc_html__( 'Price Color', 'restaurant-menu' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .product-item__price' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'menu_item_price_divider',
            [
                'type'=>\Elementor\Controls_Manager::DIVIDER,
            ]
        );
        $this->add_control(
            'menu_item_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'restaurant-menu' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .product-item__cart-icon' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'menu_item_icon_width',
            [
                'label' => esc_html__( 'icon width', 'restaurant-menu' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .product-item__cart-icon' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'menu_item_icon_height',
            [
                'label' => esc_html__( 'icon height', 'restaurant-menu' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .product-item__cart-icon' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'category_items_style',
            [
                'label'=>esc_html__( 'Category Items', 'restaurant-menu' ),
                'tab'=>\Elementor\Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_responsive_control(
            'category_items_top',
            [
                'label' => __( 'Top Position', 'restaurant-menu' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vh' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .category-items' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'category_items_background',
                'label' => esc_html__('category items background','restaurant-menu'),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .category-items',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'category_active_item_background',
                'label' => esc_html__('category active item background','restaurant-menu'),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .category-item.active',
            ]
        );
        $this->add_responsive_control(
            'category_items_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'restaurant-menu' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .category-items' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'category_items_padding',
            [
                'label' => esc_html__( 'category items padding', 'restaurant-menu' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .category-items' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'category_items_typography',
                'label' => esc_html__( 'Typography', 'restaurant-menu' ),
                'selector' => '{{WRAPPER}} .category-items',
            ]
        );
        $this->add_control(
            'category_items_color',
            [
                'label' => esc_html__( 'Color', 'restaurant-menu' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .category-items' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'category_active_items_color',
            [
                'label' => esc_html__( 'active Color', 'restaurant-menu' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .category-item.active' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();
    }
    protected function render() {
        $categories = get_terms([
            'taxonomy'   => 'product_cat',
            'hide_empty' => true,
        ]);

        if ( empty($categories) || is_wp_error($categories) ) {
            return;
        }
        ?>

        <ul class="category-items">
            <?php foreach ( $categories as $category ) :
                $thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
                $image_url    = $thumbnail_id ? wp_get_attachment_url( $thumbnail_id ) : wc_placeholder_img_src();
                ?>
                <li class="category-item">
                <span class="category-item__image">
                    <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $category->name ); ?>">
                </span>
                    <span class="category-item__title"><?php echo esc_html( $category->name ); ?></span>
                </li>
            <?php endforeach; ?>
        </ul>

        <div class="menu-items">
            <?php foreach ( $categories as $category ) :
                $products = wc_get_products([
                    'status'   => 'publish',
                    'limit'    => -1,
                    'category' => [ $category->slug ],
                ]);

                if ( empty( $products ) ) {
                    continue;
                }
                ?>
                <div class="category-box">
                    <h3 class="category-title"><?php echo esc_html( $category->name ); ?></h3>
                    <div class="products-item">
                        <?php foreach ( $products as $product ) :
                            $image_url   = wp_get_attachment_image_url( $product->get_image_id(), 'medium' );
                            $price_html  = $product->get_price_html();
                            $title       = $product->get_name();
                            $description = $product->get_description();
                            ?>
                            <article class="product-item">
                                <div class="product-item__image">
                                    <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $title ); ?>">
                                </div>
                                <div class="product-item__content">
                                    <h4 class="product-item__title"><?php echo esc_html( $title ); ?></h4>
                                    <p class="product-item__details"><?php echo wp_kses_post( $description ); ?></p>
                                    <div class="product-item__buying-detail">
                                        <span class="product-item__price"><?php echo wp_kses_post( $price_html ); ?></span>
                                        <span class="product-item__cart-icon">
                                         <a href="<?php echo esc_url( '?add-to-cart=' . $product->get_id() ); ?>"
                                            data-quantity="1"
                                            data-product_id="<?php echo esc_attr( $product->get_id() ); ?>"
                                            class="add_to_cart_button ajax_add_to_cart add-to-cart-svg"
                                            aria-label="<?php echo esc_attr( $product->add_to_cart_description() ); ?>">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M8.7499 13C8.7499 12.5858 8.41412 12.25 7.9999 12.25C7.58569 12.25 7.2499 12.5858 7.2499 13V17C7.2499 17.4142 7.58569 17.75 7.9999 17.75C8.41412 17.75 8.7499 17.4142 8.7499 17V13Z"/>
                                                    <path d="M15.9999 12.25C16.4141 12.25 16.7499 12.5858 16.7499 13V17C16.7499 17.4142 16.4141 17.75 15.9999 17.75C15.5857 17.75 15.2499 17.4142 15.2499 17V13C15.2499 12.5858 15.5857 12.25 15.9999 12.25Z" />
                                                    <path d="M12.7499 13C12.7499 12.5858 12.4141 12.25 11.9999 12.25C11.5857 12.25 11.2499 12.5858 11.2499 13V17C11.2499 17.4142 11.5857 17.75 11.9999 17.75C12.4141 17.75 12.7499 17.4142 12.7499 17V13Z" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17.2737 3.47298C16.7981 3.28712 16.2654 3.25574 15.5819 3.25077C15.3012 2.65912 14.6983 2.25 13.9999 2.25H9.9999C9.3015 2.25 8.69865 2.65912 8.41794 3.25077C7.7344 3.25574 7.20166 3.28712 6.72611 3.47298C6.15792 3.69505 5.66371 4.07255 5.29999 4.5623C4.93306 5.05639 4.76082 5.68968 4.52374 6.56133L3.89587 8.86426C3.50837 9.06269 3.16928 9.32992 2.88642 9.6922C2.26442 10.4888 2.15427 11.4377 2.26492 12.5261C2.37229 13.5822 2.70479 14.9121 3.121 16.5769L3.1474 16.6825C3.41058 17.7353 3.62426 18.5901 3.8784 19.2572C4.14337 19.9527 4.47977 20.5227 5.03439 20.9558C5.58901 21.3888 6.22365 21.5769 6.96266 21.6653C7.67148 21.75 8.55256 21.75 9.63774 21.75H14.362C15.4472 21.75 16.3282 21.75 17.0371 21.6653C17.7761 21.5769 18.4107 21.3888 18.9653 20.9558C19.5199 20.5227 19.8563 19.9527 20.1213 19.2572C20.3755 18.5901 20.5891 17.7353 20.8523 16.6825L20.8787 16.577C21.2949 14.9122 21.6274 13.5822 21.7348 12.5261C21.8454 11.4377 21.7353 10.4888 21.1133 9.6922C20.8305 9.32995 20.4914 9.06274 20.104 8.86431L19.4761 6.56133C19.239 5.68968 19.0667 5.05639 18.6998 4.5623C18.3361 4.07255 17.8419 3.69505 17.2737 3.47298ZM7.27214 4.87007C7.49194 4.78416 7.75752 4.75888 8.41935 4.75219C8.70067 5.34225 9.30267 5.75 9.9999 5.75H13.9999C14.6971 5.75 15.2991 5.34225 15.5805 4.75219C16.2423 4.75888 16.5079 4.78416 16.7277 4.87007C17.0336 4.98964 17.2997 5.19291 17.4956 5.45663C17.6717 5.69377 17.775 6.02508 18.0659 7.09194L18.4195 8.3887C17.3817 8.24996 16.0419 8.24998 14.3773 8.25H9.62246C7.95788 8.24998 6.61809 8.24996 5.5803 8.38868L5.93388 7.09195C6.22478 6.02508 6.32812 5.69376 6.50423 5.45662C6.70008 5.19291 6.96619 4.98964 7.27214 4.87007ZM9.9999 3.75C9.86183 3.75 9.7499 3.86193 9.7499 4C9.7499 4.13807 9.86183 4.25 9.9999 4.25H13.9999C14.138 4.25 14.2499 4.13807 14.2499 4C14.2499 3.86193 14.138 3.75 13.9999 3.75H9.9999ZM4.06873 10.6153C4.34756 10.2582 4.78854 10.0183 5.69971 9.88649C6.63034 9.75187 7.89217 9.75 9.68452 9.75H14.3152C16.1075 9.75 17.3694 9.75187 18.3 9.88649C19.2112 10.0183 19.6522 10.2582 19.931 10.6153C20.2098 10.9725 20.3356 11.4584 20.2425 12.3744C20.1474 13.3099 19.8432 14.5345 19.4084 16.2733C19.1312 17.3824 18.9381 18.1496 18.7196 18.7231C18.5083 19.2778 18.3014 19.5711 18.0422 19.7735C17.783 19.9758 17.4483 20.1054 16.859 20.1759C16.2496 20.2488 15.4584 20.25 14.3152 20.25H9.68452C8.54133 20.25 7.75015 20.2488 7.14076 20.1759C6.5514 20.1054 6.21667 19.9758 5.95751 19.7735C5.69835 19.5711 5.49144 19.2778 5.28013 18.7231C5.06163 18.1496 4.86853 17.3824 4.59127 16.2733C4.15656 14.5345 3.85233 13.3099 3.75723 12.3744C3.66411 11.4584 3.78989 10.9725 4.06873 10.6153Z"/>
                                                </svg>
                                         </a>
                                    </span>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php
    }
}