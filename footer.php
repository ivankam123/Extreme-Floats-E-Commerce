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
		<div class="site-info">
			<h4>LOGO</h4>
			<p>&copy; 2022</p>
			<a href="<?php echo esc_attr( esc_url( get_privacy_policy_url() ) ); ?>">Privacy Policy</a>
			<div>Lucille, Ivan, Ryan</div>
		</div><!-- .site-info -->
		<nav class="site-map">
			<h4>Site Map</h4>
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
			<h4>Tours</h4>
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
			<h4>Socials</h4>
			<?php
				wp_nav_menu(
					array(
						'menu' => 'socials',
					)
				);
			?>
		</nav><!-- .socials-footer -->
		<section class="contact-footer">
			<h4>Contact</h4>
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
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
