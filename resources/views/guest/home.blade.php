<x-layout.guest title="Bizlink" :category="$category">
    <div class="w-full min-h-[calc(100vh-370px)] bg-gray-50">
        <div class="w-full py-10 px-4 sm:px-6 space-y-12">
            @include('components.guest.home.header')

            <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12">
                <!-- Artikel Terbaru -->
                <div class="md:col-span-3 space-y-8">
                    <div class="flex justify-between items-center border-b pb-3">
                        <div class="flex items-center gap-3">
                            <div class="w-1.5 h-6 bg-blue-600 rounded-full"></div>
                            <h2 class="text-xl md:text-xl font-bold text-gray-800">Artikel Terbaru</h2>
                        </div>
                        <a href="{{ route('allarticle') }}"
                            class="ine-clamp-2 transition-colors duration-300 hover:text-blue-600 flex items-center gap-1 transition ">
                            <span>Lihat Lainnya</span>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M12.293 3.293a1 1 0 011.414 0l5 5a1 1 0 010 1.414l-5 5a1 1 0 11-1.414-1.414L15.586 10H3a1 1 0 110-2h12.586l-3.293-3.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($data->take(4) as $item)
                            <div
                                class="bg-white rounded-lg shadow-md transition-all duration-300 overflow-hidden flex flex-col group border border-gray-200 hover:shadow-lg hover:border-blue-400 hover:-translate-y-1">
                                <a href="{{ route('business', ['slug' => $item->slug]) }}"
                                    class="block overflow-hidden">
                                    <div class="aspect-w-16 aspect-h-9 overflow-hidden transition-transform duration-300 group-hover:scale-105">
                                        <img src="{{ $item->banner ? asset('storage/images/article/banner/' . $item->banner) : asset('assets/images/placeholder.webp') }}"
                                            alt="{{ $item->judul }}"
                                            class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                                            loading="lazy">
                                    </div>
                                </a>
                                <div class="p-4 flex-1 flex flex-col gap-3">
                                    <a href="{{ route('business', ['slug' => $item->slug]) }}">
                                        <h3
                                            class="text-lg font-semibold text-gray-900 ine-clamp-2 transition-colors duration-300 hover:text-blue-600">
                                            {{ $item->judul }}
                                        </h3>
                                    </a>
                                    <div class="text-xs text-gray-500 flex justify-between items-center mt-auto">
                                        <span class="flex items-center gap-1 hover:text-blue-600 transition-colors duration-300">
                                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                            </svg>
                                            <a href="{{ route('author', ['username' => $item->articles->user->slug]) }}"
                                                class="font-semibold hover:text-blue-600 transition-colors duration-300">
                                                {{ $item->articles->user->name }}
                                            </a>
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M19 4h-1V2h-2v2H8V2H6v2H5a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V6a2 2 0 00-2-2zm0 16H5V10h14v10z" />
                                            </svg>
                                            {{ $item->created_at->format('d F Y') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="pt-6">
                        {{ $data->links('pagination::tailwind') }}
                    </div>
                </div>

                <!-- Artikel Populer -->
                <div class="space-y-6">
                    <div class="flex items-center gap-3 border-b pb-2">
                        <div class="w-1.5 h-6 bg-blue-600 rounded-full"></div>
                        <h2 class="text-xl font-semibold text-gray-800 mt-1">Artikel Populer</h2>
                    </div>

                    <div class="md:sticky top-24 grid grid-cols-1 gap-5">
                        @foreach ($trend as $item)
                            <div class="flex items-start gap-4 p-2 rounded-md transition-all duration-300 hover:bg-gray-100 hover:shadow-md hover:border hover:border-gray-200">
                                <a href="{{ route('business', ['slug' => $item->slug]) }}"
                                    class="w-20 h-20 flex-shrink-0 overflow-hidden rounded-md border transition-transform duration-300 hover:scale-105">
                                    <img src="{{ $item->banner ? asset('storage/images/article/banner/' . $item->banner) : asset('assets/images/placeholder.webp') }}"
                                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" 
                                        alt="{{ $item->judul }}">
                                </a>
                                <div class="flex-1">
                                    <a href="{{ route('business', ['slug' => $item->slug]) }}">
                                        <p class="text-sm font-medium text-gray-900 line-clamp-2 transition-colors duration-300 hover:text-blue-600">
                                            {{ $item->judul }}
                                        </p>
                                    </a>
                                    <div class="flex items-center text-xs text-gray-500 mt-1 gap-4">
                                        <span class="flex items-center gap-1 hover:text-blue-600 transition-colors duration-300">
                                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                            </svg>
                                            <a href="{{ route('author', ['username' => $item->articles->user->slug]) }}"
                                                class="font-semibold hover:text-blue-600 transition-colors duration-300">
                                                {{ $item->articles->user->name }}
                                            </a>
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M19 4h-1V2h-2v2H8V2H6v2H5a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V6a2 2 0 00-2-2zm0 16H5V10h14v10z" />
                                            </svg>
                                            {{ $item->created_at->format('d F Y') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.guest>
@include('components.guest.footer')