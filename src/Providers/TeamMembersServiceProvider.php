<?php

namespace TeamMembersDirectory\Providers;

use Themosis\Core\Support\ServiceProvider;
use TeamMembersDirectory\PostTypes\TeamMemberPostType;
use TeamMembersDirectory\Admin\TeamMemberFields;
use TeamMembersDirectory\admin\TeamMemberSaveHandler;

class TeamMembersServiceProvider extends ServiceProvider{
    public function register():void{
        $this->loadConfigFrom(__DIR__ . '/../../config/team.php', 'team-members');
    }
    public function boot(): void{
        TeamMemberPostType::register();
        TeamMemberFields::register();
        TeamMemberSaveHandler::register();
    }
}