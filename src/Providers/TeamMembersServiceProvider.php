<?php

namespace TeamMembersDirectory\Providers;

use Themosis\Core\Support\ServiceProvider;
use TeamMembersDirectory\PostTypes\TeamMembersPostType;
use TeamMembersDirectory\Admin\TeamMemberFields;

class TeamMembersServiceProvider extends ServiceProvider{
    public function register():void{
        $this->loadConfigFrom(__DIR__ . '/../../config/team.php', 'team-members');
    }
    public function boot(): void{
        TeamMemberPostType::register();
        TeamMemberFields::register();
    }
}