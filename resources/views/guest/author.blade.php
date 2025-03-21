<x-layout.guest title="Bizlink">
    <div class=" w-full min-h-[calc(100vh-370px)]">
        <div class=" w-full py-6 sm:py-10 px-4 sm:px-6 space-y-8 sm:space-y-12">
            {{-- <div class=" w-full max-w-[1080px] mx-auto">
                <div class=" w-full grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class=" w-full aspect-[5/3] bg-red-500 rounded-md"></div>
                </div>
            </div> --}}
            <div class=" w-full max-w-[1080px] mx-auto">
                <div class=" w-full space-y-4 sm:space-y-6">
                    <div class=" w-full flex items-center gap-4 mb-10">
                        <div class=" w-1.5 h-10 bg-byolink-2 rounded-full"></div>
                        <p class=" text-3xl font-bold text-center">Penulis : Admin Jbiz</p>
                    </div>
                    <div class=" w-full grid grid-cols-2 md:grid-cols-4 gap-4">
                        @for ($i = 0; $i < 8; $i++)
                            <div class=" w-full rounded-md overflow-hidden shadow-md shadow-black/20">
                                <a href="/test">
                                    <div class=" w-full aspect-[3/2] bg-white overflow-hidden">
                                        <img src="https://assets.iflscience.com/assets/articleNo/76571/aImg/79869/graveyard-vs-cemetery-m.png" class=" w-full h-full object-cover" alt="">
                                    </div>
                                </a>
                                <div class=" py-4 px-2 text-sm space-y-2">
                                    <a href="/test">
                                        <p class=" line-clamp-2 font-bold hover:text-blue-600 duration-300">Biaya Pemakaman Premium Dekat Di Jogja Svargaloka Memorial Garden</p>
                                    </a>
                                    <div class=" grid grid-cols-2 gap-2">
                                        <a href="{{route('author', ['username' => 'admin-jbiz'])}}">
                                            <p class="font-bold text-neutral-600 hover:text-blue-600 duration-300">Admin Jbiz</p>
                                        </a>
                                        <p class=" text-right text-neutral-600">16 Januari 2025</p>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                    <div class=" w-full flex justify-center">
                        <button class=" px-4 py-2 bg-byolink-2 rounded-md font-bold text-white hover:scale-95 duration-300">Lihat Lebih Banyak</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.guest.footer')
</x-layout.guest>