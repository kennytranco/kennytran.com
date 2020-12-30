<section class="o-container">
    <div class="o-grid">
        <div class="o-grid__row">
            <div class="o-grid__column">
                <?php if(have_posts()) : ?>
                    <h1>
                        <?php if(is_day()) : ?>
                            <span><?php _e('Articles from:', 'kennytranco'); ?> </span><?php echo get_the_date(); ?>
                        <?php elseif(is_month()) : ?>
                            <span><?php _e('Articles from:', 'kennytranco'); ?> </span><?php echo get_the_date('F Y'); ?>
                        <?php elseif(is_year()) : ?>
                            <span><?php _e('Articles from:', 'kennytranco'); ?> </span><?php echo get_the_date('Y'); ?>
                        <?php else : ?>
                            <?php _e('Archive', 'kennytranco'); ?>
                        <?php endif; ?>
                    </h1>

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
