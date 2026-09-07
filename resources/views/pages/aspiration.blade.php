@extends('layouts.main')

@section('content')
<div class="py-12 max-w-5xl mx-auto px-6">
    <div class="text-center mb-10">
        <h1 class="text-3xl font-black text-[#800000]">Pusat Aspirasi & Progress</h1>
        <p class="text-slate-700 font-medium text-sm mt-1">Suarakan aspirasi Anda dan pantau status tanggapan admin secara otomatis.</p>
    </div>

    <div class="grid md:grid-cols-2 gap-8 items-start">
        <!-- Form Aspirasi -->
        <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
            <h2 class="text-xl font-extrabold text-slate-900 mb-6 flex items-center">
                <i class="fa-solid fa-paper-plane text-[#800000] mr-2"></i> Kirim Aspirasi
            </h2>

            @if(session('success_code'))
                <div class="bg-sky-50 border border-sky-300 text-sky-900 p-4 rounded-xl mb-6">
                    <p class="text-xs text-sky-800 font-bold uppercase tracking-wider mb-1">Aspirasi Berhasil Terkirim</p>
                    <p class="text-xs text-slate-800 font-medium">Kode Tracking Anda:</p>
                    <div class="bg-white px-4 py-2.5 rounded-xl font-mono font-bold text-lg text-[#800000] border border-sky-200 mt-2 text-center select-all">
                        {{ session('success_code') }}
                    </div>
                </div>
            @endif

            <form action="{{ route('aspiration.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-800 uppercase mb-1">Nama (Opsional)</label>
                    <input type="text" name="sender_name" placeholder="Isi 'Anonim' jika dikosongkan" class="w-full border border-slate-300 rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-sky-400 outline-none text-slate-900">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-800 uppercase mb-1">Email (Opsional)</label>
                    <input type="email" name="email" placeholder="email@contoh.com" class="w-full border border-slate-300 rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-sky-400 outline-none text-slate-900">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-800 uppercase mb-1">Kategori <span class="text-red-600">*</span></label>
                    <select name="category" required class="w-full border border-slate-300 rounded-xl p-3 text-sm font-semibold focus:ring-2 focus:ring-sky-400 outline-none text-slate-900 bg-white">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Saran">Saran</option>
                        <option value="Kritik">Kritik</option>
                        <option value="Pengaduan">Pengaduan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-800 uppercase mb-1">Pesan Aspirasi <span class="text-red-600">*</span></label>
                    <textarea name="message" required placeholder="Tuliskan pesan Anda..." rows="4" class="w-full border border-slate-300 rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-sky-400 outline-none text-slate-900"></textarea>
                </div>
                <button type="submit" class="bg-[#800000] text-white w-full py-3.5 rounded-xl font-extrabold hover:bg-[#600000] shadow transition">
                    Kirim Aspirasi
                </button>
            </form>
        </div>

        <!-- Progress Tracking -->
        <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
            <h2 class="text-xl font-extrabold text-slate-900 mb-6 flex items-center">
                <i class="fa-solid fa-magnifying-glass text-sky-600 mr-2"></i> Cek Status Progress
            </h2>

            <form action="{{ route('aspiration.check') }}" method="GET" class="flex gap-2 mb-6">
                <input type="text" name="tracking_code" placeholder="Kode (cth: ASP-XXXX)" required class="border border-slate-300 p-3 rounded-xl text-sm font-semibold flex-grow focus:ring-2 focus:ring-sky-400 outline-none text-slate-900">
                <button type="submit" class="bg-sky-400 text-slate-900 px-5 py-3 rounded-xl text-sm font-extrabold hover:bg-sky-300 transition">
                    Cek
                </button>
            </form>

            @if(session('error'))
                <div class="bg-rose-50 border border-rose-200 text-rose-700 p-3.5 rounded-xl text-sm mb-4 font-bold">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('aspiration_result'))
                @php
                    $res = session('aspiration_result');
                    $res = is_object($res) ? $res->toArray() : $res;
                @endphp
                <div class="border-t border-slate-200 pt-5 space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-xs font-bold text-slate-700 uppercase">Status Progress</span>
                        <span class="px-3.5 py-1 text-xs rounded-full font-extrabold text-white
                            {{ $res['status'] == 'completed' ? 'bg-emerald-600' : ($res['status'] == 'process' ? 'bg-sky-600' : ($res['status'] == 'rejected' ? 'bg-rose-600' : 'bg-amber-600')) }}">
                            {{ strtoupper($res['status']) }}
                        </span>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-700 uppercase mb-1">Pesan Anda</p>
                        <p class="text-sm text-slate-900 bg-slate-100 p-3.5 rounded-xl font-medium border border-slate-200">{{ $res['message'] }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-700 uppercase mb-1">Tanggapan Admin</p>
                        <p class="text-sm text-slate-900 bg-sky-50 p-3.5 rounded-xl font-medium border border-sky-200">
                            {{ $res['admin_response'] ?? 'Belum ada tanggapan dari admin.' }}
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
