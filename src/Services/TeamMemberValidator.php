<?php

namespace TeamMembersDirectory\Services;

class TeamMemberValidator{
    public static function validate(array $data): array{
        $errors=[];

        if(empty($data['full_name'])){
            $errors['full_name'] = 'Full name is required';
        }

        if(empty($data['role_title'])){
            $errors['role_title'] = 'Role title is required';
        }

        if(!empty($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'Email address is not valid';
        }

        return $errors;
    }
}