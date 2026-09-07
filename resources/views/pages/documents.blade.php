@extends('layouts.main')

@section('content')
<div class="py-12 max-w-6xl mx-auto px-6">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-black text-[#800000]">Download Center & Bank Soal</h1>
        <p class="text-slate-700 font-medium text-sm mt-1">Unduh modul pembelajaran, bank soal ujian, template surat, dan berkas resmi.</p>
    </div>

    <!-- Filter Form -->
    <form action="{{ route('documents') }}" method="GET" class="bg-white p-4 rounded-2xl shadow-sm border border-slate-200 mb-8 flex flex-col md:flex-row gap-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama berkas/modul..." class="flex-grow border border-slate-300 p-3 rounded-xl text-sm font-medium focus:ring-2 focus:ring-sky-400 outline-none text-slate-900">
        <select name="category" class="border border-slate-300 p-3 rounded-xl text-sm font-semibold bg-white focus:ring-2 focus:ring-sky-400 outline-none text-slate-900">
            <option value="">Semua Kategori</option>
            <option value="Bank Soal" {{ request('category') == 'Bank Soal' ? 'selected' : '' }}>Bank Soal Ujian</option>
            <option value="Modul" {{ request('category') == 'Modul' ? 'selected' : '' }}>Modul Pembelajaran</option>
            <option value="Template" {{ request('category') == 'Template' ? 'selected' : '' }}>Template Surat / Proposal</option>
            <option value="Legalitas" {{ request('category') == 'Legalitas' ? 'selected' : '' }}>AD/ART & SK</option>
        </select>
        <button type="submit" class="bg-[#800000] text-white px-6 py-3 rounded-xl font-bold text-sm hover:bg-[#600000] transition">Cari</button>
    </form>

    <!-- Documents List -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden divide-y divide-slate-100">
        @forelse($documents as $doc)
            <div class="p-5 flex items-center justify-between hover:bg-slate-50 transition">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-xl bg-sky-100 text-sky-800 flex items-center justify-center font-bold text-xl">
                        <i class="fa-solid fa-file-arrow-down"></i>
                    </div>
                    <div>
                        <h4 class="font-extrabold text-slate-900 text-base">{{ $doc->title }}</h4>
                        <div class="flex items-center space-x-3 text-xs text-slate-700 mt-1 font-semibold">
                            <span class="bg-slate-200 text-slate-800 px-2.5 py-0.5 rounded-full">{{ $doc->category }}</span>
                            <span><i class="fa-solid fa-download text-sky-600 mr-1"></i> {{ $doc->download_count }}x diunduh</span>
                        </div>
                    </div>
                </div>
                <a href="{{ route('documents.download', $doc->id) }}" class="bg-[#800000] text-white px-4 py-2.5 rounded-xl font-bold text-xs hover:bg-[#600000] transition flex items-center">
                    <i class="fa-solid fa-download mr-1.5"></i> Unduh
                </a>
            </div>
        @empty
            <div class="p-12 text-center text-slate-800 font-bold">
                Belum ada berkas dokumen yang tersedia.
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $documents->links() }}
    </div>
</div>
@endsection
