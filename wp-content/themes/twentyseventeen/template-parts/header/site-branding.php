<?php
/**
 * Displays header site branding
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>
<div class="site-branding">

	<div class="wrap">


		<div class="social">

			<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'twentyseventeen' ); ?>">

				<?php
					wp_nav_menu( array(
						'theme_location' => 'social',
						'menu_class'     => 'social-links-menu',
						'depth'          => 1,
						'link_before'    => '<span>',
						'link_after'     => '</span>',
					) );
				?>

			</nav><!-- .social-navigation -->

		</div>


		<div class="site-branding-text">

				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">

					<?php get_template_part( 'template-parts/header/header', 'logo' ); ?>

				</a></h1>

				<?php $description = get_bloginfo( 'description', 'display' ); ?>
				<?php if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo $description; ?></p>
				<?php endif; ?>

		</div><!-- .site-branding-text -->

		<div class="site-extra">

			<a href="#"><i class="icon icon-search">&nbsp;</i></a>

		</div>

	</div><!-- .wrap -->

</div><!-- .site-branding -->
