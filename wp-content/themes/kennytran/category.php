<section class="o-container">
    <div class="o-grid">
        <div class="o-grid__row">
            <div class="o-grid__column">
                <?php if(have_posts()) : ?>
                    <h1><?php echo single_cat_title(); ?></h1>
                    <?php while(have_posts()) : the_post(); ?>
                        <?php get_template_part('partials/content', get_post_format()); ?>
                    <?php endwhile; ?>
                    <?php get_template_part('partials/pagination'); ?>
                <?php else : ?>
                    <?php get_template_part('partials/content'); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
