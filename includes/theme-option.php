<?php 


function woo_options_add( $options ) {

	$shortname = "woo_xo";

	//Access the WordPress Pages via an Array
	$woo_pages = array( '0' => 'Select a page:');
	$woo_pages_obj = get_pages('sort_column=post_parent,menu_order');
	foreach ($woo_pages_obj as $woo_page) {
	    $woo_pages[$woo_page->ID] = $woo_page->post_title; }

	$new_options[] = array( "name" => __( 'Header Field', 'woothemes' ),
				"icon" => "general",
                "type" => "heading");

		$new_options[] = array( "name" => __( 'Header Welcome text', 'woothemes' ),
					"desc" => __( 'Enter text here', 'woothemes' ),
					"id" => $shortname."_header_welcome_text",
					"type" => "textarea");

	$new_options[] = array( "name" => __( 'Footer Logo', 'woothemes' ),
				"icon" => "general",
                "type" => "heading");

		$new_options[] = array( "name" => __( 'Footer Logo', 'woothemes' ),
					"desc" => __( 'Upload logo here', 'woothemes' ),
					"id" => $shortname."_footer_logo",
					"type" => "upload");



	
	$options = wp_parse_args($new_options, $options);

	return $options;
}
