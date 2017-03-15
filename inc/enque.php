<?php
function styles_and_scripts() {

  wp_enqueue_style("font_roboto", "https://fonts.googleapis.com/css?family=Roboto:300,300i,400,500,700,700i&amp;subset=latin-ext");
  wp_enqueue_style("font_yeseva", "https://fonts.googleapis.com/css?family=Yeseva+One&amp;subset=latin-ext");
  wp_enqueue_style("font_fontawesome", "https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css");
  wp_enqueue_style("main_css", get_stylesheet_directory_uri() . "/css/main.css");
  wp_enqueue_style("external_css", get_stylesheet_directory_uri() . "/css/external.css");

    if ( !is_admin() )
        // wp_deregister_script('jquery');

    wp_enqueue_script("plugins", get_stylesheet_directory_uri() . "/js/plugins.min.js", array('jquery'));
    wp_enqueue_script("main_js", get_stylesheet_directory_uri() . "/js/main.js", array('jquery'), '1.1', true);

}
add_action('wp_enqueue_scripts', 'styles_and_scripts', 100);

?>
