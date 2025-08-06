@foreach ($data as $item)
    <div class="w-full flex flex-col rounded-md overflow-hidden shadow-md shadow-black/20">
        <div class="relative">
            <a href="{{ route('business', ['slug' => $item->slug]) }}" aria-label="{{ $item->judul }}">
                <div class="w-full aspect-[3/2] bg-white overflow-hidden hover:scale-105 transition-transform duration-300">
                    <img src="{{ $item->banner ? asset('storage/images/article/banner/' . $item->banner) : asset('assets/images/placeholder.webp') }}"
                         class="w-full h-full object-cover" alt="{{ $item->judul }}">
                </div>
            </a>

            @if (is_object($item->articles) && $item->articles->articlecategory)
                <div class="absolute bottom-2 left-2 w-full flex flex-wrap gap-2">
                    @foreach ($item->articles->articlecategory as $category)
                        <a href="{{ route('category', ['category' => $category->slug]) }}" aria-label="{{ $category->category }}">
                            <div class="py-0.5 px-3 bg-white text-gray-600 text-xs rounded-full">
                                {{ $category->category }}
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="py-4 px-2 text-sm flex flex-grow flex-col gap-2 justify-between">
            <a href="{{ route('business', ['slug' => $item->slug]) }}" aria-label="{{ $item->judul }}">
                <p class="line-clamp-2 font-bold hover:text-blue-600 duration-300">{{ $item->judul }}</p>
            </a>

            @php
                $user = is_object($item->articles) && is_object($item->articles->user) ? $item->articles->user : null;
            @endphp

         <div class="flex items-center text-xs text-gray-500 justify-between">
    @if ($user)
        <span class="flex items-center gap-1">
            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
            </svg>
            <a href="{{ route('author', ['username' => $user->slug]) }}" 
               class="font-semibold hover:text-blue-600 duration-300" 
               aria-label="{{ $item->judul }}">
                {{ $user->name }}
            </a>
        </span>
    @else
        <span class="flex items-center gap-1">
            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
            </svg>
            <span class="font-semibold">Anonim</span>
        </span>
    @endif

    <span class="flex items-center gap-1">
        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
            <path d="M19 4h-1V2h-2v2H8V2H6v2H5a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V6a2 2 0 00-2-2zm0 16H5V10h14v10z" />
        </svg>
        {{ $item->date }}
    </span>
</div>
        </div>
    </div>
@endforeach
