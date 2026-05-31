<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'Sistem Reservasi Hotel — pesan kamar hotel terbaik dengan mudah.')">
    <title>@yield('title', 'Selamat Datang') — HotelKu</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-gradient-to-br from-slate-900 via-blue-950 to-slate-900">

{{-- Decorative blobs --}}
<div class="fixed inset-0 overflow-hidden pointer-events-none" aria-hidden="true">
    <div class="absolute -top-40 -right-32 w-96 h-96 bg-blue-500/20 rounded-full blur-3xl"></div>
    <div class="absolute top-1/2 -left-40 w-80 h-80 bg-indigo-500/15 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-20 right-1/4 w-72 h-72 bg-blue-400/10 rounded-full blur-3xl"></div>
</div>

<div class="relative min-h-full flex flex-col items-center justify-center px-4 py-12">

    {{-- Logo --}}
    <a href="{{ url('/') }}" class="flex items-center gap-3 mb-8 group">
        <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30 group-hover:scale-110 transition-transform duration-200">
            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0H5m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
        </div>
        <span class="text-2xl font-bold text-white tracking-tight">HotelKu</span>
    </a>

    {{-- Flash Messages --}}
    @if (session('success'))
        <div class="w-full max-w-md mb-4 alert-success">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="w-full max-w-md mb-4 alert-error">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('error') }}
        </div>
    @endif

    {{-- Card Utama --}}
    <div class="w-full max-w-md">
        @yield('content')
    </div>

    {{-- Footer --}}
    <p class="mt-8 text-slate-500 text-xs">
        &copy; {{ date('Y') }} HotelKu. Seluruh hak cipta dilindungi.
    </p>
</div>

</body>
</html>
