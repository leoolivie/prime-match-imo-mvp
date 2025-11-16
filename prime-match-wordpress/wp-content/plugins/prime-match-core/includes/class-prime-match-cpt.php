<?php
class Prime_Match_CPT
{
    public function __construct()
    {
        add_action('init', [$this, 'register_post_types']);
        add_action('init', [$this, 'register_meta']);
    }

    public function register_post_types()
    {
        register_post_type('property_listing', [
            'label'        => __('Propriedades', 'prime-match'),
            'public'       => true,
            'supports'     => ['title', 'editor', 'thumbnail'],
            'show_in_rest' => true,
            'menu_icon'    => 'dashicons-building',
        ]);

        register_post_type('investor_profile', [
            'label'        => __('Investidores', 'prime-match'),
            'public'       => false,
            'show_ui'      => true,
            'supports'     => ['title', 'editor'],
            'show_in_rest' => true,
            'menu_icon'    => 'dashicons-groups',
        ]);

        register_post_type('broker_lead', [
            'label'     => __('Leads Broker', 'prime-match'),
            'public'    => false,
            'show_ui'   => true,
            'supports'  => ['title', 'editor'],
            'menu_icon' => 'dashicons-businessman',
        ]);

        register_post_type('match_record', [
            'label'     => __('Matches', 'prime-match'),
            'public'    => false,
            'show_ui'   => true,
            'supports'  => ['title'],
            'menu_icon' => 'dashicons-randomize',
        ]);
    }

    public function register_meta()
    {
        $meta_fields = [
            'price',
            'city',
            'typology',
            'cap_rate',
            'ticket_min',
            'ticket_max',
            'strategy',
            'whatsapp',
        ];

        foreach ($meta_fields as $field) {
            register_post_meta('property_listing', $field, [
                'type'         => 'string',
                'single'       => true,
                'show_in_rest' => true,
            ]);
            register_post_meta('investor_profile', $field, [
                'type'         => 'string',
                'single'       => true,
                'show_in_rest' => true,
            ]);
        }
    }
}
