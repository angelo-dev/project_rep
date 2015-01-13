<?php
		
	include_once "includes/custom-function/business_slider.php";
	include_once "includes/widgets/custom-text-widget.php";
	include_once "includes/theme-option.php";

	class Jamboree {

		private $child_dir;
		function __construct() {
			$this->child_dir = get_stylesheet_directory_uri();
			add_action( 'wp_enqueue_scripts', array($this, 'registerStyle') );
			add_action( 'widgets_init', array($this, 'registerSidebar') );
			add_action( 'woo_footer_after', array($this, 'footerLogo') );
			add_action( 'woo_footer_inside', array($this, 'footerMenu') );
			remove_action( 'woo_header_inside', 'woo_header_widgetized' );
			add_action( 'woo_header_inside', array($this, 'woo_custom_header_widgetized') );
			add_action( 'wp_head', array($this, 'importStyle') );
			add_action( 'woo_content_before', array($this, 'defaultPageBanner') );
		}

		function importStyle() {
			?>
			<!-- FOR NON RESPONSIVE IE -->
			<!--[if lt IE 9]>
				<link href="<?php echo  $this->child_dir ?>/styles/sass/stylesheets/ie.css" media="screen, projection" rel="stylesheet" type="text/css" />
			<![endif]--> 
			<?php
		}

		function registerStyle() {
			wp_enqueue_style("child-css",  $this->child_dir . "/styles/sass/stylesheets/style.css", array("theme-stylesheet"), null, "all");
		}

		function registerSidebar() {
			// Register Nav Menus
			register_nav_menu( 'footer-menu', 'Footer Menu' );

			// Register Sidebar
			register_sidebar(array(
				'name'=> 'Featured Articles Widget',
				'id' => 'featured_article_widget',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			));
		}

		function footerLogo() {
			global $woo_options;
			$imgURL = $woo_options['woo_xo_footer_logo'];
			$siteURL = site_url('/');
			if( !empty( $imgURL )) {	
				$logoHTML = "<div class='footer-logo col-full'><a href='{$siteURL}'><img src='{$imgURL}' alt='Footer Logo'></a></div>";
				echo $logoHTML;
			}
		}

		function footerMenu() {

			$defaults = array(
				'theme_location'  => 'footer-menu',
				'menu'            => '',
				'container'       => 'div',
				'container_class' => '',
				'container_id'    => '',
				'menu_class'      => 'menu',
				'menu_id'         => '',
				'echo'            => true,
				'fallback_cb'     => 'wp_page_menu',
				'before'          => '',
				'after'           => '',
				'link_before'     => '',
				'link_after'      => '',
				'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'depth'           => 0,
				'walker'          => ''
			);

			wp_nav_menu( $defaults );
		}

		function defaultPageBanner() {
			if( !is_front_page() ) {
				echo '<div class="default-page-banner"></div>';
			}
		}

		function woo_custom_header_widgetized() {
			global $woo_options;
			$welcome_text = $woo_options['woo_xo_header_welcome_text'];
			
		    if ( woo_active_sidebar( 'header' ) ) {
		?>
		    <div class="header-widget">
		    	<?php if(isset($welcome_text) && !empty($welcome_text)) { ?>
			    	<div class="header-welcome-text">
			    		<h2><?php echo $welcome_text ?></h2>
			    	</div>
		        <?php } 
		        woo_sidebar( 'header' ) ?>
		    </div>
		<?php
		    }
		}

	}

	add_action("after_setup_theme", function(){
		new Jamboree;
	});