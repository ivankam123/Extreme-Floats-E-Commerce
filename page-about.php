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

		<?php while ( have_posts() ) : the_post(); ?>

				<div class="entry-content" id="about">
					<header class="about-header">
						<h1><?php the_title(); ?></h1>
						<?php the_post_thumbnail(); ?>
					</header>

					<?php 
						if ( function_exists ( 'get_field' ) ) {
							if ( get_field( 'about_the_company' ) ) {
								echo '<section class="our-company-container">';
									echo '<h2>Our Company</h2>';
									the_field( 'about_the_company' );
								echo '</section>';
							}
						} 	

						$args = array(
							'post_type'      => 'ef-staffs',
							'posts_per_page' => -1,
						);
						$query = new WP_Query( $args );

						if ( $query -> have_posts() ){
							echo '<h2>Meet Your Tour Guides</h2>';
							echo'<div class="tour-info">';
							while ( $query -> have_posts() ) {
								$query -> the_post(); ?>
								<article>
									<div class="tour-guide">
										<?php the_post_thumbnail(); ?>
										<h3><?php the_title(); ?></h3>
									</div>
										<div class="text-and-button">
											<?php
											if ( function_exists( 'get_field' ) ) {
												if ( get_field( 'description' ) ) { 
													echo '<p class="tour-descrip">';
													the_field( 'description' );
													echo '</p>';
												}
												if ( get_field( 'tour' ) ):
													$tours = get_field('tour');
													if ( $tours ):
														foreach ( $tours as $tour ):
															$permalink = get_permalink( $tour->ID );
															$title = get_the_title( $tour->ID ); ?>
															<a href="<?php echo esc_url( $permalink ); ?>" class="primary"><?php echo esc_html( $title ); ?></a>
														<?php
														endforeach;
														wp_reset_postdata();
													endif;
												endif;
											} 
											?>
										</div>
									</div>
								</article>
								<?php
							}
							wp_reset_postdata();
						} 
					?>
				</div>
	
	<?php

		endwhile; // End of the loop.
		?>

	</main><!-- #primary -->

<?php

get_footer();

