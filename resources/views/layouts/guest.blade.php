<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'Sistem Reservasi Hotel — pesan kamar hotel terbaik dengan mudah.')">
    <title>@yield('title', 'Selamat Datang') — Royal Crown Hotel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full">

{{-- Split Layout --}}
<div class="min-h-screen flex">

    {{-- ── Left Panel: Hotel Photo Background ── --}}
    <div class="hidden lg:flex lg:w-[55%] relative flex-col items-center justify-end"
         style="min-height: 100vh;">

        {{-- Hotel exterior photo background --}}
        <div class="absolute inset-0"
             style="background-image: url('/images/hotel-exterior.jpg'); background-size: cover; background-position: center top;">
        </div>

        {{-- Dark gradient overlay --}}
        <div class="absolute inset-0"
             style="background: linear-gradient(to top, rgba(20,12,6,0.92) 0%, rgba(20,12,6,0.55) 40%, rgba(20,12,6,0.25) 100%);">
        </div>

        {{-- Content overlay --}}
        <div class="relative z-10 w-full px-14 pb-16">

            {{-- Hotel star rating --}}
            <div class="flex items-center gap-1.5 mb-5">
                @for ($i = 0; $i < 5; $i++)
                <svg class="w-3.5 h-3.5 text-[#C9A96E]" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
                @endfor
                <span class="text-[#C9A96E] text-xs tracking-[0.2em] ml-1" style="font-family: 'Montserrat', sans-serif;">BINTANG LIMA</span>
            </div>

            {{-- Hotel name --}}
            <h1 class="text-4xl font-semibold text-white mb-1" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.02em; text-shadow: 0 2px 20px rgba(0,0,0,0.5);">
                Royal Crown
            </h1>
            <h2 class="text-4xl font-normal italic text-[#D4B896] mb-6" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.02em; text-shadow: 0 2px 20px rgba(0,0,0,0.5);">
                Hotel
            </h2>

            {{-- Divider --}}
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-px bg-[#B8935A]"></div>
                <p class="text-[#B8935A] text-xs tracking-[0.3em] uppercase" style="font-family: 'Montserrat', sans-serif;">Est. 1924</p>
                <div class="w-12 h-px bg-[#B8935A]"></div>
            </div>

            {{-- Tagline --}}
            <p class="text-white/70 text-sm leading-relaxed mb-8 max-w-sm" style="font-family: 'Montserrat', sans-serif;">
                Pengalaman menginap yang tak terlupakan dalam balutan keanggunan klasik dan kehangatan layanan kelas dunia.
            </p>

            {{-- Features --}}
            <div class="grid grid-cols-3 gap-4">
                @foreach([
                    ['241', 'Kamar Suite'],
                    ['24/7', 'Layanan Tamu'],
                    ['★5', 'Penghargaan'],
                ] as $feat)
                <div class="border-l border-[#B8935A]/40 pl-3">
                    <p class="text-white text-lg font-semibold" style="font-family: 'Cormorant Garamond', serif;">{{ $feat[0] }}</p>
                    <p class="text-white/50 text-xs" style="font-family: 'Montserrat', sans-serif;">{{ $feat[1] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ── Right Panel: Form ── --}}
    <div class="flex-1 flex flex-col items-center justify-center px-6 py-12 lg:px-14"
         style="background-color: #FAF7F2;">

        {{-- Mobile Logo --}}
        <div class="lg:hidden text-center mb-10">
            <h1 class="text-2xl font-semibold text-[#2A1D14]" style="font-family: 'Cormorant Garamond', serif;">
                Royal Crown <em class="italic font-normal text-[#B8935A]">Hotel</em>
            </h1>
            <div class="gold-line mx-auto mt-3"></div>
        </div>

        {{-- Flash Messages --}}
        @if (session('success'))
            <div class="w-full max-w-sm mb-5 alert-success">
                <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="w-full max-w-sm mb-5 alert-error">
                <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('error') }}
            </div>
        @endif

        {{-- Content --}}
        <div class="w-full max-w-sm">
            @yield('content')
        </div>

        <p class="mt-10 text-[#A89880] text-xs tracking-[0.15em] uppercase" style="font-family: 'Montserrat', sans-serif;">
            &copy; {{ date('Y') }} Royal Crown Hotel &middot; All Rights Reserved
        </p>
    </div>
</div>

</body>
</html>
