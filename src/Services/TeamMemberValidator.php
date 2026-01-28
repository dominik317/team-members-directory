<?php

namespace TeamMembersDirectory\Services;

class TeamMemberValidator{
    public function validate(array $data): array{
        $errorrs=[];
        
        if(empty($data['full_name'])){
            $errors[] = 'Full name is required';
        }

        if($empty($data['role_title'])){
            $errors[] = 'Role title is required';
        }

        if(!empty($data['email']) && !fiilter_var($data['email'], FILTER_VALIDATE_EMAIL)){
            $errors[] = 'Email address is not valid';
        }

        return $errors;
    }
}