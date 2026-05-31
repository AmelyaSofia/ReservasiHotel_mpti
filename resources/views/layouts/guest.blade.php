<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'Sistem Reservasi Hotel — pesan kamar hotel terbaik dengan mudah.')">
    <title>@yield('title', 'Selamat Datang') — HotelKu</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=cormorant-garamond:400,500,600,700|jost:300,400,500,600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full" style="background-color: #1A1510;">

{{-- Split Layout --}}
<div class="min-h-screen flex">

    {{-- ── Left Panel: Branding ── --}}
    <div class="hidden lg:flex lg:w-1/2 relative flex-col items-center justify-center px-16"
         style="background: linear-gradient(160deg, #2A1D14 0%, #1A1510 50%, #3D2B1F 100%);">

        {{-- Subtle texture pattern --}}
        <div class="absolute inset-0 opacity-5"
             style="background-image: repeating-linear-gradient(45deg, #B8935A 0, #B8935A 1px, transparent 0, transparent 50%); background-size: 20px 20px;">
        </div>

        {{-- Top corner ornament --}}
        <div class="absolute top-8 left-8 w-16 h-16 border-t border-l border-[#B8935A]/40"></div>
        <div class="absolute bottom-8 right-8 w-16 h-16 border-b border-r border-[#B8935A]/40"></div>

        <div class="relative text-center">
            {{-- Logo --}}
            <div class="flex items-center justify-center gap-3 mb-10">
                <div class="w-px h-8 bg-[#B8935A]/60"></div>
                <p class="text-[#B8935A] text-xs tracking-[0.4em] uppercase font-medium">Luxury Collection</p>
                <div class="w-px h-8 bg-[#B8935A]/60"></div>
            </div>

            <h1 class="text-6xl font-light text-white mb-2" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.05em;">
                Hotel<span class="italic text-[#D4B896]">Ku</span>
            </h1>
            <div class="w-16 h-px bg-[#B8935A] mx-auto my-6"></div>
            <p class="text-[#A89880] text-sm tracking-widest uppercase font-light">
                Where Elegance Meets Comfort
            </p>

            {{-- Feature list --}}
            <div class="mt-16 space-y-5 text-left">
                @foreach([
                    ['★', 'Kamar Premium', 'Dirancang untuk kenyamanan tertinggi'],
                    ['◈', 'Reservasi Mudah', 'Proses pemesanan cepat dan aman'],
                    ['◇', 'Layanan 24 Jam', 'Kami selalu siap melayani Anda'],
                ] as $item)
                <div class="flex items-start gap-4">
                    <span class="text-[#B8935A] text-lg mt-0.5">{{ $item[0] }}</span>
                    <div>
                        <p class="text-white text-sm font-medium">{{ $item[1] }}</p>
                        <p class="text-[#705F4A] text-xs mt-0.5">{{ $item[2] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ── Right Panel: Form ── --}}
    <div class="flex-1 flex flex-col items-center justify-center px-6 py-12 lg:px-16"
         style="background-color: #F7F4EE;">

        {{-- Mobile Logo --}}
        <div class="lg:hidden text-center mb-10">
            <h1 class="text-4xl font-light text-[#2A1D14]" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.05em;">
                Hotel<span class="italic text-[#B8935A]">Ku</span>
            </h1>
            <div class="w-10 h-px bg-[#B8935A] mx-auto mt-3"></div>
        </div>

        {{-- Flash Messages --}}
        @if (session('success'))
            <div class="w-full max-w-md mb-6 alert-success">
                <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="w-full max-w-md mb-6 alert-error">
                <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('error') }}
            </div>
        @endif

        {{-- Content --}}
        <div class="w-full max-w-md">
            @yield('content')
        </div>

        <p class="mt-10 text-[#A89880] text-xs tracking-widest uppercase">
            &copy; {{ date('Y') }} HotelKu · All Rights Reserved
        </p>
    </div>
</div>

</body>
</html>
