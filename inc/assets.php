<?php
add_action( 'wp_enqueue_scripts', function() {
    /* Styles */
    /* wp_register_style( $handle, $src, $deps, $ver, $media ); */
    /* wp_enqueue_style( $handle[, $src, $deps, $ver, $media] ); */

    wp_enqueue_style('css-campi', get_stylesheet_directory_uri(). '/css/campi.css', array(), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/css/campi.css'), 'all');

    /* Scripts */
    /* wp_register_script( $handle, $src, $deps, $ver, $in_footer ); */
    /* wp_enqueue_script( $handle[, $src, $deps, $ver, $in_footer] ); */
}, 2 );
