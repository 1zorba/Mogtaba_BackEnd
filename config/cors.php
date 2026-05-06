<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    // ركز هنا: تأكد أنها مصفوفة تحتوي على نصوص
    'allowed_origins' => [
        // خطأ
        'allowed_origins' => 'https://mogtab.netlify.app',

        // صح
        'allowed_origins' => ['https://mogtab.netlify.app'],
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true, // اجعلها true إذا كنت تستخدم Login/Authm
];
