<section class="[ c-section -height-full -padding-bottom ]">
    <div class="o-container">
        <h1 class="o-section-heading">02 - Post Content</h1>
        <div class="o-grid">
            <div class="o-grid__row">
                <div class="o-grid__column">
                    <?php while(have_posts()) : the_post(); ?>
                        <article class="c-post">
                            <time class="c-post__date" datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date('F jS, Y'); ?></time>
                            <?php the_content(); ?>
                        </article>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</section>