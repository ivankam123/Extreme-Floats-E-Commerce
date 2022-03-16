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

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

			if ( function_exists('get_field') ) {

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
		}

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
