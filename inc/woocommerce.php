<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Extreme_Floats
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function extreme_floats_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 150,
			'single_image_width'    => 300,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'extreme_floats_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function extreme_floats_woocommerce_scripts() {
	wp_enqueue_style( 'extreme-floats-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), _S_VERSION );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'extreme-floats-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'extreme_floats_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function extreme_floats_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'extreme_floats_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function extreme_floats_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'extreme_floats_woocommerce_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'extreme_floats_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function extreme_floats_woocommerce_wrapper_before() {
		?>
			<main id="primary" class="site-main">
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'extreme_floats_woocommerce_wrapper_before' );

if ( ! function_exists( 'extreme_floats_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function extreme_floats_woocommerce_wrapper_after() {
		?>
			</main><!-- #main -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'extreme_floats_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'extreme_floats_woocommerce_header_cart' ) ) {
			extreme_floats_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'extreme_floats_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function extreme_floats_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		extreme_floats_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'extreme_floats_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'extreme_floats_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function extreme_floats_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'extreme-floats' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'extreme-floats' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'extreme_floats_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function extreme_floats_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php extreme_floats_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}

function exf_acfs_function() {
	
				 if ( function_exists ( 'get_field' ) ) {

					echo '<div class="info-container">';
					
					if ( get_field( 'minimum_age' ) ) {
						echo '<section class="min-age-container">';
							echo'<h2>Minimum Age</h2>';
							echo "<p>";
							the_field( 'minimum_age' );
							echo "</p>";
						echo '</section>';
					}
					if ( get_field( 'minimum_weight' ) ) {
						echo '<section class="min-weight-container">';
							echo'<h2>Minimum Weight</h2>';
							echo "<p>";
							the_field( 'minimum_weight' );
							echo "</p>";
						echo '</section>';
					}
					if ( get_field( 'google_map' ) ) {
						echo '<section class="map-container">';
							echo'<h2>Directions</h2>';
							echo "<p>";
							the_field( 'google_map' );
							echo "</p>";
						echo "</section>";
					}
					if ( get_field( 'tour_length' ) ) {
						echo '<section class="tour-length-container">';
							echo'<h2>Tour Length</h2>';
							echo "<p>";
							the_field( 'tour_length' );
							echo "</p>";
						echo '</section>';
					}
					if ( get_field( 'departure_time' ) ) {
						echo '<section class="departure-time-container">';
							echo'<h2>Departure Time</h2>';
							echo "<p>";
							the_field( 'departure_time' );
							echo "</p>";
						echo '</section>';
					}
				}
				
				echo'<div class="two-col-container">';
					if( have_rows('what_to_bring') ) {
						echo '<section class="wtb-container">';
							echo'<h2>What To Bring</h2>';
							echo '<ul>';
							while ( have_rows('what_to_bring') ) : the_row();
							echo '<li>' .the_sub_field('what-to-bring').'</li>';

							endwhile;
							echo '</ul>';
						echo '</section>';
					}

					if( have_rows('whats_included') ) {
						echo '<section class="whats-inc-container">';
							echo'<h2>Whats Included</h2>';
							echo '<ul>';
							while ( have_rows('whats_included') ) : the_row();
							echo '<li>' .the_sub_field('whats_included').'</li>';

							endwhile;
							echo '</ul>';
						echo '</section>';
					}
				echo'</div>';

				
}

add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
function woo_remove_product_tabs( $tabs ) {
    unset( $tabs['reviews'] );    	// Remove the Reviews tab
    return $tabs;
}


remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary', 'exf_acfs_function', 45);
// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 42);




// Remove Breadcrumbs
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);