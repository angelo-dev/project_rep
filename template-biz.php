<?php
/**
 * Template Name: Business
 *
 * The business page template displays your posts with a "business"-style
 * content slider at the top.
 *
 * @package WooFramework
 * @subpackage Template
 */

global $woo_options, $wp_query;
get_header();

$page_template = woo_get_page_template();
?>
    <!-- #content Starts -->
	<?php woo_content_before(); ?>
	<?php if ( ( isset( $woo_options['woo_slider_biz'] ) && 'true' == $woo_options['woo_slider_biz'] ) && ( isset( $woo_options['woo_slider_biz_full'] ) && 'true' == $woo_options['woo_slider_biz_full'] ) ) { $saved = $wp_query; woo_slider_biz(); $wp_query = $saved; } ?>
    <div id="content" class="business">
    	<div class="col-full">

    	<div id="main-sidebar-container">

            <!-- #main Starts -->
            <?php woo_main_before(); ?>

	<?php if ( ( isset( $woo_options['woo_slider_biz'] ) && 'true' == $woo_options['woo_slider_biz'] ) && ( isset( $woo_options['woo_slider_biz_full'] ) && 'false' == $woo_options['woo_slider_biz_full'] ) ) { $saved = $wp_query; woo_slider_biz(); $wp_query = $saved; } ?>

            <section id="main">
<?php
	woo_loop_before();

	if ( have_posts() ) { $count = 0;
		while ( have_posts() ) { the_post(); $count++;
			woo_get_template_part( 'content', 'page-template-business' ); // Get the page content template file, contextually.
		}
	}

	woo_loop_after();
?>
            </section><!-- /#main -->
            <?php woo_main_after(); ?>

			<?php get_sidebar(); ?>

		</div><!-- /#main-sidebar-container -->

		<?php get_sidebar( 'alt' ); ?>
		</div>
    </div><!-- /#content -->
    <div class="featured-articles col-full">
		<?php 
			$sidebar_article = "#featured_article_widget";
			if( is_active_sidebar($sidebar_article) ) {
				dynamic_sidebar($sidebar_article);
			}
		?>
	</div>
	<?php woo_content_after(); ?>

<?php get_footer(); ?>