{{-- Navigation --}}
<div class="" x-data="{open : false}">
    <div class=" fixed top-0 left-0 grid grid-col-3 w-full bg-white px-4 md:px-8 py-4 z-50 shadow-md shadow-black/10">
        <div class=" w-full max-w-[1080px] mx-auto flex items-center justify-between">
            <div class=" w-44 h-10 sm:h-12 flex items-center overflow-hidden">
                <p class=" text-3xl sm:text-4xl font-bold">Bizlink</p>
                {{-- <img src="{{asset('assets/images/logo.png')}}" alt=""> --}}
            </div>
            <div class=" hidden md:flex flex-row gap-6 items-center text-neutral-500">
                <x-guest.nav-button route="{{route('home')}}" active="{{request()->routeIs('home')}}">Beranda</x-guest.nav-button>
                <x-guest.nav-button route="" active="">Tentang</x-guest.nav-button>
                <x-guest.nav-button route="" active="">Bisnis Lainnya</x-guest.nav-button>
                {{-- @if (Route::has('login'))
                    @auth
                        <form method="POST" class="" action="{{ route('logout') }}">
                            @csrf
                            <button class=" py-1.5 px-5 bg-red-600 rounded-md font-semibold text-white hover:bg-red-900 duration-300">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class=" md:mr-0">
                            <button class=" py-1.5 px-5 bg-byolink-2 rounded-md font-semibold text-white hover:bg-black duration-300">Login</button>
                        </a>
                    @endauth
                @endif --}}
            </div>
            <button @click="open = !open" :class="{'text-third': open, 'text-second': !open}" class=" flex md:hidden gap-2 items-center duration-300">
                <div class=" w-6 h-6">
                    <svg viewBox="0 0 32 32" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 32 32"><path d="M4 10h24a2 2 0 0 0 0-4H4a2 2 0 0 0 0 4zm24 4H4a2 2 0 0 0 0 4h24a2 2 0 0 0 0-4zm0 8H4a2 2 0 0 0 0 4h24a2 2 0 0 0 0-4z" fill="currentColor" class="fill-000000"></path></svg>
                </div>
            </button>
        </div>
    </div>
    <div :class="{' top-[70px] sm:top-20': open, '-translate-y-full top-0': !open}" class=" fixed flex md:hidden flex-col bg-white w-full left-0 justify-center gap-4 font-semibold text-neutral-600 pt-2 px-4 pb-4 duration-300 z-40">
        <x-guest.nav-button route="{{route('home')}}" active="{{request()->routeIs('home')}}">Beranda</x-guest.nav-button>
        <x-guest.nav-button route="" active="">Tentang</x-guest.nav-button>
        <x-guest.nav-button route="" active="">Bisnis Lainnya</x-guest.nav-button>
        {{-- @if (Route::has('login'))
            @auth
                <x-guest.nav-button route="{{route('profile.edit')}}" active="{{request()->routeIs('profile.edit')}}">Profile</x-guest.nav-button>
                <form method="POST" class=" flex w-full" action="{{ route('logout') }}">
                    @csrf
                    <button class=" w-full py-2 bg-red-600 rounded-md font-semibold text-white hover:bg-red-900 duration-300">
                        Logout
                    </a>
                </form>
            @else
                <a href="{{ route('login') }}" class="md:mr-0">
                    <button class=" w-full py-2 px-4 bg-byolink-2 rounded-md font-semibold text-white hover:bg-byolink-3 duration-300">Login</button>
                </a>
            @endauth
        @endif --}}
    </div>
</div>