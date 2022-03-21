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
		echo'<section>';
			echo'<h1>';
			the_title();
			echo'</h1>';
			the_content();
			if ( function_exists('get_field') ) {
				echo '<div class="all-contact-info">';
					if( get_field('address') ) {
						echo '<p>';
						the_field('address');
						echo '</p>';
					}
				
					if( get_field('email') ) {
						echo '<p>';
						the_field('email');
						echo '</p>';
					}

					if( get_field('phone_number') ) {
						echo '<p>';
						the_field('phone_number');
						echo '</p>';
					}
				echo '</div>';
			}
		echo'</section>';
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
