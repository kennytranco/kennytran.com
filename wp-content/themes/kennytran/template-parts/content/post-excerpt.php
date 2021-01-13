<article class="c-post-excerpt">
    <time class="c-post-excerpt__date" datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date('F jS, Y'); ?></time>
    <h2 class="c-post-excerpt__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php $tags = get_tags(array('hide_empty' => true)); ?>
    <?php if(!empty($tags)) : ?>
        <ul class="c-post-excerpt__tags">
            <?php foreach($tags as $tag) : ?>
                <li>
                    <a href="<?php bloginfo('url');?>/posts/tags/<?php print_r($tag->slug);?>">#<?php print_r($tag->name); ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</article>