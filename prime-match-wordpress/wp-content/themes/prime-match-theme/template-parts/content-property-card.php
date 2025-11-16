<?php
$meta = get_query_var('prime_match_property_meta');
?>
<article class="property-card">
    <div class="property-card__image">
        <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('large'); ?>
        <?php else : ?>
            <img src="https://images.unsplash.com/photo-1505691938895-1758d7feb511?auto=format&fit=crop&w=900&q=80" alt="<?php the_title_attribute(); ?>">
        <?php endif; ?>
    </div>
    <div class="property-card__body">
        <span class="badge"><?php echo esc_html($meta['typology'] ?? __('Residencial', 'prime-match')); ?></span>
        <h3 style="font-size:1.35rem; margin:0;">
            <?php the_title(); ?>
        </h3>
        <p style="color:rgba(255,255,255,0.6);">
            <?php echo esc_html($meta['city'] ?: __('Cidade confidencial', 'prime-match')); ?>
        </p>
        <div class="property-card__meta">
            <span><?php echo esc_html($meta['price'] ?: __('Sob consulta', 'prime-match')); ?></span>
            <span><?php echo esc_html($meta['cap_rate'] ?: '7,5% cap'); ?></span>
        </div>
    </div>
</article>
