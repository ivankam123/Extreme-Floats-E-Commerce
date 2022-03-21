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
		while ( have_posts() ) : the_post(); ?>

			<!-- <h1>Frequently Asked Questions</h1> -->
			<h1><?php the_title()?></h1>

			<?php
			if (function_exists('get_field')) {
				if( have_rows('faqs') ): 
					while ( have_rows('faqs') ) : the_row();
						$sub_question = get_sub_field('question');
						$sub_answer = get_sub_field('answer');
						echo'<article>';
							echo '<p>' .$sub_question.'</p>';
							echo '<p>' .$sub_answer.'</p>';
						echo '</article>';
					endwhile;
				endif;
			}

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
