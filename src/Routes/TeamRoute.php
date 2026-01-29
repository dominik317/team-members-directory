<?php

namespace TeamMembersDirectory\Routes;

use TeamMembersDirectory\Controllers\TeamMemberController;

class TeamRoute
{
    public static function register(): void
    {
        // Add rewrite rule
        add_action('init', [self::class, 'addRewriteRule']);
        
        // Add query var
        add_filter('query_vars', [self::class, 'addQueryVar']);
        
        // Template redirect
        add_action('template_redirect', [self::class, 'templateRedirect']);
    }

    public static function addRewriteRule(): void
    {
        $slug = apply_filters('team_members_route_slug', 'team');
        add_rewrite_rule(
            '^' . $slug . '/?$',
            'index.php?team_members_page=1',
            'top'
        );
    }

    public static function addQueryVar($vars): array
    {
        $vars[] = 'team_members_page';
        return $vars;
    }

    public static function templateRedirect(): void
    {
        if (get_query_var('team_members_page')) {
            self::render();
            exit;
        }
    }

    private static function render(): void
    {
        //Using controller we get the team members
        $query = TeamMemberController::getTeamMembers();

        // Load template
        include __DIR__ . '/../../views/team-page.php';
    }
}