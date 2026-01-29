<?php

use TeamMembersDirectory\PostTypes\TeamMemberPostType;
use TeamMembersDirectory\Admin\TeamMemberFields;
use TeamMembersDirectory\Admin\TeamMembersSaveHandler;

defined('ABSPATH') || exit;

//Load composer autoload if available
$autoload = __DIR__ . '/../vendor/autoload.php';
if(file_exists($autoload)){
    require $autoload;
}

//Register plugin components
add_action('init', function () {
    TeamMemberPostType::register();
    TeamMemberFields::register();
    TeamMembersSaveHandler::register();
});