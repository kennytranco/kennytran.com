<section class="[ c-section -height-full ]">
    <div class="o-container">
        <h1 class="o-section-heading">02 - Posts</h1>
        <div class="o-grid">
            <div class="o-grid__row">
                <div class="o-grid__column">
                    <?php while(have_posts()) : the_post(); ?>
                        <article class="c-post-excerpt">
                            <time class="c-post-excerpt__date" datetime="<?php echo get_the_date('Y/m/d'); ?>"><?php echo get_the_date('F jS, Y'); ?></time>
                            <h2 class="c-post-excerpt__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <?php $tags = get_tags(array('hide_empty' => true)); ?>
                            <?php if(!empty($tags)) : ?>
                                <ul class="c-post-excerpt__tags">
                                    <?php foreach($tags as $tag) : ?>
                                        <li>
                                            <a href="<?php bloginfo('url');?>/blog/tag/<?php print_r($tag->slug);?>">#<?php print_r($tag->name); ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </article>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</section>