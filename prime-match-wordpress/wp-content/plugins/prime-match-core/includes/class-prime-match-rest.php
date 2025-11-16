<?php
class Prime_Match_REST
{
    public function __construct()
    {
        add_action('rest_api_init', [$this, 'register_routes']);
    }

    public function register_routes()
    {
        register_rest_route('prime-match/v1', '/investors', [
            'methods'             => 'POST',
            'callback'            => [$this, 'create_investor'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('prime-match/v1', '/properties', [
            'methods'             => 'POST',
            'callback'            => [$this, 'create_property'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('prime-match/v1', '/dashboard', [
            'methods'             => 'GET',
            'callback'            => [$this, 'get_dashboard'],
            'permission_callback' => [$this, 'verify_nonce'],
        ]);
    }

    public function create_investor(WP_REST_Request $request)
    {
        $data = $this->sanitize_payload($request);
        $post_id = wp_insert_post([
            'post_type'   => 'investor_profile',
            'post_title'  => $data['name'] ?? 'Investidor',
            'post_status' => 'publish',
            'meta_input'  => [
                'ticket_min' => $data['ticket_min'] ?? '',
                'ticket_max' => $data['ticket_max'] ?? '',
                'city'       => $data['city'] ?? '',
                'typology'   => $data['typology'] ?? '',
                'strategy'   => $data['strategy'] ?? '',
                'whatsapp'   => $data['whatsapp'] ?? '',
            ],
        ]);

        if (is_wp_error($post_id)) {
            return new WP_Error('prime_match_investor_error', __('Não foi possível salvar o investidor.', 'prime-match'), ['status' => 500]);
        }

        $matchmaker = new Prime_Match_Matchmaker();
        $matches    = $matchmaker->match_investor($post_id);

        return rest_ensure_response([
            'id'      => $post_id,
            'matches' => $matches,
            'message' => __('Investidor registrado com sucesso.', 'prime-match'),
        ]);
    }

    public function create_property(WP_REST_Request $request)
    {
        $data = $this->sanitize_payload($request);
        $post_id = wp_insert_post([
            'post_type'   => 'property_listing',
            'post_title'  => $data['title'] ?? 'Imóvel confidencial',
            'post_status' => 'publish',
            'post_content'=> $data['description'] ?? '',
            'meta_input'  => [
                'price'    => $data['price'] ?? '',
                'city'     => $data['city'] ?? '',
                'typology' => $data['typology'] ?? '',
                'cap_rate' => $data['cap_rate'] ?? '',
                'strategy' => $data['strategy'] ?? '',
                'whatsapp' => $data['whatsapp'] ?? '',
            ],
        ]);

        if (is_wp_error($post_id)) {
            return new WP_Error('prime_match_property_error', __('Não foi possível salvar o imóvel.', 'prime-match'), ['status' => 500]);
        }

        return rest_ensure_response([
            'id'      => $post_id,
            'message' => __('Imóvel cadastrado. Entraremos em contato em até 72h.', 'prime-match'),
        ]);
    }

    public function get_dashboard()
    {
        $investors = wp_count_posts('investor_profile')->publish ?? 0;
        $properties = wp_count_posts('property_listing')->publish ?? 0;
        $matches = wp_count_posts('match_record')->publish ?? 0;

        return [
            'investors'  => (int) $investors,
            'properties' => (int) $properties,
            'matches'    => (int) $matches,
        ];
    }

    private function sanitize_payload(WP_REST_Request $request)
    {
        $body = $request->get_json_params();
        if (empty($body)) {
            $body = $request->get_params();
        }
        return array_map('sanitize_text_field', (array) $body);
    }

    public function verify_nonce(WP_REST_Request $request)
    {
        $nonce = $request->get_header('X-WP-Nonce');
        return wp_verify_nonce($nonce, 'wp_rest');
    }
}
