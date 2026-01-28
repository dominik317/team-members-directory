<?php

namespace TeamMembersDirectory\PostTypes;

class TeamMemberPostType{
    public static function register(): void{
        register_post_type('team_member', [
            'labels' => [
                'name'               => __('Team Members', 'team-members-directory'),
                'singular_name'      => __('Team Member', 'team-members-directory'),
                'add_new'            => __('Add New', 'team-members-directory'),
                'add_new_item'       => __('Add New Team Member', 'team-members-directory'),
                'edit_item'          => __('Edit Team Member', 'team-members-directory'),
                'new_item'           => __('New Team Member', 'team-members-directory'),
                'view_item'          => __('View Team Member', 'team-members-directory'),
                'search_items'       => __('Search Team Members', 'team-members-directory'),
                'not_found'          => __('No team members found.', 'team-members-directory'),
                'not_found_in_trash' => __('No team members found in Trash.', 'team-members-directory'),
            ],

            'public'       => false,
            'show_ui'      => true,
            'show_in_menu' => true,
            'menu_icon'    => 'dashicons-groups',

            'supports' => ['title'],

            'has_archive' => false,
            'rewrite'     => false,
            'show_in_rest'=> false,
        ]);
    }
}