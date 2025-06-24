<x-app-layout head="Dashboard" title="Admin - Dashboard">
    <div class="sm:pl-12 sm:pr-12 lg:pr-32 duration-300 pt-8 pb-20 sm:pb-8 px-4 space-y-6">
        <div class=" w-full p-4 sm:p-8 bg-white rounded-md shadow-md shadow-black/20">
            <div class=" space-y-4 sm:space-y-6">
                <p class=" text-base sm:text-lg font-semibold">Short Cut</p>
                <div class=" w-full text-sm sm:text-base">
                    <div class=" grid grid-cols-3 gap-2 sm:gap-4">
                        <a href="{{route('source-code.index')}}">
                            <div class=" text-xs sm:text-sm text-neutral-600 hover:text-byolink-1 duration-300 flex flex-col items-center text-center gap-1 sm:gap-2">
                                <div class=" w-6 sm:w-8 aspect-square">
                                    <svg viewBox="0 0 640 512" xmlns="http://www.w3.org/2000/svg"><path d="M416 31.94C416 21.75 408.1 0 384.1 0c-13.98 0-26.87 9.072-30.89 23.18l-128 448a31.933 31.933 0 0 0-1.241 8.801C223.1 490.3 232 512 256 512c13.92 0 26.73-9.157 30.75-23.22l128-448c.85-2.97 1.25-5.93 1.25-8.84zM176 143.1c0-18.28-14.95-32-32-32-8.188 0-16.38 3.125-22.62 9.376l-112 112C3.125 239.6 0 247.8 0 255.1s3.125 17.3 9.375 23.5l112 112c6.225 6.3 14.425 8.5 22.625 8.5 17.05 0 32-13.73 32-32 0-8.188-3.125-16.38-9.375-22.63L77.25 255.1l89.38-89.38c6.27-5.42 9.37-13.52 9.37-22.62zm464 112c0-8.188-3.125-16.38-9.375-22.63l-112-112C512.4 115.1 504.2 111.1 496 111.1c-17.05 0-32 13.73-32 32 0 8.188 3.125 16.38 9.375 22.63l89.38 89.38-89.38 89.38C467.1 351.6 464 359.8 464 367.1c0 18.28 14.95 32 32 32 8.188 0 16.38-3.125 22.62-9.376l112-112C636.9 272.4 640 264.2 640 255.1z" fill="currentColor" class="fill-000000"></path></svg>
                                </div>
                                <p class=" line-clamp-1">Source Code</p>
                            </div>
                        </a>
                        <a href="{{route('article.create')}}">
                            <div class=" text-xs sm:text-sm text-neutral-600 hover:text-byolink-1 duration-300 flex flex-col items-center text-center gap-1 sm:gap-2">
                                <div class=" w-6 sm:w-8 aspect-square">
                                    <svg fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M10 18v-2H8v-2h2v-2h2v2h2v2h-2v2h-2Z" fill="currentColor" class="fill-000000"></path><path clip-rule="evenodd" d="M6 2a3 3 0 0 0-3 3v14a3 3 0 0 0 3 3h12a3 3 0 0 0 3-3V9a7 7 0 0 0-7-7H6Zm0 2h7v5h6v10a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1Zm9 .1A5.009 5.009 0 0 1 18.584 7H15V4.1Z" fill="currentColor" fill-rule="evenodd" class="fill-000000"></path></svg>
                                </div>
                                <p class=" line-clamp-1">+ Artikel Spintax</p>
                            </div>
                        </a>
                        <a href="{{route('article-show.create')}}">
                            <div class=" text-xs sm:text-sm text-neutral-600 hover:text-byolink-1 duration-300 flex flex-col items-center text-center gap-1 sm:gap-2">
                                <div class=" w-6 sm:w-8 aspect-square">
                                    <svg fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M10 18v-2H8v-2h2v-2h2v2h2v2h-2v2h-2Z" fill="currentColor" class="fill-000000"></path><path clip-rule="evenodd" d="M6 2a3 3 0 0 0-3 3v14a3 3 0 0 0 3 3h12a3 3 0 0 0 3-3V9a7 7 0 0 0-7-7H6Zm0 2h7v5h6v10a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1Zm9 .1A5.009 5.009 0 0 1 18.584 7H15V4.1Z" fill="currentColor" fill-rule="evenodd" class="fill-000000"></path></svg>
                                </div>
                                <p class=" line-clamp-1">+ Artikel Unique</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class=" w-full p-4 sm:p-8 bg-white rounded-md shadow-md shadow-black/20">
            <div class=" space-y-4 sm:space-y-6">
                <p class=" text-base sm:text-lg font-semibold">List Kategori</p>
                <table class="w-full text-sm sm:text-base rounded-md overflow-hidden">
                    <thead>
                        <tr class="h-10 bg-byolink-1 text-white divide-x-2 divide-white">
                            <th class=" px-2 py-1 rounded-tl-md w-10">No</th>
                            <th class=" px-1 sm:px-2 py-1">Kategori</th>
                            <th class=" px-1 sm:px-2 py-1 min-w-10">Jumlah Artikel</th>
                            {{-- <th class=" px-1 sm:px-2 py-1 w-[90px] sm:w-[100px] rounded-tr-md">Opsi</th> --}}
                        </tr>
                    </thead>
                    @foreach ($data as $item)
                        <tbody>
                            <tr class="{{ $loop->even ? 'bg-neutral-100' : 'bg-neutral-200' }} h-10 text-neutral-600 divide-x-2 divide-white">
                                <td class="px-3 py-1 text-center font-semibold">{{ $loop->iteration }}</td>
                                <td class="px-2 sm:px-4 py-1 min-h-10 font-semibold text-nowrap max-w-28 sm:max-w-full">{{$item->category}}</td>
                                <td class="px-2 sm:px-4 py-1 min-h-10 text-nowrap text-center">{{$item->articles->count()}}</td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
