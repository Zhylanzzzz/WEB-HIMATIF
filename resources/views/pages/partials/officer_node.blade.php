<li>
    <div class="bg-white border-2 border-slate-200 hover:border-sky-400 rounded-2xl p-5 shadow-md transition inline-block w-56 group">
        <div class="relative w-20 h-20 mx-auto mb-3">
            <img src="{{ asset('storage/' . $officer->photo) }}" class="w-full h-full rounded-full object-cover border-2 border-sky-400 p-0.5 shadow-sm" alt="{{ $officer->name }}">
        </div>
        <h4 class="font-extrabold text-slate-900 text-sm group-hover:text-[#800000] transition line-clamp-1">{{ $officer->name }}</h4>
        <span class="inline-block mt-1.5 px-3 py-1 bg-sky-100 text-sky-900 font-bold text-xs rounded-full border border-sky-200">
            {{ $officer->position }}
        </span>
    </div>

    @if($officer->children->count() > 0)
        <ul>
            @foreach($officer->children as $child)
                @include('pages.partials.officer_node', ['officer' => $child])
            @endforeach
        </ul>
    @endif
</li>
