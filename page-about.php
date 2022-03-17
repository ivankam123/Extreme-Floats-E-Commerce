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
 * @package FWD_Starter_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<section>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->

				<div class="entry-content">
				<?php 
                        if ( function_exists ( 'get_field' ) ) {
                    
                            if ( get_field( 'about_the_team' ) ) {
                                the_field( 'about_the_team' );
                            }

                            if ( get_field( 'about_the_company' ) ) {
                                the_field( 'about_the_company' );
                            }
                        } 
				?>
				</div>
					</section>

			<section>
			<?php
			$args = array(
				'post_type'      => 'ef-staffs',
				'posts_per_page' => -1,
			);

			$query = new WP_Query( $args );

			$query = new WP_Query( $args );

			if ( $query -> have_posts() ){
				while ( $query -> have_posts() ) {
					$query -> the_post();
					if ( function_exists( 'get_field' ) ) {
						if ( get_field( 'description' ) ) {
							the_field( 'description' );
						}
					}
				}
				wp_reset_postdata();
			} 
			?>
			<section>
			</article>
	<?php

		endwhile; // End of the loop.
		?>

	</main><!-- #primary -->

<?php

get_footer();

