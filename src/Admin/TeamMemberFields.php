<?php

namespace TeamMembersDirectory\Admin;

class TeamMemberFields{
    public static function register(): void{
       if(!function_exists('acf_add_local_field_group')){
            return;
       }

       acf_add_local_field_group([
            'key' => 'group_team_member',
            'title' => 'Team Member Details',
            'fields' => [
                [
                    'key'   => 'field_full_name',
                    'label' => 'Full Name',
                    'name'  => 'full_name',
                    'type'  => 'text',
                    'required' => 1,
                ],
                [
                    'key'   => 'field_role_title',
                    'label' => 'Role Title',
                    'name'  => 'role_title',
                    'type'  => 'text',
                    'required' => 1,
                ],
                [
                    'key'   => 'field_email',
                    'label' => 'Email',
                    'name'  => 'email',
                    'type'  => 'email',
                    'required' => 0,
                ],
                [
                    'key'   => 'field_photo',
                    'label' => 'Photo',
                    'name'  => 'photo',
                    'type'  => 'image',
                    'return_format' => 'id',
                    'preview_size'  => 'thumbnail',
                    'library'       => 'all',
                ],
                [
                    'key'   => 'field_bio',
                    'label' => 'Bio',
                    'name'  => 'bio',
                    'type'  => 'textarea',
                ],
            ],
            'location' => [
                [
                    [
                        'param'    => 'post_type',
                        'operator' => '==',
                        'value'    => 'team_member',
                    ],
                ],
            ],
       ]);
    }
}