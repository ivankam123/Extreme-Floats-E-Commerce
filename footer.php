<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Extreme_Floats
 */

?>

	<footer id="colophon" class="site-footer">
		<section class="all-footer-items">
		<div class="site-info">
		<div class="footer-logo">
		<?php the_custom_logo(); ?>
		</div>
			<p>&copy; 2022</p>
			<a class="privacy-policy-desktop" href="<?php echo esc_attr( esc_url( get_privacy_policy_url() ) ); ?>">Privacy Policy</a>
		</div><!-- .site-info -->
		<div class="footer-nav-container">
			<nav class="site-map">
				<h2>Site Map</h2>
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
						)
					);
				?>
			</nav><!-- .site-map -->
			<nav class="tours-footer">
				<h2>Tours</h2>
				<ul>
					<?php 
						$args = array(
							'posts_per_page' => -1,
							'post_type' => 'product'
						);
						$query = new WP_Query($args); 
						if ($query->have_posts()) : 
							while ($query->have_posts()) :
								$query->the_post(); ?>
								<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
							<?php
							endwhile;
							wp_reset_postdata();
						endif;
					?>
				</ul>
			</nav><!-- .tours-footer -->
			<nav class="socials-footer">
				<h2>Socials</h2>
				<?php
					wp_nav_menu(
						array(
							'menu' => 'socials',
						)
					);
				?>
			</nav><!-- .socials-footer -->
			</div>
			<section class="contact-footer">
				<h2>Contact</h2>
				<ul>
					<?php 
						if (get_field('email', 15)) : ?>
							<li><a href="mailto:<?php the_field('email', 15); ?>"><?php the_field('email', 15); ?></a></li>
						<?php	
						endif;

						if (get_field('address', 15)) : ?>
							<li><address><?php the_field('address', 15); ?></address></li>
						<?php	
						endif;

						if (get_field('phone_number', 15)) : ?>
							<li><?php the_field('phone_number', 15); ?></li>
						<?php	
						endif;
					?>
				</ul>
			</section><!-- .contact-footer -->
			</section>
			<div class="policy-and-names">
				
				<a class="privacy-policy" href="<?php echo esc_attr( esc_url( get_privacy_policy_url() ) ); ?>">Privacy Policy</a>
					<div class="our-names">
						<p>
							<h4>Built by:</h4>
							<a href="https://lucillechesshire.com/" target="_blank">Lucille Chesshire</a>, 
							<a href="https://ivostudio.ca" target="_blank">Ivan Kam</a>, 
							<a href="https://rgstudios.ca/" target="_blank">Ryan Gabrinao</a>
						</p>
					</div>
			<div>
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
