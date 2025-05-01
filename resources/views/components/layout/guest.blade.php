<!DOCTYPE html>
@props(['title' => null, 'desc' => null, 'tags' => null])
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
        
        <link rel="icon" href="{{ asset('/assets/images/logo.png') }}" type="image/x-icon">

        <title>{{$title ?? ''}}</title>

        <meta name="description" content="{{ $desc ?? '' }}">
        <meta name="keywords" content="{{ collect($tags)->pluck('tag')->implode(', ') }}">
        <link rel="canonical" href="{{ url()->current() }}">

        <meta property="og:title" content="{{$title ?? ''}}">
        <meta property="og:description" content="{{ $desc ?? '' }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:site_name" content="Bizlink">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />    

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

        <style>
            @import url('https://fonts.googleapis.com/css2?family=DynaPuff:wdth,wght@75..100,400..700&display=swap');
        </style>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"/>

        <!-- Styles -->
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
        <link href="{{ asset('build/assets/app.css') }}" rel="stylesheet" />
    </head>
    <body class="antialiased">
        @include('components.guest.navbar')
        <div class=" pt-[70px] sm:pt-20 min-h-screen">
            {{$slot}}
        </div>
    </body>
    <script src="{{ asset('build/assets/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</html>
