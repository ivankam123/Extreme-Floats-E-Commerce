<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Extreme_Floats
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			// get_template_part( 'template-parts/content', 'page' );
		echo'<section class="contact-main">';
			echo'<h1 class="contact-title">';
			the_title();
			echo'</h1>';
			echo'<div class="contact-content">';
			echo '<div class="contact-form">';
				the_content();
			echo '</div>';
			if ( function_exists('get_field') ) {
				echo '<div class="all-contact-info">';
					

					if( get_field('phone_number') ) {
						echo '<p>';
						the_field('phone_number');
						echo '</p>';
					}

					if( get_field('email') ) {
						echo '<p>';
						the_field('email');
						echo '</p>';
					}

					if( get_field('address') ) {
						echo '<p>';
						the_field('address');
						echo '</p>';
					}
				echo '</div>';
			}
			echo'</div>';
			?>
			
			<?php $location = get_field('location'); 
			if( $location ): ?> 
				<div class="acf-map" data-zoom="16"> 
						<div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div> 
				</div>
			<?php endif; ?>
		
			<div class="cta-faq-section">
				<h2>Still have questions?</h2>
				<a href="<?php echo esc_url(get_page_link(132));?>" class="primary">
				<?php echo get_the_title(132) ?>
				</a>
			</div>
			<?php
		echo'</section>';

		
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
