<?php

use TeamMembersDirectory\PostTypes\TeamMemberPostType;
use TeamMembersDirectory\Admin\TeamMemberFields;
use TeamMembersDirectory\Admin\TeamMembersSaveHandler;
use TeamMembersDirectory\Shortcodes\TeamMembersShortcode;

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
    TeamMembersShortcode::register();
});

//Load plugin styles
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'team-members-directory',
        plugin_dir_url(__DIR__) . 'assets/css/team-members.css',
        [],
        '0.1.0'
    );
});