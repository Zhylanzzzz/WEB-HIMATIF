@extends('layouts.main')

@section('content')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<div class="py-12 max-w-7xl mx-auto px-6" x-data="{ activeAlbum: null, activeIndex: 0 }">
    <div class="text-center mb-10">
        <h1 class="text-3xl font-black text-[#800000]">Galeri Dokumentasi Kegiatan</h1>
        <p class="text-slate-700 font-medium text-sm mt-1">Dokumentasi momen dan album kegiatan {{ $profile->org_name ?? 'HIMA IF' }}.</p>
    </div>

    <div class="grid md:grid-cols-3 gap-8">
        @forelse($galleries as $gallery)
            @php
                $images = is_array($gallery->images) ? $gallery->images : json_decode($gallery->images, true);
            @endphp
            <div
                @click="activeAlbum = {{ json_encode(['title' => $gallery->title, 'description' => $gallery->description, 'images' => array_map(fn($img) => asset('storage/' . $img), $images ?? [])]) }}; activeIndex = 0"
                class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-xl hover:border-sky-400 transition cursor-pointer group transform hover:-translate-y-1"
            >
                <div class="relative h-52 bg-slate-100 overflow-hidden">
                    @if(!empty($images))
                        <img src="{{ asset('storage/' . $images[0]) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" alt="{{ $gallery->title }}">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-slate-500">
                            <i class="fa-regular fa-image text-3xl"></i>
                        </div>
                    @endif
                    <span class="absolute top-3 right-3 bg-slate-900 text-white font-bold text-xs px-3 py-1 rounded-full shadow">
                        <i class="fa-regular fa-images text-sky-400 mr-1"></i> {{ count($images ?? []) }} Foto
                    </span>
                </div>
                <div class="p-5">
                    <h3 class="font-extrabold text-lg text-slate-900 group-hover:text-[#800000] transition line-clamp-1 mb-1">{{ $gallery->title }}</h3>
                    <p class="text-slate-700 text-xs font-medium line-clamp-2">{{ $gallery->description ?? 'Klik untuk melihat foto.' }}</p>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-16 bg-white rounded-2xl border border-slate-200">
                <p class="text-slate-800 font-bold">Belum ada album dokumentasi yang diunggah.</p>
            </div>
        @endforelse
    </div>

    <!-- Lightbox Modal -->
    <div x-show="activeAlbum !== null" class="fixed inset-0 z-50 bg-slate-950/90 backdrop-blur-md flex items-center justify-center p-4" style="display: none;">
        <div @click.away="activeAlbum = null" class="relative max-w-4xl w-full bg-slate-900 text-white rounded-3xl overflow-hidden shadow-2xl border border-white/10 flex flex-col max-h-[90vh]">
            <div class="p-5 border-b border-white/10 flex justify-between items-center">
                <div>
                    <h3 class="font-bold text-lg text-sky-300" x-text="activeAlbum?.title"></h3>
                    <p class="text-xs text-white/80 font-normal" x-text="activeAlbum?.description"></p>
                </div>
                <button @click="activeAlbum = null" class="w-9 h-9 bg-white/10 rounded-full flex items-center justify-center text-white hover:bg-rose-600 transition"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="relative flex-grow flex items-center justify-center bg-black/50 p-4 min-h-[300px] max-h-[500px]">
                <template x-if="activeAlbum && activeAlbum.images.length > 0">
                    <img :src="activeAlbum.images[activeIndex]" class="max-h-[450px] max-w-full object-contain rounded-xl">
                </template>
                <template x-if="activeAlbum && activeAlbum.images.length > 1">
                    <div class="contents">
                        <button @click="activeIndex = (activeIndex === 0) ? activeAlbum.images.length - 1 : activeIndex - 1" class="absolute left-4 bg-white/20 hover:bg-sky-400 hover:text-slate-900 text-white p-3 rounded-full transition"><i class="fa-solid fa-chevron-left"></i></button>
                        <button @click="activeIndex = (activeIndex === activeAlbum.images.length - 1) ? 0 : activeIndex + 1" class="absolute right-4 bg-white/20 hover:bg-sky-400 hover:text-slate-900 text-white p-3 rounded-full transition"><i class="fa-solid fa-chevron-right"></i></button>
                    </div>
                </template>
            </div>
            <div class="p-4 bg-slate-950 border-t border-white/10 flex space-x-3 overflow-x-auto">
                <template x-for="(img, index) in activeAlbum?.images" :key="index">
                    <img :src="img" @click="activeIndex = index" :class="{ 'ring-2 ring-sky-400 opacity-100': activeIndex === index, 'opacity-50 hover:opacity-100': activeIndex !== index }" class="h-16 w-20 object-cover rounded-lg cursor-pointer transition">
                </template>
            </div>
        </div>
    </div>

    <div class="mt-8">
        {{ $galleries->links() }}
    </div>
</div>
@endsection
