<div class="w-full max-w-[100vw] min-h-screen flex flex-row" x-data="{ open: true }">
    <div :class="open ? 'min-w-20 w-20 lg:min-w-72 lg:w-72' : 'min-w-20 w-20'"
        class=" hidden sm:block bg-white space-y-6 transition-all duration-300 overflow-x-hidden sticky top-0 h-screen">
        <div class="w-full h-20 p-4 flex items-end ">
            <div class="aspect-square h-full">
                <img src="{{ asset('assets/images/logo.png') }}" alt="">
            </div>
            <p class="font-bold text-2xl duration-300 pb-1" :class="open ? 'opacity-0 lg:opacity-100' : 'opacity-0'">izlink
            </p>
        </div>
        <div class="pl-4 space-y-4">
            <x-admin.navbutton route="dashboard" :active="'dashboard'">
                <div class="min-w-6 h-6">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M4 13h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1zm-1 7a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v4zm10 0a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-7a1 1 0 0 0-1-1h-6a1 1 0 0 0-1 1v7zm1-10h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1h-6a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1z"
                            fill="currentColor" class="fill-000000"></path>
                    </svg>
                </div>
                <p class=" line-clamp-1 duration-300" :class="open ? 'opacity-0 lg:opacity-100' : 'opacity-0'">Dashboard
                </p>
            </x-admin.navbutton>
            <x-admin.navbutton route="template.index" :active="['template.index', 'template.create', 'template.show']">
                <div class="min-w-6 h-6">
                    <svg viewBox="-265 388.9 64 64" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                        enable-background="new -265 388.9 64 64">
                        <path
                            d="M-210.6 410.9h-44.8c-.9 0-1.6-.7-1.6-1.6v-9.2c0-.9.7-1.6 1.6-1.6h44.8c.9 0 1.6.7 1.6 1.6v9.2c0 .9-.7 1.6-1.6 1.6zM-210.6 443.3h-11.8c-.9 0-1.6-.7-1.6-1.6v-25.6c0-.9.7-1.6 1.6-1.6h11.8c.9 0 1.6.7 1.6 1.6v25.6c0 .9-.7 1.6-1.6 1.6zM-229.6 443.3h-25.8c-.9 0-1.6-.7-1.6-1.6v-25.6c0-.9.7-1.6 1.6-1.6h25.8c.9 0 1.6.7 1.6 1.6v25.6c0 .9-.7 1.6-1.6 1.6z"
                            fill="currentColor" class="fill-000000"></path>
                    </svg>
                </div>
                <p class=" line-clamp-1 duration-300" :class="open ? 'opacity-0 lg:opacity-100' : 'opacity-0'">Template</p>
            </x-admin.navbutton>
            <x-admin.navbutton route="article.index" :active="['article.index', 'article.create', 'article.show', 'articel-show.create', 'article-show.create', 'article-show.show']">
                <div class="min-w-6 h-6">
                    <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg"><path d="M8 28h8v-8H8v8zm0 10h8v-8H8v8zm0-20h8v-8H8v8zm10 10h24v-8H18v8zm0 10h24v-8H18v8zm0-28v8h24v-8H18z" fill="currentColor" class="fill-000000"></path><path d="M0 0h48v48H0z" fill="none"></path></svg>
                </div>
                <p class=" line-clamp-1 duration-300" :class="open ? 'opacity-0 lg:opacity-100' : 'opacity-0'">Article</p>
            </x-admin.navbutton>
        </div>
    </div>
    <div class="flex flex-col w-full flex-grow overflow-hidden">
        <div class=" hidden sm:flex w-full bg-white py-6 pl-12 pr-12 lg:pr-32 duration-300 sticky top-0 z-30">
            <div class="w-full mx-auto flex justify-between">
                <div class="flex gap-4 items-center">
                    <button id="openclose" class=" w-0 lg:w-6 aspect-square duration-300" @click="open = !open">
                        <svg class="duration-300" :class="open ? 'rotate-90' : ''" viewBox="0 0 32 32"
                            xml:space="preserve" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 32 32">
                            <path
                                d="M4 10h24a2 2 0 0 0 0-4H4a2 2 0 0 0 0 4zm24 4H4a2 2 0 0 0 0 4h24a2 2 0 0 0 0-4zm0 8H4a2 2 0 0 0 0 4h24a2 2 0 0 0 0-4z"
                                fill="currentColor" class="fill-000000"></path>
                        </svg>
                    </button>
                    <div class="text-2xl font-bold">{{ $head ?? '' }}</div>
                </div>
                <div x-data="{ open: false }" class="flex justify-end items-center text-neutral-600 relative">
                    <button @click="open = !open" class="flex gap-2 items-center">
                        <div>{{ Auth::user()->email }}</div>
                        <div class="w-4 h-4">
                            <svg :class="{ 'rotate-90': open, 'rotate-0': !open }"
                                class="transition-transform feather feather-chevron-right" fill="none"
                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <polyline points="9 18 15 12 9 6" />
                            </svg>
                        </div>
                    </button>

                    <!-- Floating Dropdown Menu with Slide-down Animation -->
                    <div x-show="open" @click.outside="open = false"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute top-full right-0 mt-2 py-2 w-48 bg-white border rounded shadow-lg text-sm z-50">
                        <a href="{{route('profile.edit')}}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Profile</a>
                        <form method="POST" class=" w-full" action="{{ route('logout') }}">
                            @csrf
                            <button
                                class="block px-4 py-2 text-gray-800 hover:bg-gray-200 w-full text-left">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class=" w-full">
            <div class=" sm:pl-12 sm:pr-12 lg:pr-32 duration-300 pt-8 sm:pb-8 px-4 sm:hidden">
                <div class=" w-full px-6 py-3 bg-white rounded-md shadow-md shadow-black/20 text-xl font-bold">{{$head ?? ''}}</div>
            </div>
            {{ $slot }}
            @include('components.admin.mobile-navbar')
        </div>
    </div>
</div>
