<?php
add_action( 'wp_enqueue_scripts', function() {
    /* wp_register_style( $handle, $src, $deps, $ver, $media ); */
    /* wp_enqueue_style( $handle[, $src, $deps, $ver, $media] ); */

    wp_enqueue_style('css-campi', get_stylesheet_directory_uri(). '/css/campi.css', array(), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/css/campi.css'), 'all');
}, 2 );

add_action( 'wp_enqueue_scripts', function() {
    /* wp_register_script( $handle, $src, $deps, $ver, $in_footer ); */
    /* wp_enqueue_script( $handle[, $src, $deps, $ver, $in_footer] ); */

    if (!is_admin()) {
        wp_deregister_script('jquery');
    }
}, 2 );
