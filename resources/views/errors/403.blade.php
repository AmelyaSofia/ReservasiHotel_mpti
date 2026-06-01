<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 — Akses Ditolak | Royal Crown Hotel</title>
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-gradient-to-br from-slate-900 via-blue-950 to-slate-900 flex items-center justify-center px-4">
<div class="text-center">
    <div class="w-20 h-20 bg-red-500/20 rounded-3xl flex items-center justify-center mx-auto mb-6">
        <svg class="w-10 h-10 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
        </svg>
    </div>
    <p class="text-7xl font-black text-white mb-2">403</p>
    <h1 class="text-xl font-bold text-white mb-2">Akses Ditolak</h1>
    <p class="text-blue-300 text-sm mb-8 max-w-xs mx-auto">{{ $exception->getMessage() ?? 'Anda tidak memiliki izin untuk mengakses halaman ini.' }}</p>
    <div class="flex items-center justify-center gap-3">
        <a href="{{ url()->previous() }}"
            class="inline-flex items-center gap-2 px-5 py-2.5 bg-white/10 border border-white/20 text-white rounded-xl text-sm font-medium hover:bg-white/20 transition-colors">
            ← Kembali
        </a>
        <a href="{{ url('/') }}"
            class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white rounded-xl text-sm font-semibold hover:bg-blue-700 transition-colors">
            Beranda
        </a>
    </div>
</div>
</body>
</html>
