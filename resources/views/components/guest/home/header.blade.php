<div class="w-full bg-white">
    <div class="max-w-7xl mx-auto px-12 sm:px-16">
        <div class="swiper w-full overflow-hidden relative rounded-xl">
            <div class="swiper-wrapper">
                @foreach ($data->take(3) as $item)
                    <div class="swiper-slide w-full h-[350px] overflow-hidden relative">
                        <div class="absolute inset-0">
                            <img src="{{ $item->banner ? asset('storage/images/article/banner/' . $item->banner) : asset('assets/images/placeholder.webp') }}"
                                class="w-full h-full object-cover" alt="">
                        </div>
                        <div style="box-shadow: 0px -178px 115px -74px rgba(0,0,0,0.75) inset;"
                            class="w-full h-full flex items-end relative bg-black/20">
                            <div class="w-full py-4 text-white divide-y divide-white/50">
                                <div class="px-4 sm:px-6 pb-4 space-y-2">
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($item->articles->articlecategory as $category)
                                            <a href="{{ route('category', ['category' => $category->slug]) }}">
                                                <div class="py-0.5 px-3 bg-white text-gray-700 text-xs rounded-full">
                                                    {{ $category->category }}
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                    <a href="{{ route('business', ['slug' => $item->slug]) }}">
                                        <p class="text-xl sm:text-3xl font-bold line-clamp-2">{{ $item->judul }}</p>
                                    </a>
                                    <p class="line-clamp-1 sm:line-clamp-2 text-sm sm:text-base">
                                        {!! nl2br(Str::limit(strip_tags($item->article), 200)) !!}
                                    </p>
                                </div>
                                <div class="px-4 sm:px-6 pt-2 text-sm sm:text-base flex items-center gap-4">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4 text-white/80" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                        </svg>
                                        <a href="{{ route('author', ['username' => $item->articles->user->slug]) }}"
                                            class="font-semibold ine-clamp-2 transition-colors duration-300 hover:text-blue-600">
                                            {{ $item->articles->user->name }}
                                        </a>
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4 text-white/80" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M19 4h-1V2h-2v2H8V2H6v2H5a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V6a2 2 0 00-2-2zm0 16H5V10h14v10z" />
                                        </svg>
                                        {{ $item->date }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="absolute bottom-0 right-0 z-10 pb-4 pr-4">
                <div class="pagination"></div>
            </div>
        </div>
    </div>
</div>

<style>
    .swiper-pagination-bullet {
        width: 12px;
        height: 12px;
        opacity: 0.5;
        background-color: white;
        transition-duration: 300ms;
        border-radius: 9999px;
    }

    .swiper-pagination-bullet-active {
        width: 24px;
        opacity: 1;
        background-color: white;
    }

    .swiper-slide {
        height: 350px !important;
        border-radius: 20px;
        margin-bottom: 20px
    }

    .swiper-slide img {
        border-radius: 0 !important;
    }
</style>

<script>
    window.addEventListener('load', function () {
        const swiper = new Swiper('.swiper', {
            direction: 'horizontal',
            loop: true,
            speed: 500,
            autoplay: {
                delay: 6000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.pagination',
                clickable: true,
                renderBullet: function (index, className) {
                    return `<span class="${className}"></span>`;
                },
            },
        });
    });
</script>