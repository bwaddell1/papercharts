<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

    @if (isset($seo->title))
    <title>{{ $seo->title }}</title>
    @else
    <title>
        Papercharts.ai- Old school medical charting is the future.
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
    <meta property="og:type" content="@if (isset($seo->type)) {{ $seo->type }}@else{{ 'article' }} @endif">
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

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link href="{{ asset('themes/' . $theme->folder . '/css/style.css') }}" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

    @stack('header-scripts')

    @livewireScripts
    <script src="/vendor/livewire-editorjs/editorjs.js"></script>

</head>

<body class="flex flex-col min-h-screen @if (Request::is('/')) {{ 'bg-white' }}@else{{ 'bg-gray-50' }} @endif @if (config('wave.dev_bar')) {{ 'pb-10' }} @endif">

    @if (config('wave.demo') && Request::is('/'))
    @include('theme::partials.demo-header')
    @endif

    @include('theme::partials.header')

    <main class="flex-grow relative">
        @yield('content')
    </main>


    @include('theme::partials.lgModal')

    @include('theme::partials.footer')

    @if (config('wave.dev_bar'))
    @include('theme::partials.dev_bar')
    @endif

    <!-- Full Screen Loader -->
    <div id="fullscreenLoader" class="fixed inset-0 top-0 left-0 z-50 flex flex-col items-center justify-center hidden w-full h-full bg-gray-900 opacity-50">
        <svg class="w-5 h-5 mr-3 -ml-1 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
            </path>
        </svg>
        <p id="fullscreenLoaderMessage" class="mt-4 text-sm font-medium text-white uppercase"></p>
    </div>
    <!-- End Full Loader -->


    @include('theme::partials.toast')
    @if (session('message'))
    <script>
        setTimeout(function() {
            popToast("{{ session('message_type') }}", "{{ session('message') }}");
        }, 10);

    </script>
    @endif
    @waveCheckout


    <script>
        window.addEventListener('page-reload', event => {
            window.location.reload();
        })
        window.addEventListener('notify', event => {
            if (event.detail.type && event.detail.message) {
                popToast(event.detail.type, event.detail.message);
            }
        })
        window.addEventListener('clipboard', event => {
            if (event.detail.message) {
                navigator.clipboard.writeText(event.detail.message);
            }
        })
        window.addEventListener('print', event => {
            if (event.detail.html) {
                var mywindow = window.open('', 'PRINT', 'height=682,width=1024');

                mywindow.document.write(event.detail.html);

                setTimeout(() => {
                    mywindow.document.close(); // necessary for IE >= 10
                    mywindow.focus(); // necessary for IE >= 10*/

                    mywindow.print();
                    mywindow.close();
                }, [50]);

            } else {
                window.print();
            }
        })
        window.addEventListener('scroll-to-top', event => {
            $("html, body").animate({
                scrollTop: 0
            }, "fast");
        })

    </script>
</body>


</html>
