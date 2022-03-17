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
			<div class="hero-container">
				<?php the_post_thumbnail(); 
			
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
						<a href="#products-container"><?php echo $link['title']; ?></a>
						<?php
					}
				}
				?>
			</div>
			
			<section class="products-container" id="products-container">
				<h2>Tours</h2>
				<?php $params = array(
					'posts_per_page' => 4, //No of product to be fetched
					'post_type' => 'product'
				);

				$wc_query = new WP_Query($params);
				if ($wc_query->have_posts()) :
					while ($wc_query->have_posts()) :
						$wc_query->the_post();
						?>
						<div class="single-tour-container">
							<h3><?php the_title(); ?></h3>
							<?php the_content(); ?>
							<a href="<?php the_permalink(); ?>">See More</a>
						</div>
					<?php
					endwhile;
						wp_reset_postdata();
					else:  ?>
					<p><?php _e( 'No Products' );?></p>	
				<?php 
				endif; ?>
			</section>

			<section class="two-columns">
				<div class=" what-to-bring-container">
					<h3>What To Bring</h3>
					<?php if( have_rows('what-to-bring') ): ?>
						<ul>
						<?php while ( have_rows('what-to-bring') ) : the_row(); ?>
							<li><?php the_sub_field('item'); ?></li>
						<?php endwhile; ?>
						</ul>
					<?php else : ?>
						<p>No todos found.</p>
					<?php endif; ?>
				</div>
				<div class="whats-included-container">
					<h3>What's Included</h3>
					<?php if( have_rows('what-is-included') ): ?>
						<ul>
						<?php while ( have_rows('what-is-included') ) : the_row(); ?>
							<li><?php the_sub_field('item'); ?></li>
						<?php endwhile; ?>
						</ul>
					<?php else : ?>
						<p>No todos found.</p>
					<?php endif; ?>
				</div>
			</section>

			<?php 
			 $args = array(
				'post_type'=>'ef-testimonial', 
				'orderby'=>'rand', 
				'posts_per_page'=>'1'
			);

			$query = new WP_Query( $args );
			?>

			<section class="testimonials-container">
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
			</section>

		<?php
		endwhile; // End of the loop.
		?>


	</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
