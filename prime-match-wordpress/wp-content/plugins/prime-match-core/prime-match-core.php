<?php
/**
 * Plugin Name: Prime Match Core
 * Description: CPTs, REST API e formulários do ecossistema Prime Match.
 * Version: 1.0.0
 * Author: Prime Match Lab
 */

if (!defined('ABSPATH')) {
    exit;
}

define('PRIME_MATCH_CORE_VERSION', '1.0.0');
define('PRIME_MATCH_CORE_PATH', plugin_dir_path(__FILE__));
define('PRIME_MATCH_CORE_URL', plugin_dir_url(__FILE__));

require_once PRIME_MATCH_CORE_PATH . 'includes/class-prime-match-cpt.php';
require_once PRIME_MATCH_CORE_PATH . 'includes/class-prime-match-matchmaker.php';
require_once PRIME_MATCH_CORE_PATH . 'includes/class-prime-match-rest.php';
require_once PRIME_MATCH_CORE_PATH . 'includes/shortcodes.php';

add_action('plugins_loaded', function () {
    new Prime_Match_CPT();
    new Prime_Match_REST();
});

// Admin menu para simulação manual.
add_action('admin_menu', function () {
    add_menu_page(
        __('Prime Match', 'prime-match'),
        __('Prime Match', 'prime-match'),
        'manage_options',
        'prime-match-simulator',
        'prime_match_render_simulator_page',
        'dashicons-admin-multisite',
        30
    );
});

function prime_match_render_simulator_page()
{
    if (!current_user_can('manage_options')) {
        return;
    }
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('Simulador Prime Match', 'prime-match'); ?></h1>
        <p><?php esc_html_e('Use o formulário abaixo para gerar rapidamente propriedades e investidores fictícios para testes.', 'prime-match'); ?></p>
        <form method="post">
            <?php wp_nonce_field('prime_match_simulator', 'prime_match_simulator_nonce'); ?>
            <p>
                <label>
                    <?php esc_html_e('Quantidade de propriedades', 'prime-match'); ?>
                    <input type="number" name="prime_match_seed_properties" min="1" max="10" value="3">
                </label>
            </p>
            <p>
                <label>
                    <?php esc_html_e('Quantidade de investidores', 'prime-match'); ?>
                    <input type="number" name="prime_match_seed_investors" min="1" max="10" value="2">
                </label>
            </p>
            <?php submit_button(__('Popular base', 'prime-match')); ?>
        </form>
    </div>
    <?php

    if (!empty($_POST['prime_match_seed_properties']) && check_admin_referer('prime_match_simulator', 'prime_match_simulator_nonce')) {
        $properties = absint($_POST['prime_match_seed_properties']);
        for ($i = 0; $i < $properties; $i++) {
            wp_insert_post([
                'post_type'   => 'property_listing',
                'post_title'  => 'Cobertura ' . wp_rand(100, 999),
                'post_status' => 'publish',
                'meta_input'  => [
                    'price'    => 'R$ ' . number_format(wp_rand(5, 18), 0, ',', '.') . '.000.000',
                    'city'     => 'São Paulo',
                    'typology' => 'Residencial',
                    'cap_rate' => wp_rand(7, 10) . '%',
                ],
            ]);
        }
    }

    if (!empty($_POST['prime_match_seed_investors']) && check_admin_referer('prime_match_simulator', 'prime_match_simulator_nonce')) {
        $investors = absint($_POST['prime_match_seed_investors']);
        for ($i = 0; $i < $investors; $i++) {
            wp_insert_post([
                'post_type'   => 'investor_profile',
                'post_title'  => 'Investidor ' . wp_rand(1000, 9999),
                'post_status' => 'publish',
                'meta_input'  => [
                    'ticket_min' => wp_rand(3, 5) . 'M',
                    'ticket_max' => wp_rand(8, 15) . 'M',
                    'city'       => 'São Paulo',
                    'typology'   => 'Residencial',
                ],
            ]);
        }
    }
}
