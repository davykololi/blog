<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	@include('partials.frontend_head')
<body style="background-image: radial-gradient(purple 5%, pink 15%, lightblue 60%);">
    <div id="app">
        @include('partials.frontend_navbar')
        <main class="py-4">
            <div class="flex justify-center max-w-5xl min-h-screen pb-16 mx-auto">
  				<div class="leading-none text-center text-black md:text-left">
		  			<h1 class="mb-2 text-5xl font-extrabold">{{ $errorCode }}</h1>
					<p class="text-xl text-gray-900">
						@isset($title)
								{{ $title }}
						@else
								Hello, is it me you're looking for?
						@endisset

						@if($homeLink ?? false)
								<a href="{{ url('/') }}" class="font-bold underline transition duration-300 hover:text-blue-600">Go home</a>
						@endif
					</p>
				</div>
			</div>
        </main>
    </div>
    @include('partials.frontend_scripts')
</body>
</html>
