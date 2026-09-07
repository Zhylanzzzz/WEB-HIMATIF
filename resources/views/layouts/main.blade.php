<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profile->org_name ?? 'Profil Organisasi' }}</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS & FontAwesome -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #800000; }

        .navbar-maroon {
            background: linear-gradient(135deg, #7a0000 0%, #520000 100%);
        }

        /* Styling CSS Pohon Struktur Organisasi */
        .tree ul { padding-top: 28px; position: relative; transition: all 0.5s; display: flex; justify-content: center; }
        .tree li { float: left; text-align: center; list-style-type: none; position: relative; padding: 28px 10px 0 10px; transition: all 0.5s; }
        .tree li::before, .tree li::after { content: ''; position: absolute; top: 0; right: 50%; border-top: 2px solid #38bdf8; width: 50%; height: 28px; }
        .tree li::after { right: auto; left: 50%; border-left: 2px solid #38bdf8; }
        .tree li:only-child::after, .tree li:only-child::before { display: none; }
        .tree li:only-child { padding-top: 0; }
        .tree li:first-child::before, .tree li:last-child::after { border: 0 none; }
        .tree li:last-child::before { border-right: 2px solid #38bdf8; border-radius: 0 10px 0 0; }
        .tree li:first-child::after { border-radius: 10px 0 0 0; }
        .tree ul ul::before { content: ''; position: absolute; top: 0; left: 50%; border-left: 2px solid #38bdf8; width: 0; height: 28px; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 flex flex-col min-h-screen antialiased">

    <!-- Header / Navbar -->
    <header class="navbar-maroon text-white sticky top-0 z-50 border-b border-white/10 shadow-lg">
        <div class="max-w-7xl mx-auto px-6 py-3.5 flex justify-between items-center">

            <!-- Logo & Brand Kiri -->
            <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                @if(isset($profile) && $profile->logo_path)
                    <div class="p-1 bg-white rounded-xl shadow-md group-hover:scale-105 transition duration-300">
                        <img src="{{ asset('storage/' . $profile->logo_path) }}" alt="Logo {{ $profile->org_name }}" class="h-8 w-8 object-contain">
                    </div>
                @else
                    <div class="h-9 w-9 bg-white/10 rounded-xl flex items-center justify-center border border-white/20">
                        <span class="text-sky-300 font-extrabold text-lg">H</span>
                    </div>
                @endif

                <span class="font-bold text-base md:text-lg tracking-wide text-white group-hover:text-sky-200 transition line-clamp-1">
                    {{ $profile->org_name ?? 'HIMA IF' }}
                </span>
            </a>

            <!-- Menu Navigasi -->
            <div class="space-x-1 hidden md:flex items-center">
                <a href="{{ route('home') }}" class="px-3 py-2 rounded-lg text-sm font-medium text-white hover:bg-white/10 transition">Beranda</a>
                <a href="{{ route('profile') }}" class="px-3 py-2 rounded-lg text-sm font-medium text-white hover:bg-white/10 transition">Profil</a>
                <a href="{{ route('officers') }}" class="px-3 py-2 rounded-lg text-sm font-medium text-white hover:bg-white/10 transition">Struktur</a>
                <a href="{{ route('events') }}" class="px-3 py-2 rounded-lg text-sm font-medium text-white hover:bg-white/10 transition">Event</a>
                <a href="{{ route('galleries') }}" class="px-3 py-2 rounded-lg text-sm font-medium text-white hover:bg-white/10 transition">Galeri</a>
                <a href="{{ route('documents') }}" class="px-3 py-2 rounded-lg text-sm font-medium text-white hover:bg-white/10 transition">Dokumen</a>

                <a href="{{ route('aspiration') }}" class="ml-2 px-4 py-2 rounded-xl text-sm font-bold bg-white text-[#7a0000] hover:bg-sky-50 shadow-md transition transform hover:-translate-y-0.5">
                    <i class="fa-solid fa-paper-plane mr-1.5 text-sky-600"></i> Aspirasi
                </a>
            </div>

        </div>
    </header>

    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-[#420000] text-white border-t border-white/10 mt-16">
        <div class="max-w-7xl mx-auto px-6 py-10">
            <div class="grid md:grid-cols-3 gap-8 mb-8 pb-8 border-b border-white/10">
                <div>
                    <h3 class="font-bold text-lg text-sky-300 mb-2">{{ $profile->org_name ?? 'HIMA IF' }}</h3>
                    <p class="text-xs text-white/90 leading-relaxed font-normal">
                        Wadah resmi komunikasi, transformasi kegiatan, dan ruang aspirasi mahasiswa secara transparan.
                    </p>
                </div>

                <div>
                    <h4 class="font-bold text-sm text-sky-300 mb-3 uppercase tracking-wider">Sekretariat & Kontak</h4>
                    <ul class="text-xs text-white space-y-2 font-medium">
                        @if(isset($profile) && $profile->address)
                            <li class="flex items-start space-x-2"><i class="fa-solid fa-location-dot text-sky-400 mt-0.5"></i> <span>{{ $profile->address }}</span></li>
                        @endif
                        @if(isset($profile) && $profile->email)
                            <li class="flex items-center space-x-2"><i class="fa-solid fa-envelope text-sky-400"></i> <span>{{ $profile->email }}</span></li>
                        @endif
                        @if(isset($profile) && $profile->phone)
                            <li class="flex items-center space-x-2"><i class="fa-solid fa-phone text-sky-400"></i> <span>{{ $profile->phone }}</span></li>
                        @endif
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-sm text-sky-300 mb-3 uppercase tracking-wider">Sosial Media</h4>
                    <div class="flex items-center space-x-3 text-lg">
                        @if(isset($profile) && $profile->instagram)
                            <a href="{{ $profile->instagram }}" target="_blank" class="w-9 h-9 rounded-lg bg-white/10 flex items-center justify-center hover:bg-sky-400 hover:text-slate-900 transition"><i class="fa-brands fa-instagram"></i></a>
                        @endif
                        @if(isset($profile) && $profile->youtube)
                            <a href="{{ $profile->youtube }}" target="_blank" class="w-9 h-9 rounded-lg bg-white/10 flex items-center justify-center hover:bg-sky-400 hover:text-slate-900 transition"><i class="fa-brands fa-youtube"></i></a>
                        @endif
                        @if(isset($profile) && $profile->github)
                            <a href="{{ $profile->github }}" target="_blank" class="w-9 h-9 rounded-lg bg-white/10 flex items-center justify-center hover:bg-sky-400 hover:text-slate-900 transition"><i class="fa-brands fa-github"></i></a>
                        @endif
                        @if(isset($profile) && $profile->linkedin)
                            <a href="{{ $profile->linkedin }}" target="_blank" class="w-9 h-9 rounded-lg bg-white/10 flex items-center justify-center hover:bg-sky-400 hover:text-slate-900 transition"><i class="fa-brands fa-linkedin"></i></a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="text-xs text-white/80 text-center md:text-left">
                <p>&copy; {{ date('Y') }} {{ $profile->org_name ?? 'Organisasi' }}. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>
</html>
