<?php

use TeamMembersDirectory\Providers\TeamMembersServiceProvider;

defined('ABSPATH') || exit;

//Load composer autoload if available
$autoload = __DIR__ . '/../vendor/autoload.php';
if(file_exists($autooload)){
    require $autoload;
}

//Register plugin service provider
themosis()->register(TeamMembersServiceProvider::class);