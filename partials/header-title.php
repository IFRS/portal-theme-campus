<?php if (has_custom_logo()) : ?>
    <h1 class="sr-only"><?php bloginfo('name'); ?></h1>
    <?php the_custom_logo(); ?>
<?php else : ?>
    <a href="<?php echo esc_url(home_url('/')); ?>" class="title-link">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/if.png" alt="" aria-hidden="true" class="title-img" <?php echo getimagesize(get_stylesheet_directory() . '/img/if.png')[3]; ?>/>
        <h1 class="title-campus">
            <small><?php _e('Instituto Federal de Educação, Ciência e Tecnologia do Rio Grande do Sul'); ?></small>
            <br>
            <?php bloginfo('name'); ?>
        </h1>
    </a>
<?php endif; ?>
