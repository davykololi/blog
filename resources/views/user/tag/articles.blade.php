    @extends('layouts.app')
    
    @section('content')
    <h2 style="text-transform: uppercase;">Latest {{ $tag->name }} News</h2>
     @if(!empty($tagArticles))
     	@forelse($tagArticles as $article)
            @include('article')
     	@empty
            <p class="text-danger">
                Sorry esteemed reader!, We are yet to publish 
                <span style="color: blue"><a href="{!! $tag->path() !!}">{{ $tag->name }}</a></span> 
                article(s). Stay tuned and keep in touch. We value your readership and keep on visiting this site for the latest news in Kenya and around the world. Thank you.
            </p>
     	@endforelse
    @endif

    @include('politics_articles') <!-- Latest Politics Articles -->
    @include('entertainment_articles') <!-- Latest Entertainment Articles -->
    @include('all_articles') <!-- All Articles In Randomn Order-->
    @include('user.newsletter') <!-- Newsletter Subscription Form-->

    @endsection
