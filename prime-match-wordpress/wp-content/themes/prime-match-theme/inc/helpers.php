<?php
if (!defined('ABSPATH')) {
    exit;
}

function prime_match_get_properties($limit = 6)
{
    $args = [
        'post_type'      => 'property_listing',
        'posts_per_page' => $limit,
        'post_status'    => 'publish',
    ];
    $query = new WP_Query($args);
    return $query;
}

function prime_match_render_property_card($post_id)
{
    $price    = get_post_meta($post_id, 'price', true);
    $city     = get_post_meta($post_id, 'city', true);
    $typology = get_post_meta($post_id, 'typology', true);
    $cap_rate = get_post_meta($post_id, 'cap_rate', true);

    set_query_var('prime_match_property_meta', compact('price', 'city', 'typology', 'cap_rate'));
    get_template_part('template-parts/content', 'property-card');
}
