<?php

namespace TeamMembersDirectory\Admin;

use TeamMembersq\Services\TeamMemberValidator;

class TeamMemberSaveHandler{
    public static function register(): void{
        add_action('save_post_team_member', [self::class, 'validate'], 10, 3);

    }

    public static function validate(): void{
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (! current_user_can('edit_post', $postId)) {
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