<?php
add_action('after_setup_theme', function()  {
    // Remove menu usado somente no tema principal.
    unregister_nav_menu( 'campi' );
}, 20);
