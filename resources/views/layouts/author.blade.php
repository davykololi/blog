<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('partials.backend_head')
<body>
    <div id="app">
        @include('partials.backend_navbar')
        <div class="container">
            <h2 class="text-center text-uppercase">{{ Auth::user()->role }} ONLY DASHBOARD</h2>     
            <div class="row justify-content-center mt-3">
                @yield('content')
            </div>
        </div>
        @include('partials.backend_footer')
        @include('partials.backend_scripts')
    </div>
</body>
</html>