<?php
function my_theme_enqueue_styles() {

    $parent_style = 'sempress-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'sempress-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
    wp_enqueue_style( 'sempress-child-fonts',
        get_stylesheet_directory_uri() . '/fonts/source-sans-pro/source-sans-pro.css', 
        false
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
?>