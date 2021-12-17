<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	@include('partials.frontend_head')
<body style="background-color: khaki">
    @include('partials.frontend_navbar')
    	<main class="py-4 container">
            @yield('content')
        </main>
    @include('partials.frontend_footer')
    @include('partials.frontend_scripts')
</body>
</html>
