<section class="[ c-section -height-full ]">
    <div class="o-container">
        <h1 class="o-section-heading">02 - Posts</h1>
        <div class="o-grid">
            <div class="o-grid__row">
                <div class="o-grid__column">
                    <?php while(have_posts()) : the_post(); ?>
                        <?php get_template_part('template-parts/content/post-excerpt'); ?>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</section>