<div class="row">
    <div class="col-xs-12">
        <h2 class="noticia-titulo"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <?php
            $categories = get_the_category();
            $cat_name = $categories[0]->cat_name;
            $cat_ID = $categories[0]->term_id;
        ?>
        <p class="noticia-meta">
        <?php if (!is_category()) : ?>
            <span class="noticia-cartola">
                <a href="<?php echo get_category_link($cat_ID); ?>"><?php echo $cat_name; ?></a>
            </span>
            -
        <?php endif; ?>
            <span class="noticia-data"><?php echo get_the_date(); ?></span>
        </p>
        <div class="noticia-resumo">
            <?php the_excerpt(); ?>
        </div>
    </div>
</div>
