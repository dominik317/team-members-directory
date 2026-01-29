<?php

namespace TeamMembersDirectory\Shortcodes;

class TeamMembersShortcode
{
    public static function register(): void
    {
        add_shortcode('team_members', [self::class, 'render']);
    }

    public static function render($atts = []): string
    {
        $atts = shortcode_atts([
            'limit' => -1,
            'order' => 'ASC',
            'orderby' => 'title',
        ], $atts);

        $args = [
            'post_type' => 'team_member',
            'posts_per_page' => intval($atts['limit']),
            'orderby' => sanitize_text_field($atts['orderby']),
            'order' => sanitize_text_field($atts['order']),
            'post_status' => 'publish',
        ];

        $query = new \WP_Query($args);

        if (!$query->have_posts()) {
            return '<p class="team-members-empty">No team members found.</p>';
        }

        ob_start();

        echo '<div class="team-members-grid">';

        while ($query->have_posts()) {
            $query->the_post();
            $post_id = get_the_ID();

            // Get ACF fields
            $full_name = get_field('full_name', $post_id);
            $role_title = get_field('role_title', $post_id);
            $email = get_field('email', $post_id);
            $photo = get_field('photo', $post_id);
            $bio = get_field('bio', $post_id);

            // Render team member card
            include __DIR__ . '/../../views/team-member-card.php';
        }

        echo '</div>';

        wp_reset_postdata();

        return ob_get_clean();
    }
}