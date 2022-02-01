<?php
function my_theme_enqueue_styles() {

    $parent_style = 'sempress-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'sempress-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

/**
 * Adds the custom CSS to the theme-header
 *
 * @since 1.3.0
 */
function sempress_customize_css() {
    global $themecolors;
?>
    <style type="text/css" id="sempress-custom-colors">
        body { text-shadow: 0 1px 0 <?php echo esc_attr( get_theme_mod( 'sempress_shadowcolor', '#' . $themecolors['shadow'] ) ); ?>; }
        body, a { color: <?php echo esc_attr( get_theme_mod( 'sempress_textcolor', '#' . $themecolors['text'] ) ); ?>; }
        .widget, #access {
            border-bottom: 1px solid <?php echo esc_attr( get_theme_mod( 'sempress_bordercolor', 'inherit' ) ); ?>;
            -moz-box-shadow: <?php echo esc_attr( get_theme_mod( 'sempress_shadowcolor', 'inherit' ) ); ?> 0 1px 0 0;
            -webkit-box-shadow: <?php echo esc_attr( get_theme_mod( 'sempress_shadowcolor', 'inherit' ) ); ?> 0 1px 0 0;
            box-shadow: <?php echo esc_attr( get_theme_mod( 'sempress_shadowcolor', 'inherit' ) ); ?> 0 1px 0 0;
        }
        article.comment {
            border-top: 1px solid <?php echo esc_attr( get_theme_mod( 'sempress_shadowcolor', 'inherit' ) ); ?>;
            -moz-box-shadow: <?php echo esc_attr( get_theme_mod( 'sempress_bordercolor', 'inherit' ) ); ?> 0 -1px 0 0;
            -webkit-box-shadow: <?php echo esc_attr( get_theme_mod( 'sempress_bordercolor', 'inherit' ) ); ?> 0 -1px 0 0;
            box-shadow: <?php echo esc_attr( get_theme_mod( 'sempress_bordercolor', 'inherit' ) ); ?> 0 -1px 0 0;
        }
    </style>
<?php
}