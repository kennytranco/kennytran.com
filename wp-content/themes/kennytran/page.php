<section class="o-container">
    <div class="o-grid">
        <div class="o-grid__row">
            <div class="o-grid__column">
                <?php while(have_posts()) : the_post(); ?>
                    <?php get_template_part('partials/content', 'page'); ?>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</section>
