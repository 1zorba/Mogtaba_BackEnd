<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'],
    'allowed_methods' => ['*'],
    // هنا نضع الروابط المحددة فقط ونحذف النجمة نهائياً
    'allowed_origins' => [
        // 'https://mogtaba-front-end.vercel.app/',
        // 'https://mogtaba-front-end-1102mohammed-8454s-projects.vercel.app', // الرابط الذي يظهر في الخطأ عندك
        // 'http://localhost:5173', 
        // للتطوير المحلي
        'allowed_origins' => ['*'],
        'https://mogtab.netlify.app',
    ],
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true, // ضرورية لأنك تستخدم Sanctum
];
