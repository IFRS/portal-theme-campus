<?php if (has_custom_logo()) : ?>
    <h1 class="sr-only"><?php bloginfo('name'); ?></h1>
    <?php the_custom_logo(); ?>
<?php else : ?>
    <div class="row">
        <div class="col-12 col-md-2 d-none d-md-block">
            <a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/if.png" alt="Logo do Instituto Federal" class="mx-auto"></a>
        </div>
        <div class="col-12 col-md-10">
            <p class="title-ifrs"><?php _e('Instituto Federal de Educação, Ciência e Tecnologia do Rio Grande do Sul'); ?></p>
            <h1 class="title-campus"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h1>
        </div>
    </div>
<?php endif; ?>
