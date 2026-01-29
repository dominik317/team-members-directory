<?php

namespace TeamMembersDirectory\Shortcodes;

use TeamMembersDirectory\Controllers\TeamMemberController;

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
        ];

        //Using controller we get the team members
        $query = TeamMemberController::getTeamMembers($args);

        //Render
        return TeamMemberController::renderGrid($query);
    }
}