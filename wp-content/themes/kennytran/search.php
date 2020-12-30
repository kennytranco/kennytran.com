<section class="o-container">
    <div class="o-grid">
        <div class="o-grid__row">
            <div class="o-grid__column">
                <?php if(have_posts()) : ?>
                    <h1><?php _e('Search results for:', 'kennytranco'); ?> <?php echo get_search_query(); ?></h1>
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
