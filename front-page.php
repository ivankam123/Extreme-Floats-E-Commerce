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
		?>
			<section class="hero-container">
				<?php the_post_thumbnail(); ?>

				<div class="content-container">
					<?php
					if ( function_exists ( 'get_field' ) ) {
						if ( get_field( 'big_hero_text' ) ) {
							echo "<h1>";
							the_field( 'big_hero_text' );
							echo "</h1>";
						}
						if ( get_field( 'intro-message' ) ) {
							echo "<p>";
							the_field( 'intro-message' );
							echo "</p>";
						}
						if ( get_field( 'hero-cta' ) ) {
							$link = get_field('hero-cta'); ?>
							<a href="#products-container" class="primary"><?php echo $link['title']; ?></a>
							<?php
						}
					}
					?>
				</div>
			</section>
			
			<section class="products-container" id="products-container">
				<h2>Tours</h2>
				<?php $params = array(
					'posts_per_page' => -1, //No of product to be fetched
					'post_type' => 'product'
				);

				$wc_query = new WP_Query($params);
				if ($wc_query->have_posts()) :
					while ($wc_query->have_posts()) :
						$wc_query->the_post();
						?>
						<article class="single-tour-container">
							<?php the_post_thumbnail(); ?>
							<div class="info-container">
								<h3><?php the_title(); ?></h3>
								<?php the_content(); ?>
								<a href="<?php the_permalink(); ?>" class="primary">See More</a>
							</div>
							
						</article>
					<?php
					endwhile;
						wp_reset_postdata();
					else:  ?>
					<p><?php _e( 'No Products' );?></p>	
				<?php 
				endif; ?>
			</section>

			<div class="two-columns">
				<section class=" what-to-bring-container">
					<div class="heading">
						<h2>What To Bring</h2>
						<?php get_template_part('icons/shirt-solid'); ?>
					</div>
					<?php if( have_rows('what-to-bring') ): ?>
						<ul>
						<?php while ( have_rows('what-to-bring') ) : the_row(); ?>
							<li><?php the_sub_field('item'); ?></li>
						<?php endwhile; ?>
						</ul>
					<?php endif; ?>
				</section>
				<section class="whats-included-container">
					<div class="heading">
						<h2>Our Trips Include</h2>
						<?php get_template_part('icons/oars-logo'); ?>
					</div>
					<?php if( have_rows('what-is-included') ): ?>
						<ul>
						<?php while ( have_rows('what-is-included') ) : the_row(); ?>
							<li><?php the_sub_field('item'); ?></li>
						<?php endwhile; ?>
						</ul>
					<?php endif; ?>
				</section>
			</div>

			<?php 
			 $args = array(
				'post_type'=>'ef-testimonial', 
				'orderby'=>'rand', 
				'posts_per_page'=>'1'
			);

			$query = new WP_Query( $args );
			?>

			<section class="testimonials-container">
				<div class="border-block">
				<?php
					if($query -> have_posts()) {
						while($query -> have_posts()) {
							$query -> the_post();
							?>
								<?php the_content(); ?>
							<?php
						}
						wp_reset_postdata();
					}
				?>
				</div>
			</section>

		<?php
		endwhile; // End of the loop.
		?>


	</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
