@extends('layouts.main')

@section('content')
<!-- Hero Section -->
<div class="relative bg-gradient-to-br from-[#800000] via-[#5c0000] to-[#360000] text-white overflow-hidden py-20 px-6">
    <div class="max-w-5xl mx-auto text-center relative z-10 space-y-6">
        <span class="inline-block px-4 py-1.5 rounded-full bg-sky-400/20 text-sky-300 text-xs font-bold tracking-widest uppercase border border-sky-400/30">
            Official Web Portal
        </span>
        <h1 class="text-4xl sm:text-6xl font-black tracking-tight leading-tight text-white">
            {{ $profile->org_name ?? 'Selamat Datang' }}
        </h1>
        <p class="text-sky-100 max-w-2xl mx-auto text-lg font-medium leading-relaxed">
            Wadah komunikasi, transformasi kegiatan, dan ruang aspirasi publik secara terintegrasi dan akuntabel.
        </p>
        <div class="pt-2 flex flex-wrap justify-center gap-4">
            <a href="{{ route('profile') }}" class="px-8 py-3.5 rounded-xl bg-white text-[#800000] font-extrabold shadow-lg hover:bg-sky-50 transition transform hover:-translate-y-0.5">
                Jelajahi Profil
            </a>
            <a href="{{ route('aspiration') }}" class="px-8 py-3.5 rounded-xl bg-sky-400 text-slate-900 font-extrabold shadow-lg hover:bg-sky-300 transition transform hover:-translate-y-0.5">
                Kirim Aspirasi
            </a>
        </div>
    </div>
</div>

<!-- Section Event Mendatang -->
<div class="max-w-7xl mx-auto px-6 py-16">
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-10">
        <div>
            <span class="text-xs font-bold uppercase tracking-widest text-sky-600">Agenda Kegiatan</span>
            <h2 class="text-3xl font-black text-[#800000] mt-1">Event Mendatang</h2>
        </div>
        <a href="{{ route('events') }}" class="mt-4 md:mt-0 inline-flex items-center font-bold text-sky-700 hover:text-sky-900 transition">
            Lihat Semua Event <i class="fa-solid fa-arrow-right ml-2 text-sm"></i>
        </a>
    </div>

    <div class="grid md:grid-cols-3 gap-8">
        @forelse($events as $event)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden flex flex-col justify-between hover:shadow-lg transition">
                <div>
                    <div class="relative h-48 bg-slate-100">
                        @if($event->banner)
                            <img src="{{ asset('storage/' . $event->banner) }}" class="w-full h-full object-cover" alt="{{ $event->title }}">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-500">
                                <i class="fa-regular fa-image text-3xl"></i>
                            </div>
                        @endif
                        <span class="absolute top-3 left-3 bg-slate-900 text-white text-xs font-bold px-3 py-1.5 rounded-lg shadow">
                            <i class="fa-regular fa-calendar-check text-sky-400 mr-1"></i> {{ $event->event_date->format('d M Y') }}
                        </span>
                    </div>

                    <div class="p-6">
                        <h3 class="font-extrabold text-lg text-slate-900 line-clamp-2 mb-2">{{ $event->title }}</h3>
                        <p class="text-slate-700 text-xs font-semibold flex items-center">
                            <i class="fa-solid fa-location-dot text-sky-600 mr-2"></i> {{ $event->location }}
                        </p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-16 text-center bg-white rounded-2xl border border-slate-200">
                <i class="fa-regular fa-calendar-xmark text-4xl text-slate-400 mb-3 block"></i>
                <p class="text-slate-800 font-bold">Belum ada agenda event mendatang saat ini.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
