@extends('layouts.main')

@section('content')
<div class="py-12 max-w-7xl mx-auto px-6 overflow-x-auto">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-black text-[#800000]">Struktur Organisasi</h1>
        <p class="text-slate-700 font-medium text-sm mt-1">Bagan hierarki kepengurusan {{ $profile->org_name ?? 'HIMA IF' }}.</p>
    </div>

    <div class="tree min-w-[800px] flex justify-center pb-12">
        <ul>
            @foreach($rootOfficers as $officer)
                @include('pages.partials.officer_node', ['officer' => $officer])
            @endforeach
        </ul>
    </div>
</div>
@endsection
