<?php
function campi_load_styles() {
    /* wp_register_style( $handle, $src, $deps, $ver, $media ); */
    /* wp_enqueue_style( $handle[, $src, $deps, $ver, $media] ); */

    wp_enqueue_style('css-campi', get_stylesheet_directory_uri().(WP_DEBUG ? '/css/campi.css' : '/css/campi.min.css'), array(), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/css/campi.min.css'), 'all');
}

function campi_load_scripts() {
    /* wp_register_script( $handle, $src, $deps, $ver, $in_footer ); */
    /* wp_enqueue_script( $handle[, $src, $deps, $ver, $in_footer] ); */

    if (!is_admin()) {
        wp_deregister_script('jquery');
    }
}

add_action( 'wp_enqueue_scripts', 'campi_load_styles', 2 );
add_action( 'wp_enqueue_scripts', 'campi_load_scripts', 2 );
