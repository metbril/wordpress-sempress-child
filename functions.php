<?php
/**
 * Enqueue child style sheet
 */
function sempress_child_enqueue_styles() {

    $parent_style = 'sempress-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'sempress-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'sempress_child_enqueue_styles' );

/**
 * Adds the custom CSS to the theme-header
 * 
 * Customized to remove shadows from fonts and borders
 *
 * @since 1.3.0
 */
function sempress_customize_css() {
    global $themecolors;
?>
    <style type="text/css" id="sempress-custom-colors">
        body, a { color: <?php echo esc_attr( get_theme_mod( 'sempress_textcolor', '#' . $themecolors['text'] ) ); ?>; }
        .widget, #access {
            border-bottom: 1px solid <?php echo esc_attr( get_theme_mod( 'sempress_bordercolor', 'inherit' ) ); ?>;
        }
        article.comment {
            border-top: 1px solid <?php echo esc_attr( get_theme_mod( 'sempress_shadowcolor', 'inherit' ) ); ?>;
        }
    </style>
<?php
}

/**
 * Show credits in page footer
 */
function sempress_child_credits() {
?>
    Except otherwise noted, any text and media content is covered by a
    <a href="http://creativecommons.org/licenses/by-sa/4.0/">Creative Commons Attribution-Share Alike 4.0 International-license</a>
    and any code by an
    <a href="https://mit-license.org">MIT license</a>.
    <br />
<?php
}
add_action('sempress_credits', 'sempress_child_credits');

/**
 *  Modify post titles in the edit.php screen.
 *  If the post title is empty, then show max 10 words from the post content instead.
 *  https://wordpress.stackexchange.com/questions/189671/show-excerpt-if-no-title-in-admin-view
 */
function sempress_child_title_from_content() {
    add_filter( 'the_title', function( $title )
    {
        $post = get_post();
        if( is_a( $post, '\WP_Post' ) && ! $post->post_title && $post->post_content )
            $title = wp_trim_words( strip_shortcodes( strip_tags( $post->post_content ) ), 10 );
        return $title;
    } );
}
add_action( 'load-edit.php', 'sempress_child_title_from_content');
add_action( 'load-index.php', 'sempress_child_title_from_content');
