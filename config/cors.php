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
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    // ممنوع وضع نجمة هنا طالما supports_credentials مفعّلة
    // نضع جميع الدومينات المحتملة للفرونت إيند ليتعرف عليها السيرفر
    'allowed_origins' => [
        'http://localhost:5173', // للتطوير المحلي
        'http://localhost:3000', // احتياط للمحلي
        'https://mogtab.netlify.app',
        'https://mogtaba.vercel.app',
        'https://mogtaba-front-end-1102mohammed-8454s-projects.vercel.app',
        'https://mogtaba-git-main-1102mohammed-8454s-projects.vercel.app', // الرابط الفرعي المذكور في خطأ الكونسول
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    // إجبارية لمرور الـ Authorization Headers والتوكن بسلاسة
    'supports_credentials' => true,

];
