<?php

namespace TeamMembersDirectory\Controllers;

class TeamMemberController
{
    public static function getTeamMembers(array $args = []): \WP_Query{
        $defaults = [
            'post_type' => 'team_member',
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC',
            'post_status' => 'publish',
        ];

        $args = wp_parse_args($args, $defaults);

        return new \WP_Query($args);
    }

    public static function prepareTeamMemberData(int $post_id): array{
        return [
            'id' => $post_id,
            'full_name' => get_field('full_name', $post_id),
            'role_title' => get_field('role_title', $post_id),
            'email' => get_field('email', $post_id),
            'photo' => get_field('photo', $post_id),
            'bio' => get_field('bio', $post_id),
        ];
    }

    public static function renderGrid(\WP_Query $query): string{
        if (!$query->have_posts()) {
            return '<p class="team-members-empty">No team members found.</p>';
        }

        ob_start();

        echo '<div class="team-members-grid">';

        while ($query->have_posts()) {
            $query->the_post();
            $post_id = get_the_ID();
            
            // Extract variables for the view
            extract(self::prepareTeamMemberData($post_id));
            
            include __DIR__ . '/../../views/team-member-card.php';
        }

        echo '</div>';

        wp_reset_postdata();

        return ob_get_clean();
    }
}