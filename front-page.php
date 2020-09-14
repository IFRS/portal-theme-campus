<?php get_header(); ?>

<?php
    $escopos = get_terms(array(
        'taxonomy' => 'escopo',
        'hide_empty' => false,
        'fields' => 'ids'
    ));

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 8,
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

<div class="row">
    <?php while ($query->have_posts()) : $query->the_post(); ?>
        <?php switch ($query->current_post) :
            case 0: ?>
                <div class="col-12 col-lg-8">
                    <article class="noticia noticia_destaque">
                        <?php get_template_part('partials/noticias/item'); ?>
                    </article>
            <?php break; ?>
            <?php case 1: ?>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <article class="noticia">
                                <?php get_template_part('partials/noticias/item'); ?>
                            </article>
                        </div>
            <?php break; ?>
            <?php case 2: ?>
                        <div class="col-12 col-lg-6">
                            <article class="noticia">
                                <?php get_template_part('partials/noticias/item'); ?>
                            </article>
                        </div>
                    </div> <!-- /.row -->
                </div> <!-- /.col-12 .col-lg-8 -->
            <?php break; ?>
            <?php case 3: ?>
                <div class="col-12 col-lg-4">
                    <article class="noticia">
                        <?php get_template_part('partials/noticias/item-list'); ?>
                    </article>
            <?php break; ?>
            <?php case 4: ?>
                    <article class="noticia">
                        <?php get_template_part('partials/noticias/item-list'); ?>
                    </article>
            <?php break; ?>
            <?php case 5: ?>
                    <div class="noticias-simples mt-3">
                        <article class="noticia noticia_simples">
                            <?php get_template_part('partials/noticias/item-simple'); ?>
                        </article>
            <?php break; ?>
            <?php case 6: ?>
                        <article class="noticia noticia_simples">
                            <?php get_template_part('partials/noticias/item-simple'); ?>
                        </article>
                    </div> <!-- /.noticias-simples -->
                </div> <!-- /.col-12 .col-lg-4 -->
            <?php break; ?>
            <?php default: ?>
        <?php endswitch; ?>
    <?php endwhile; ?>
    <div class="col-12">
        <?php wp_reset_query(); ?>
        <div class="acesso-todas-noticias">
            <hr class="acesso-todas-noticias__separador">
            <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" class="float-right acesso-todas-noticias__link"><?php _e('Acesse mais notícias'); ?></a>
        </div>
    </div>
</div>

<div class="row">
<?php if (is_active_sidebar('widget-home')) : ?>
    <div class="text-center col-12<?php echo is_active_sidebar('widget-carousel') ? ' col-md-6' : ''; ?>">
        <?php dynamic_sidebar('widget-home'); ?>
    </div>
<?php endif; ?>
<?php if (is_active_sidebar('widget-carousel')) : ?>
    <div class="col text-center">
        <?php get_template_part('partials/carousel'); ?>
    </div>
<?php endif; ?>
</div>

<?php if (is_active_sidebar('widget-docs')) : ?>
<div class="row">
    <div class="col-12">
        <div class="area-docs">
            <?php dynamic_sidebar('widget-docs'); ?>
        </div>
    </div>
</div>
<?php endif; ?>


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
