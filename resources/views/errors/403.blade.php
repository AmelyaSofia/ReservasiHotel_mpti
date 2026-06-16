<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 — Akses Ditolak | Royal Crown Hotel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full flex items-center justify-center px-4" style="background-color: #FAF7F2;">

<div class="text-center max-w-md mx-auto">

    {{-- Gold ornamental line --}}
    <div class="flex items-center justify-center gap-4 mb-8">
        <div class="w-12 h-px" style="background: linear-gradient(to right, transparent, rgba(184,147,90,0.5));"></div>
        <span class="text-[#B8935A] text-xs">◆</span>
        <div class="w-12 h-px" style="background: linear-gradient(to left, transparent, rgba(184,147,90,0.5));"></div>
    </div>

    {{-- Icon --}}
    <div class="w-20 h-20 flex items-center justify-center mx-auto mb-6 border border-[#EDE8DC]" style="background-color: #F7F4EE;">
        <svg class="w-10 h-10 text-[#8C2323]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
        </svg>
    </div>

    {{-- Error Code --}}
    <p class="text-6xl font-semibold text-[#2A1D14] mb-2" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.05em;">
        403
    </p>

    {{-- Title --}}
    <h1 class="text-xl font-light text-[#2A1D14] mb-3" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.02em;">
        Akses Ditolak
    </h1>

    {{-- Description --}}
    <p class="text-sm text-[#8C7B65] mb-8 leading-relaxed" style="font-family: 'Montserrat', sans-serif;">
        {{ $exception->getMessage() ?: 'Anda tidak memiliki izin untuk mengakses halaman ini.' }}
    </p>

    {{-- Actions --}}
    <div class="flex items-center justify-center gap-3">
        <a href="{{ url()->previous() }}" class="btn-outline py-2.5 px-6">
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>
        <a href="{{ url('/') }}" class="btn-primary py-2.5 px-6">
            Beranda
        </a>
    </div>

    {{-- Footer branding --}}
    <div class="mt-12">
        <p class="text-xs text-[#A89880] tracking-[0.15em] uppercase" style="font-family: 'Montserrat', sans-serif;">
            Royal Crown <em class="text-[#B8935A] not-italic">Hotel</em> · Luxury Collection
        </p>
    </div>

    {{-- Gold ornamental line --}}
    <div class="flex items-center justify-center gap-4 mt-6">
        <div class="w-12 h-px" style="background: linear-gradient(to right, transparent, rgba(184,147,90,0.5));"></div>
        <span class="text-[#B8935A] text-xs">◆</span>
        <div class="w-12 h-px" style="background: linear-gradient(to left, transparent, rgba(184,147,90,0.5));"></div>
    </div>
</div>

</body>
</html>
