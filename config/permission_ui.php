<?php

return [
    'middleware'        => ['web', 'auth','role:Admin'],
    'url_prefix'        => 'permissions',
    'route_name_prefix' => 'permission_ui.',
];
