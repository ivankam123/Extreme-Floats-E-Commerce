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

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
