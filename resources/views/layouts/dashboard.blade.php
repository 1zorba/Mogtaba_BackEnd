<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>

    {{-- Vite --}}
    @vite([
        'resources/css/app.css',
        'resources/css/dashboard.css',
        'resources/js/app.js',
        'resources/js/dashboard.js'
    ])

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
     {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    
    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    {{-- Font Awesome 6.7.2 (فقط هذه النسخة لمنع التعارض) --}}
 </head>

<body class="bg-slate-950 text-white overflow-x-hidden font-['Cairo']">

    <div class="dashboard-wrapper" id="dashboardWrapper">

        {{-- Sidebar --}}
        @include('dashboard.components.sidebar')

        <div class="dashboard-main">
            {{-- Page Content --}}
            <main class="dashboard-content">
                @yield('content')
            </main>
        </div>

    </div>

</body>
</html>