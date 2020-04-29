<?php
add_action('after_setup_theme', function()  {
    // Remove o suporte a cabeçalhos personalizados.
    remove_theme_support('custom-header');

    // Remove menu usado somente no tema principal.
    unregister_nav_menu( 'campi' );
}, 20);
