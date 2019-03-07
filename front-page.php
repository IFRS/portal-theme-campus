<?php get_header(); ?>

<?php
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 5
    );

    $query = new WP_Query($args);
?>

<div class="row">
    <div class="col-12 col-lg-8">
        <?php while ($query->have_posts() && $query->current_post < 1) : $query->the_post(); ?>
            <article class="noticia noticia_destaque">
                    <?php get_template_part('partials/noticias/item'); ?>
            </article>
        <?php endwhile; ?>
    </div>
    <div class="col-12 col-lg-4">
        <div class="noticia-list">
            <?php while ($query->have_posts() && $query->current_post < 4) : $query->the_post(); ?>
                <article class="noticia">
                    <?php get_template_part('partials/noticias/item-list'); ?>
                </article>
            <?php endwhile; ?>
        </div>
    </div>
    <div class="col-12">
        <?php wp_reset_query(); ?>
        <div class="acesso-todas-noticias">
            <hr class="acesso-todas-noticias__separador">
            <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" class="float-right acesso-todas-noticias__link"><?php _e('Acesse mais notícias'); ?></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-xl-10 offset-xl-1">
        <?php if (!dynamic_sidebar('widget-home')) : endif; ?>
        <?php get_template_part('partials/carousel'); ?>
    </div>
</div>

<div class="row">
    <div class="col-12 col-lg-6">
        <?php if (!dynamic_sidebar('widget-docs')) : endif; ?>
    </div>
    <div class="col-12 col-lg-6">
        <?php if (!dynamic_sidebar('widget-home-side')) : endif; ?>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <h2 class="text-center"><img class="img-fluid mx-auto" src="<?php echo get_template_directory_uri(); ?>/img/menu-campi-title.png" alt="Campi do IFRS"></h2>
        <?php
            // Imprime o menu dos Campi do blog principal, agradecimento ao Muhammad Abdullah - https://wordpress.stackexchange.com/a/264026
            global $blog_id;
            $current_blog_id = $blog_id;

            //switch to the main blog which will have an id of 1
            switch_to_blog(1);

            //output the WordPress navigation menu - incase of menu-sharing use this
            get_template_part('partials/menus/campi');

            //switch back to the current blog being viewed - before ending of the function
            switch_to_blog($current_blog_id);
        ?>
    </div>
</div>

<?php if (is_active_sidebar('widget-gallery')) : ?>
<div class="row">
    <div class="col-12">
        <?php if (!dynamic_sidebar('widget-gallery')) : endif; ?>
    </div>
</div>
<?php endif; ?>

<?php if (is_active_sidebar('widget-atalhos')) : ?>
<div class="row">
    <div class="col-12">
        <h2 class="title-box"><?php _e('Acesso R&aacute;pido'); ?></h2>
        <nav>
            <ul class="area-atalhos">
                <?php if (!dynamic_sidebar('widget-atalhos')) : endif; ?>
            </ul>
        </nav>
    </div>
</div>
<?php endif; ?>

<div class="row">
    <div class="col-12">
        <div class="area-banners">
            <hr class="area-banners__separator">
            <?php if (!dynamic_sidebar('widget-banners')) : endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
