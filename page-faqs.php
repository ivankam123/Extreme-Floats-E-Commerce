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

			<section class="faq-main">
			<!-- <h1>Frequently Asked Questions</h1> -->
			<h1><?php the_title()?></h1>
			
			<?php
			// the_content();
			if (function_exists('get_field')) {
				echo '<section class="faq-content">';
				echo '<div class="faq-hero-img">';
					the_post_thumbnail();
				echo '</div>';
				echo '<div class="faq-questions">';
				if( have_rows('faqs') ): 
					while ( have_rows('faqs') ) : the_row();
						$sub_question = get_sub_field('question');
						$sub_answer = get_sub_field('answer');
						echo'<article>';
							echo '<p class="faq-question">' .$sub_question.'</p>';
							echo '<p class="faq-answer">' .$sub_answer.'</p>';
						echo '</article>';
					endwhile;
				endif;
				?>
				<div class="cta-check-out-tours">
					<h2>Ready to Book?</h2>
					<a href="<?php echo esc_url(get_page_link(50));?>" class="primary">Our Tours</a>
					
				</div>

				<?php 
				echo '</div>';
				echo '</section>';
			}
			?>
			</section>
			<?php

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
