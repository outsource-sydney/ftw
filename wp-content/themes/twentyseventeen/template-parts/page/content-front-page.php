<?php
/**
 * Displays content for front page
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'twentyseventeen-panel ' ); ?> >

	<?php if( get_field( 'header_post' ) ) : ?>

		<?php
			$intPost=get_field( 'header_post' );
			setup_postdata( $intPost );
			$ID=$intPost->ID;
		?>

		<div class="wrap">

			<div id="header">

				<div class="header-image">

					<?php if ( has_post_thumbnail( $intPost ) ) : ?>

						<img class="thumbsize" src="<?php echo get_the_post_thumbnail_url( $intPost, 'thumbnail' ); ?>" data-src="<?php echo get_the_post_thumbnail_url( $intPost, 'large' ); ?>" data-load="1" data-scroll="1" width="600" >

					<?php endif; ?>

				</div>

				<div class="header-content">

					<h4>

						<?php
						$catDetail=get_the_category( $ID ); //$post->ID
						foreach($catDetail as $cd) :
						?>

							<a href="<?php echo get_category_link( $cd->term_id ); ?>"><?php echo $cd->cat_name; ?></a>

						<?php endforeach; ?>

					</h4>

					<h2><?php echo get_the_title( $ID ); ?></h2>

					<p><?php echo get_the_excerpt(  ); ?></p>

					<p>by <?php echo get_the_author(  ); ?> &mdash; <?php echo time_ago( ); ?></p>

				</div>

			</div>

		</div>

		<?php wp_reset_postdata( ); ?>

	<?php endif; ?>

	<div class="panel-content">

		<div class="entry-content">

			<div class="wrap">

				<div class="col-container">

					<div class="col-1">

						<h2>Blog Posts</h2>

						<div class="posts-container">

						<?php

								$the_query = new WP_Query( array(
								  'post_type' => 'post',
								  'showposts' => get_sub_field( 'number_of_posts' ),
									'orderby' => 'date',
									'order' => 'ASC'
								)  );

								// The Loop
								if ( $the_query->have_posts() ) : ?>

										<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

											<?php get_template_part( '/template-parts/post/content-front', 'single' ); ?>

										<?php endwhile; ?>

								<?php endif; ?>

						</div>

						<h2>Podcastss</h2>

						<div class="posts-container podcasts">

								<?php

										$the_query = new WP_Query( array(
										  'post_type' => 'podcast',
										  'showposts' => get_sub_field( 'number_of_posts' ),
											'orderby' => 'date',
											'order' => 'ASC'
										)  );

										// The Loop
										if ( $the_query->have_posts() ) : ?>

												<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

													<?php get_template_part( '/template-parts/post/content-front', 'single' ); ?>

												<?php endwhile; ?>

										<?php endif; ?>

							</div>

								<?php
									/* translators: %s: Name of current post */
									//the_content( sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen' ), get_the_title( ) ) );
								?>

						</div><!-- end col-1 -->

						<div class="col-2">

							<h2>Right Sidebar</h2>

							<p>/* translators: %s: Name of current post */
							//the_content( sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen' ), get_the_title( ) ) );/* translators: %s: Name of current post */
							//the_content( sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen' ), get_the_title( ) ) );</p>

						</div>

					</div><!-- end col-2 -->

				</div><!-- end col-container -->

			</div><!-- .entry-content -->

		</div><!-- .wrap -->

	</div><!-- .panel-content -->

</article><!-- #post-## -->
