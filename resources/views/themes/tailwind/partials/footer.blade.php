
<!-- Section 1 -->
<footer class="@if(Request::is('/')){{ 'bg-white' }}@else{{ 'bg-gray-50' }}@endif">
    
</footer>

@if(!auth()->guest() && auth()->user()->hasAnnouncements())
    @include('theme::partials.announcements')
@endif

<!-- Scripts -->
<script src="{{ asset('themes/' . $theme->folder . '/js/app.js') }}"></script>
@stack('footer-scripts')

@yield('javascript')

@if(setting('site.google_analytics_tracking_id', ''))
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ setting('site.google_analytics_tracking_id') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '{{ setting("site.google_analytics_tracking_id") }}');
    </script>

@endif
