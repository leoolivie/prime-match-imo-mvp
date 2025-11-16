<?php
if (!defined('ABSPATH')) {
    exit;
}

add_shortcode('prime_match_investor_form', function () {
    ob_start();
    ?>
    <form class="form-grid" data-prime-match-form data-endpoint="investors">
        <div class="form-grid two">
            <label>
                <span><?php esc_html_e('Nome completo', 'prime-match'); ?></span>
                <input type="text" name="name" required />
            </label>
            <label>
                <span><?php esc_html_e('Whatsapp', 'prime-match'); ?></span>
                <input type="text" name="whatsapp" required />
            </label>
        </div>
        <div class="form-grid two">
            <label>
                <span><?php esc_html_e('Ticket mínimo', 'prime-match'); ?></span>
                <input type="text" name="ticket_min" placeholder="R$ 5.000.000" />
            </label>
            <label>
                <span><?php esc_html_e('Ticket máximo', 'prime-match'); ?></span>
                <input type="text" name="ticket_max" placeholder="R$ 40.000.000" />
            </label>
        </div>
        <div class="form-grid two">
            <label>
                <span><?php esc_html_e('Cidade', 'prime-match'); ?></span>
                <input type="text" name="city" placeholder="São Paulo" />
            </label>
            <label>
                <span><?php esc_html_e('Tipologia', 'prime-match'); ?></span>
                <select name="typology">
                    <option value="Residencial">Residencial</option>
                    <option value="Corporate">Corporate</option>
                    <option value="Triple Net">Triple Net</option>
                </select>
            </label>
        </div>
        <label>
            <span><?php esc_html_e('Tese / estratégia', 'prime-match'); ?></span>
            <textarea name="strategy" rows="3"></textarea>
        </label>
        <button type="submit" class="lux-gold-button"><?php esc_html_e('Receber oportunidades', 'prime-match'); ?></button>
    </form>
    <?php
    return ob_get_clean();
});

add_shortcode('prime_match_property_form', function () {
    ob_start();
    ?>
    <form class="form-grid" data-prime-match-form data-endpoint="properties">
        <div class="form-grid two">
            <label>
                <span><?php esc_html_e('Título do ativo', 'prime-match'); ?></span>
                <input type="text" name="title" required />
            </label>
            <label>
                <span><?php esc_html_e('Whatsapp', 'prime-match'); ?></span>
                <input type="text" name="whatsapp" required />
            </label>
        </div>
        <div class="form-grid two">
            <label>
                <span><?php esc_html_e('Cidade', 'prime-match'); ?></span>
                <input type="text" name="city" />
            </label>
            <label>
                <span><?php esc_html_e('Tipologia', 'prime-match'); ?></span>
                <input type="text" name="typology" />
            </label>
        </div>
        <div class="form-grid two">
            <label>
                <span><?php esc_html_e('Valor pedido', 'prime-match'); ?></span>
                <input type="text" name="price" />
            </label>
            <label>
                <span><?php esc_html_e('Cap rate projetado', 'prime-match'); ?></span>
                <input type="text" name="cap_rate" />
            </label>
        </div>
        <label>
            <span><?php esc_html_e('Pitch do ativo', 'prime-match'); ?></span>
            <textarea name="description" rows="3"></textarea>
        </label>
        <button type="submit" class="lux-outline-button"><?php esc_html_e('Enviar para curadoria', 'prime-match'); ?></button>
    </form>
    <?php
    return ob_get_clean();
});

add_shortcode('prime_match_dashboard', function () {
    ob_start();
    ?>
    <section class="dashboard" data-prime-match-dashboard>
        <div class="dashboard__card">
            <p class="card__label"><?php esc_html_e('Investidores ativos', 'prime-match'); ?></p>
            <p class="dashboard__value" data-field="investors">0</p>
        </div>
        <div class="dashboard__card">
            <p class="card__label"><?php esc_html_e('Imóveis auditados', 'prime-match'); ?></p>
            <p class="dashboard__value" data-field="properties">0</p>
        </div>
        <div class="dashboard__card">
            <p class="card__label"><?php esc_html_e('Matches realizados', 'prime-match'); ?></p>
            <p class="dashboard__value" data-field="matches">0</p>
        </div>
    </section>
    <script>
        (function(){
            if (typeof PrimeMatchData === 'undefined') return;
            fetch(PrimeMatchData.restUrl + 'dashboard', {
                headers: {'X-WP-Nonce': PrimeMatchData.nonce}
            })
                .then(response => response.json())
                .then((data) => {
                    document.querySelectorAll('[data-prime-match-dashboard] [data-field]').forEach(function(field) {
                        var key = field.getAttribute('data-field');
                        if (data[key] !== undefined) {
                            field.textContent = data[key];
                        }
                    });
                });
        })();
    </script>
    <?php
    return ob_get_clean();
});
