<?php 
if ( ! function_exists( 'woo_slider_biz_view' ) ) {
	function woo_slider_biz_view( $args = null, $slides = null ) {

		global $woo_options, $post;

		// Default slider settings.
		$defaults = array(
							'id' => 'loopedSlider',
							'width' => '960',
							'container_css' => '',
							'slide_styles' => ''
						);

		// Merge the arguments with defaults.
		$args = wp_parse_args( $args, $defaults );

		// Init slide count
		$count = 0;

	?>

	<?php do_action('woo_biz_slider_before'); ?>
	<div class="main-slider">
	<div id="<?php echo esc_attr( $args['id'] ); ?>"<?php if ( '' != $args['container_css'] ): ?> class="<?php echo esc_attr( $args['container_css'] ); ?>"<?php endif; ?><?php if ( !apply_filters( 'woo_slider_autoheight', true ) ): ?> style="height: <?php echo apply_filters( 'woo_slider_height', 350 ); ?>px;"<?php endif; ?>>

		<ul class="slides"<?php if ( !apply_filters( 'woo_slider_autoheight', true ) ): ?> style="height: <?php echo apply_filters( 'woo_slider_height', 350 ); ?>px;"<?php endif; ?>>

			<?php foreach ( $slides as $k => $post ) { setup_postdata( $post ); $count++; ?>

			<?php
				// Slide Styles
				if ( $count >= 2 ) { $args['slide_styles'] .= ' display:none;'; } else { $args['slide_styles'] = ''; }
			?>

			<li id="slide-<?php echo esc_attr( $post->ID ); ?>" class="slide slide-number-<?php echo esc_attr( $count ); ?>" <?php if ( '' != $args['slide_styles'] ): ?>style="<?php echo esc_attr( $args['slide_styles'] ); ?>"<?php endif; ?>>

				<?php
					$type = woo_image('return=true');
					if ( $type ):
						$url = get_post_meta( $post->ID, 'url', true );
				?>

					<?php if ( '' != $url ): ?><a href="<?php echo esc_url( $url ); ?>" title="<?php the_title_attribute(); ?>"><?php endif; ?>
					<?php if ( '' != $url ): ?></a><?php endif; ?>
					<div class="biz-slider-image" style="background-image: url('<?php woo_image('link=url'); ?>')">
					<?php if ( 'true' == $woo_options['woo_slider_biz_title'] || '' != get_the_excerpt() ): ?>
					<span class="shadow-bg"></span>
					<div class="content">

						<?php if ( 'true' == $woo_options['woo_slider_biz_title'] ): ?>
						<div class="title">
							<h2 class="slide-title">
								<?php if ( '' != $url ): ?><a href="<?php echo esc_url( $url ); ?>" title="<?php the_title_attribute(); ?>"><?php endif; ?>
								<?php the_title(); ?>
								<?php if ( '' != $url ): ?></a><?php endif; ?>

							</h2>
							<?php the_content(); ?>
						</div>
						<?php endif; ?>

						<?php if ( '' != $post->post_excerpt ): ?>
						<div class="excerpt">
							<?php
		 						$content = $post->post_excerpt;
								$content = do_shortcode( $content );
								echo wpautop( $content );
							?>
						</div><!-- /.excerpt -->
						<?php endif; ?>

					</div><!-- /.content -->
					<?php endif; ?>
					</div>
				<?php else: ?>

					<section class="entry col-full">
						<?php the_content(); ?>
					</section>

				<?php endif; ?>

			</li><!-- /.slide-number-<?php echo esc_attr( $count ); ?> -->

			<?php } // End foreach ?>

			<?php wp_reset_postdata();  ?>

		</ul><!-- /.slides -->

	</div><!-- /#<?php echo $args['id']; ?> -->

	<?php if ( isset( $woo_options['woo_slider_pagination'] ) && $woo_options['woo_slider_pagination'] == 'true' ) : ?>
		<div class="pagination-wrap slider-pagination">
			<ol class="flex-control-nav flex-control-paging">
				<?php for ( $i = 0; $i < $count; $i++ ): ?>
					<li><a><?php echo ( $i + 1 ) ?></a></li>
				<?php endfor; ?>
			</ol>
		</div>
	<?php endif; ?>
	
	</div>
	<?php do_action('woo_biz_slider_after'); ?>

<?php
	} // End woo_slider_biz_view()
}