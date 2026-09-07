@extends('layouts.main')

@section('content')
<div class="py-12 max-w-7xl mx-auto px-6">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-black text-[#800000]">Agenda & Kegiatan</h1>
        <p class="text-slate-700 font-medium text-sm mt-1">Cari dan filter agenda kegiatan organisasi secara transparan.</p>
    </div>

    <!-- Filter Bar -->
    <form action="{{ route('events') }}" method="GET" class="bg-white p-4 rounded-2xl shadow-sm border border-slate-200 mb-10 flex flex-col md:flex-row gap-4">
        <div class="flex-grow">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama event atau lokasi..." class="w-full border border-slate-300 p-3 rounded-xl text-sm font-medium focus:ring-2 focus:ring-sky-400 outline-none text-slate-900">
        </div>
        <div class="w-full md:w-48">
            <select name="status" class="w-full border border-slate-300 p-3 rounded-xl text-sm font-semibold bg-white focus:ring-2 focus:ring-sky-400 outline-none text-slate-900">
                <option value="">Semua Status</option>
                <option value="upcoming" {{ request('status') == 'upcoming' ? 'selected' : '' }}>Akan Datang</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Batal</option>
            </select>
        </div>
        <button type="submit" class="bg-[#800000] text-white px-6 py-3 rounded-xl font-bold text-sm hover:bg-[#600000] transition">
            <i class="fa-solid fa-filter mr-1"></i> Filter
        </button>
    </form>

    <!-- Event Cards Grid -->
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
                        <span class="absolute top-3 left-3 px-3 py-1 rounded-lg text-xs font-bold text-white shadow
                            {{ $event->status == 'upcoming' ? 'bg-amber-600' : ($event->status == 'completed' ? 'bg-emerald-600' : 'bg-rose-600') }}">
                            {{ strtoupper($event->status) }}
                        </span>
                    </div>
                    <div class="p-6">
                        <h3 class="font-extrabold text-lg text-slate-900 mb-2">{{ $event->title }}</h3>
                        <p class="text-slate-700 text-xs font-semibold mb-2"><i class="fa-regular fa-calendar text-sky-600 mr-1.5"></i> {{ $event->event_date->format('d M Y, H:i') }} WIB</p>
                        <p class="text-slate-700 text-xs font-semibold"><i class="fa-solid fa-location-dot text-sky-600 mr-1.5"></i> {{ $event->location }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12 bg-white rounded-2xl border border-slate-200">
                <p class="text-slate-800 font-bold">Tidak ada event yang sesuai dengan pencarian Anda.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $events->links() }}
    </div>
</div>
@endsection
