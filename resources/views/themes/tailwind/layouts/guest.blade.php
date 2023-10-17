<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

    @if (isset($seo->title))
        <title>{{ $seo->title }}</title>
    @else
        <title>
            {{ setting('site.title', 'PaperCharts') . ' - ' . setting('site.description', 'Dev') }}
        </title>
    @endif

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge"> <!-- † -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="url" content="{{ url('/') }}">

    @livewireStyles

    {{-- <script src="https://unpkg.com/tailwindcss-jit-cdn"></script> --}}
    <link rel="icon" href="{{ setting('site.favicon', '/wave/favicon.png') }}" type="image/x-icon">

    {{-- Social Share Open Graph Meta Tags --}}
    @if (isset($seo->title) && isset($seo->description) && isset($seo->image))
        <meta property="og:title" content="{{ $seo->title }}">
        <meta property="og:url" content="{{ Request::url() }}">
        <meta property="og:image" content="{{ $seo->image }}">
        <meta property="og:type"
            content="@if (isset($seo->type)) {{ $seo->type }}@else{{ 'article' }} @endif">
        <meta property="og:description" content="{{ $seo->description }}">
        <meta property="og:site_name" content="{{ setting('site.title') }}">

        <meta itemprop="name" content="{{ $seo->title }}">
        <meta itemprop="description" content="{{ $seo->description }}">
        <meta itemprop="image" content="{{ $seo->image }}">

        @if (isset($seo->image_w) && isset($seo->image_h))
            <meta property="og:image:width" content="{{ $seo->image_w }}">
            <meta property="og:image:height" content="{{ $seo->image_h }}">
        @endif
    @endif

    <meta name="robots" content="index,follow">
    <meta name="googlebot" content="index,follow">

    @if (isset($seo->description))
        <meta name="description" content="{{ $seo->description }}">
    @endif

    <!-- Styles -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
    <link href="{{ asset('themes/' . $theme->folder . '/css/app.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />

    <link href="{{ asset('themes/' . $theme->folder . '/css/style.css') }}" rel="stylesheet">

    @stack('header-scripts')

    @livewireScripts

</head>

<body
    class="flex flex-col min-h-screen @if (Request::is('/')) {{ 'bg-white' }}@else{{ 'bg-gray-50' }} @endif @if (config('wave.dev_bar')) {{ 'pb-10' }} @endif">

    <main class="flex-grow overflow-x-hidden relative">
        @yield('content')
    </main>

    @include('theme::partials.footer')

</body>


</html>
