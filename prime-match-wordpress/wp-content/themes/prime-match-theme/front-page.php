<?php get_header(); ?>

<main class="section">
    <div class="lux-container section">
        <section class="hero">
            <p class="hero__badge"><?php esc_html_e('Coleção Prime', 'prime-match'); ?></p>
            <h1 class="hero__title"><?php esc_html_e('Matchmaking imobiliário cinematográfico', 'prime-match'); ?></h1>
            <p class="hero__subtitle">
                <?php esc_html_e('Experiência concierge com curadoria humana, tecnologia proprietária e governança jurídica para conectar investidores, incorporadores e imóveis ultra prime antes do mercado aberto.', 'prime-match'); ?>
            </p>
            <div class="grid-two" style="margin-top:2.5rem">
                <div class="card">
                    <p class="card__label"><?php esc_html_e('Pipeline ativo', 'prime-match'); ?></p>
                    <p class="card__value">+<?php echo esc_html(wp_count_posts('property_listing')->publish ?? 0); ?> assets</p>
                </div>
                <div class="card">
                    <p class="card__label"><?php esc_html_e('Investidores qualificados', 'prime-match'); ?></p>
                    <p class="card__value">+<?php echo esc_html(wp_count_posts('investor_profile')->publish ?? 0); ?></p>
                </div>
            </div>
            <div style="margin-top:2rem; display:flex; gap:1rem; flex-wrap:wrap;">
                <a class="lux-gold-button" href="#investor-form"><?php esc_html_e('Sou investidor', 'prime-match'); ?></a>
                <a class="lux-outline-button" href="#property-form"><?php esc_html_e('Tenho um ativo', 'prime-match'); ?></a>
            </div>
        </section>
    </div>

    <section class="section" id="prime-properties">
        <div class="lux-container">
            <?php prime_match_section_heading(
                __('Coleção destaque', 'prime-match'),
                __('Imóveis auditados com concierge dedicado', 'prime-match')
            ); ?>
            <div class="properties">
                <?php
                $properties = prime_match_get_properties();
                if ($properties->have_posts()) :
                    while ($properties->have_posts()) :
                        $properties->the_post();
                        prime_match_render_property_card(get_the_ID());
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p>' . esc_html__('Cadastre o primeiro imóvel para ver o grid.', 'prime-match') . '</p>';
                endif;
                ?>
            </div>
        </div>
    </section>

    <section class="section" id="investor-form">
        <div class="lux-container">
            <?php prime_match_section_heading(
                __('Investidor, receba o dossiê em 4h', 'prime-match'),
                __('Nossa squad cruza cap rate, localização e tipologia para enviar até 12 oportunidades curadas.', 'prime-match')
            ); ?>
            <div class="form-card">
                <?php echo do_shortcode('[prime_match_investor_form]'); ?>
            </div>
        </div>
    </section>

    <section class="section" id="property-form">
        <div class="lux-container">
            <?php prime_match_section_heading(
                __('Master brokers e incorporadores', 'prime-match'),
                __('Envie o ativo com compliance pronto e receba respostas em até 72h.', 'prime-match')
            ); ?>
            <div class="form-card">
                <?php echo do_shortcode('[prime_match_property_form]'); ?>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="lux-container">
            <?php prime_match_contact_block(); ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
