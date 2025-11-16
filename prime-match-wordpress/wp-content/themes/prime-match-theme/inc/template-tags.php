<?php
if (!defined('ABSPATH')) {
    exit;
}

function prime_match_section_heading($title, $subtitle = '')
{
    ?>
    <header class="section__header">
        <h2 class="section__title"><?php echo esc_html($title); ?></h2>
        <?php if ($subtitle) : ?>
            <p class="section__subtitle"><?php echo esc_html($subtitle); ?></p>
        <?php endif; ?>
    </header>
    <?php
}

function prime_match_contact_block()
{
    ?>
    <div class="card card--glass">
        <p class="card__label"><?php esc_html_e('Concierge dedicado', 'prime-match'); ?></p>
        <p class="section__subtitle">
            <?php esc_html_e('Envie um WhatsApp para +55 14 99684-5854 ou agende um call com o Master para receber o dossiê completo.', 'prime-match'); ?>
        </p>
        <div class="grid-two">
            <a class="lux-gold-button" href="https://wa.me/5514996845854" target="_blank" rel="noopener">
                <?php esc_html_e('Ativar concierge', 'prime-match'); ?>
            </a>
            <a class="lux-outline-button" href="mailto:concierge@primematchimo.com">
                <?php esc_html_e('Solicitar dossiê', 'prime-match'); ?>
            </a>
        </div>
    </div>
    <?php
}
