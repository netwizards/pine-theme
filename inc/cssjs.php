<?php
function styles_and_scripts() {

	wp_enqueue_style("google_font_1", "https://fonts.googleapis.com/css?family=Rokkitt:400,700");
  wp_enqueue_style("google_font_2", "https://fonts.googleapis.com/css?family=Open+Sans:400,600,700");
  wp_enqueue_style("main_css", get_stylesheet_directory_uri() . "/css/main.css");

	if ( !is_admin() )
		// wp_deregister_script('jquery');

	wp_enqueue_script("plugins", get_stylesheet_directory_uri() . "/js/plugins.min.js", array('jquery'));
	wp_enqueue_script("main_js", get_stylesheet_directory_uri() . "/js/main.js", array('jquery'), '1.1', true);

}
add_action('wp_enqueue_scripts', 'styles_and_scripts', 100);

?>
