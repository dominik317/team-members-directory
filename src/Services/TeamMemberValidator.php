<?php

namespace TeamMembersDirectory\Services;

class TeamMemberValidator{
    public function validate(array $data): array{
        $errors=[];
        
        if(empty($data['full_name'])){
            $errors[] = 'Full name is required';
        }

        if(empty($data['role_title'])){
            $errors[] = 'Role title is required';
        }

        if(!empty($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
            $errors[] = 'Email address is not valid';
        }

        return $errors;
    }
}