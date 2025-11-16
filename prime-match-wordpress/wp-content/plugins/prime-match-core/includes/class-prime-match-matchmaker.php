<?php
class Prime_Match_Matchmaker
{
    public function match_investor($investor_id)
    {
        $ticket_min = (float) preg_replace('/[^0-9.]/', '', get_post_meta($investor_id, 'ticket_min', true));
        $ticket_max = (float) preg_replace('/[^0-9.]/', '', get_post_meta($investor_id, 'ticket_max', true));
        $city       = get_post_meta($investor_id, 'city', true);
        $typology   = get_post_meta($investor_id, 'typology', true);

        $query_args = [
            'post_type'      => 'property_listing',
            'posts_per_page' => 12,
            'meta_query'     => [
                'relation' => 'AND',
                [
                    'key'     => 'city',
                    'value'   => $city,
                    'compare' => 'LIKE',
                ],
                [
                    'key'     => 'typology',
                    'value'   => $typology,
                    'compare' => 'LIKE',
                ],
            ],
        ];

        $results = get_posts($query_args);
        $matches = [];

        foreach ($results as $property) {
            $price = (float) preg_replace('/[^0-9.]/', '', get_post_meta($property->ID, 'price', true));
            if (!$price) {
                continue;
            }
            if (($ticket_min && $price < $ticket_min * 1000000) || ($ticket_max && $price > $ticket_max * 1000000)) {
                continue;
            }
            $match_id = wp_insert_post([
                'post_type'   => 'match_record',
                'post_status' => 'publish',
                'post_title'  => sprintf(__('Match %1$s → %2$s', 'prime-match'), get_the_title($investor_id), get_the_title($property->ID)),
                'meta_input'  => [
                    'investor_id' => $investor_id,
                    'property_id' => $property->ID,
                ],
            ]);
            $matches[] = [
                'match_id'     => $match_id,
                'property_id'  => $property->ID,
                'property_name'=> get_the_title($property->ID),
                'city'         => get_post_meta($property->ID, 'city', true),
                'price'        => get_post_meta($property->ID, 'price', true),
            ];
        }

        return $matches;
    }
}
