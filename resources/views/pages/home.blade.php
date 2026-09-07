@extends('layouts.main')

@section('content')
<!-- Hero Section Warna Marun & Teks Akses Biru Muda -->
<div class="bg-[#800000] text-white py-20 text-center px-4">
    <h1 class="text-4xl md:text-5xl font-extrabold mb-4 text-white">{{ $profile->org_name ?? 'Selamat Datang' }}</h1>
    <p class="text-sky-200 max-w-2xl mx-auto text-lg">Official Website Profil Organisasi & Pusat Informasi Kegiatan.</p>
</div>

<!-- Event Section -->
<div class="max-w-7xl mx-auto px-4 py-16">
    <h2 class="text-3xl font-bold text-center text-[#800000] mb-8">Event Mendatang</h2>
    <div class="grid md:grid-cols-3 gap-6">
        @forelse($events as $event)
            <div class="bg-white rounded-xl shadow-sm border border-sky-100 overflow-hidden">
                @if($event->banner)
                    <img src="{{ asset('storage/' . $event->banner) }}" class="w-full h-48 object-cover" alt="{{ $event->title }}">
                @endif
                <div class="p-6">
                    <span class="text-xs bg-sky-100 text-sky-800 px-3 py-1 rounded-full font-semibold">
                        {{ $event->event_date->format('d M Y, H:i') }} WIB
                    </span>
                    <h3 class="font-bold text-xl mt-3 mb-2 text-gray-900">{{ $event->title }}</h3>
                    <p class="text-gray-600 text-sm mb-4">📍 {{ $event->location }}</p>
                </div>
            </div>
        @empty
            <p class="text-center col-span-full text-gray-500">Belum ada event mendatang.</p>
        @endforelse
    </div>
</div>
@endsection
