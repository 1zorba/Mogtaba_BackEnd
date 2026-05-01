<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */
    // ي مسار يبدأ بكلمة api (مثل مسار المهام عندك) سيخضع لقوانين هذا الملف. (صحيح ✅)
    'paths' => ['api/*', 'sanctum/csrf-cookie'],
    //  تسمح بجميع أنواع الطلبات (GET, POST, PUT, DELETE).
    'allowed_methods' => ['*'],
    // تعني أنك تسمح لأي موقع في العالم (بما في ذلك تطبيق ريأكت الخاص بك) بالوصول للـ API. (صحيح للتطوير ✅، لكنه خطر في المواقع الحقيقية ⚠️).    'allowed_origins' => ['*'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,
    'allowed_origins' => ['*'],

    'paths' => ['api/*', 'sanctum/csrf-cookie'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['*'], // هذا السطر هو الأهم لحل المشكلة فوراً
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true,
];
