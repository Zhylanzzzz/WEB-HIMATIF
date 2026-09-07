@extends('layouts.main')

@section('content')
<div class="py-12 max-w-5xl mx-auto px-6 space-y-12">
    <div class="text-center">
        <h1 class="text-3xl md:text-4xl font-black text-[#800000]">Profil Organisasi</h1>
        <p class="text-slate-700 font-medium text-sm mt-1">Mengenal lebih dekat sejarah, visi, dan misi {{ $profile->org_name ?? 'HIMA IF' }}.</p>
    </div>

    <!-- Card Sejarah -->
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
        <h2 class="text-xl font-bold text-[#800000] mb-4 flex items-center">
            <i class="fa-solid fa-[#800000] fa-book-open text-sky-600 mr-2.5"></i> Sejarah Organisasi
        </h2>
        <div class="prose max-w-none text-slate-800 text-sm leading-relaxed font-normal">
            {!! $profile->history ?? 'Informasi sejarah belum diisi.' !!}
        </div>
    </div>

    <!-- Grid Visi & Misi -->
    <div class="grid md:grid-cols-2 gap-8">
        <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
            <h2 class="text-xl font-bold text-[#800000] mb-4 flex items-center">
                <i class="fa-solid fa-eye text-sky-600 mr-2.5"></i> Visi
            </h2>
            <div class="prose max-w-none text-slate-800 text-sm leading-relaxed">
                {!! $profile->vision ?? 'Informasi visi belum diisi.' !!}
            </div>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
            <h2 class="text-xl font-bold text-[#800000] mb-4 flex items-center">
                <i class="fa-solid fa-bullseye text-sky-600 mr-2.5"></i> Misi
            </h2>
            <div class="prose max-w-none text-slate-800 text-sm leading-relaxed">
                {!! $profile->mission ?? 'Informasi misi belum diisi.' !!}
            </div>
        </div>
    </div>
</div>
@endsection
