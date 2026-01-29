<?php

namespace TeamMembersDirectory\Admin;

use TeamMembersDirectory\Services\TeamMemberValidator;

class TeamMembersSaveHandler{
    public static function register(): void{
        add_action('save_post_team_member', [self::class, 'validate'], 10, 3);

        // Show admin notice if ACF is not installed
        add_action('admin_notices', [self::class, 'acfRequiredNotice']);

        // Block access to add/edit screens if ACF is not installed
        if (!function_exists('get_field')) {
            add_action('load-post-new.php', [self::class, 'blockAccess']);
            add_action('load-post.php', [self::class, 'blockAccess']);
            add_action('admin_head', [self::class, 'disableAddNewButton']);
        }
    }

    public static function blockAccess(): void {
        global $typenow;
        if ($typenow === 'team_member') {
            wp_die(
                '<h1>ACF Plugin Required</h1><p>Advanced Custom Fields (ACF) plugin must be installed and activated to manage team members.</p>',
                'ACF Required',
                ['back_link' => true]
            );
        }
    }

    public static function acfRequiredNotice(): void {
        $screen = get_current_screen();
        if ($screen && $screen->post_type === 'team_member' && !function_exists('get_field')) {
            echo '<div class="notice notice-error"><p><strong>Team Members Directory:</strong> Advanced Custom Fields (ACF) plugin is required. Please install and activate ACF to manage team members.</p></div>';
        }
    }

    public static function disableAddNewButton(): void {
        $screen = get_current_screen();
        if ($screen && $screen->post_type === 'team_member') {
            echo '<style>.page-title-action{pointer-events:none;opacity:0.5;cursor:not-allowed;title:"ACF required";}</style>';
        }
    }

    public static function validate(int $postId, \WP_Post $post, bool $update): void{
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (! current_user_can('edit_post', $postId)) {
            return;
        }

        // Check if ACF is available
        if (!function_exists('get_field')) {
            return;
        }

        $data = [
            'full_name'  => get_field('full_name', $postId),
            'role_title' => get_field('role_title', $postId),
            'email'      => get_field('email', $postId),
        ];

        $validator = new TeamMemberValidator();
        $errors    = $validator->validate($data);

        if (! empty($errors)) {
            remove_action('save_post_team_member', [self::class, 'validate']);

            wp_update_post([
                'ID'          => $postId,
                'post_status' => 'draft',
            ]);

            add_action('admin_notices', function () use ($errors) {
                foreach ($errors as $error) {
                    echo '<div class="notice notice-error"><p>' . esc_html($error) . '</p></div>';
                }
            });

            add_action('save_post_team_member', [self::class, 'validate'], 10, 3);
        }
    }
}