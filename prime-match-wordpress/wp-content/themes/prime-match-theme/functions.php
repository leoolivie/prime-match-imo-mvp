<?php
/**
 * Prime Match Theme bootstrap.
 */

define('PRIME_MATCH_THEME_VERSION', '1.0.0');

defined('ABSPATH') || exit;

require_once get_template_directory() . '/inc/helpers.php';
require_once get_template_directory() . '/inc/template-tags.php';

add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('editor-styles');
    add_theme_support('custom-logo');
    register_nav_menus([
        'primary' => __('Menu principal', 'prime-match'),
        'footer'  => __('Menu rodapé', 'prime-match'),
    ]);
});

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'prime-match-theme',
        get_stylesheet_uri(),
        [],
        PRIME_MATCH_THEME_VERSION
    );

    $dist_css = get_template_directory_uri() . '/dist/theme.css';
    if (file_exists(get_template_directory() . '/dist/theme.css')) {
        wp_enqueue_style('prime-match-theme-dist', $dist_css, ['prime-match-theme'], PRIME_MATCH_THEME_VERSION);
    }

    wp_enqueue_script(
        'prime-match-theme',
        get_template_directory_uri() . '/assets/js/theme.js',
        [],
        PRIME_MATCH_THEME_VERSION,
        true
    );

    wp_localize_script('prime-match-theme', 'PrimeMatchData', [
        'restUrl' => esc_url_raw(rest_url('prime-match/v1/')),
        'nonce'   => wp_create_nonce('wp_rest'),
    ]);
});

add_filter('body_class', function ($classes) {
    $classes[] = 'prime-match-body';
    return $classes;
});

add_action('init', function () {
    register_post_type('case_story', [
        'label' => __('Cases Prime', 'prime-match'),
        'public' => false,
        'show_ui' => true,
        'supports' => ['title', 'editor', 'thumbnail'],
    ]);
});
