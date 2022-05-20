<?php get_header(); ?>

<?php get_template_part('partials/banner-especial'); ?>

<?php
    $escopos = get_terms(array(
        'taxonomy' => 'escopo',
        'hide_empty' => false,
        'fields' => 'ids'
    ));

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 7,
        'tax_query' => array(
            array(
                'taxonomy' => 'escopo',
                'field' => 'term_id',
                'terms' => $escopos,
                'operator' => 'NOT IN'
            )
        )
    );

    $query = new WP_Query($args);
?>

<?php if ($query->have_posts()) : $query->the_post(); ?>
    <!-- Notícia Destaque -->
    <div class="row">
        <div class="col-12">
            <article class="noticia noticia_destaque">
                <?php get_template_part('partials/noticias/item'); ?>
            </article>
        </div>
    </div>
<?php endif; ?>

<hr>

<div class="row">
    <?php while ($query->have_posts()) : $query->the_post(); ?>
        <?php if ($query->current_post > 6) break; ?>
        <?php
            $noticia_class = 'noticia col-12 col-md-6 col-lg-4';

            if ($query->current_post === 4) {
                $noticia_class .= ' d-none d-md-block d-lg-block';
            } elseif ($query->current_post >= 5 ) {
                $noticia_class .= ' d-none d-lg-block';
            }
        ?>
        <article class="<?php echo $noticia_class; ?>">
            <?php get_template_part('partials/noticias/item'); ?>
        </article>
    <?php endwhile; ?>
    <?php wp_reset_query(); ?>
    <div class="col-12">
        <div class="acesso-todas-noticias">
            <hr class="acesso-todas-noticias__separador">
            <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" class="float-right acesso-todas-noticias__link"><?php _e('Acesse mais notícias'); ?></a>
        </div>
    </div>
</div>

<?php if (is_active_sidebar('widget-home')) : ?>
<div class="area-home">
    <div class="row align-items-center justify-content-around">
        <?php dynamic_sidebar('widget-home'); ?>
    </div>
</div>
<?php endif; ?>

<?php if (is_active_sidebar('widget-docs')) : ?>
<div class="row">
    <div class="col-12">
        <div class="area-docs">
            <?php dynamic_sidebar('widget-docs'); ?>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if (is_active_sidebar('widget-gallery') || is_active_sidebar('widget-home-side')) : ?>
<div class="row">
    <?php if (is_active_sidebar('widget-gallery')) : ?>
    <div class="col">
        <div class="area-gallery">
            <?php dynamic_sidebar('widget-gallery'); ?>
        </div>
    </div>
    <?php endif; ?>
    <?php if (is_active_sidebar('widget-home-side')) : ?>
    <div class="col text-center">
        <div class="area-home-side">
            <?php dynamic_sidebar('widget-home-side'); ?>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>

<?php if (is_active_sidebar('widget-atalhos')) : ?>
<div class="row">
    <div class="col-12">
        <div class="area-atalhos">
            <h2 class="area-atalhos__title"><?php _e('Acesso R&aacute;pido'); ?></h2>
            <nav>
                <ul class="area-atalhos__list">
                    <?php dynamic_sidebar('widget-atalhos'); ?>
                </ul>
            </nav>
        </div>
    </div>
</div>
<?php endif; ?>

<div class="row">
    <div class="col-12">
        <h2 class="text-center"><img class="img-fluid mx-auto" src="<?php echo get_template_directory_uri(); ?>/img/menu-campi-title.png" alt="Campi do IFRS"></h2>
        <?php
            // Imprime o menu dos Campi do blog principal, agradecimento ao Muhammad Abdullah - https://wordpress.stackexchange.com/a/264026
            $current_blog_id = get_current_blog_id();

            switch_to_blog(get_main_site_id());

            get_template_part('partials/menus/campi');

            switch_to_blog($current_blog_id);
        ?>
    </div>
</div>

<?php if (is_active_sidebar('widget-banners')) : ?>
<div class="row">
    <div class="col-12">
        <div class="area-banners">
            <hr class="area-banners__separator">
            <?php dynamic_sidebar('widget-banners'); ?>
        </div>
    </div>
</div>
<?php endif; ?>

<?php get_footer(); ?>
