<?php
function campi_theme_features()  {
    // Remove o suporte a cabeçalhos personalizados.
    remove_theme_support('custom-header');
}

add_action('after_setup_theme', 'campi_theme_features');
