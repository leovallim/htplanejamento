<?php 
/**
 * JS e CSS que forem necessários
 */
add_action("wp_enqueue_scripts", "ht_scripts");
function ht_scripts(){
    wp_enqueue_style( 'style', get_stylesheet_uri() );
    wp_enqueue_style( "plugins_css", get_template_directory_uri() ."/dist/css/plugins.css" );

    wp_enqueue_script("jquery");
    wp_enqueue_script( "plugins_js", get_template_directory_uri() ."/dist/js/plugins.js", null, null, true);
    wp_enqueue_script( "plugins_js", 'https://unpkg.com/swiper/swiper-bundle.min.js', null, null, true);
    wp_enqueue_script( "script_js", get_template_directory_uri() ."/dist/js/script.js", null, null, true);
}