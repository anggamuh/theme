<x-layout.guest :title="$data->judul">
    <div class=" w-full bg-neutral-100">
        {{-- Header --}}
        @include('components.guest.header.one')
        <div class=" w-full pt-4 px-4 sm:pt-6 sm:px-6 pb-2 space-y-4 sm:space-y-6">
            {{-- Gallery --}}
            @include('components.guest.gallery.one')
            {{-- Description --}}
            <x-guest.description :background="null" :data="$data"/>
            {{-- Video --}}
            @if ($data->articles->video_type != 'none')  
                @include('components.guest.'.$data->articles->video_type)
            @endif
        </div>
        {{-- Contact --}}
        @include('components.guest.contact.one')
    </div>
</x-layout.guest>