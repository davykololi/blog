    @extends('layouts.app')
    
    @section('content')
    <h2 style="text-transform: uppercase;">Latest {{ $category->name }} News</h2>
     @if(!empty($categoryArticles))
     	@forelse($categoryArticles as $article)
            @include('article')
     	@empty
            <p class="text-danger">
                Sorry esteemed reader!, We are yet to publish 
                <span style="color: blue"><a href="{!! $category->path() !!}">{{ $category->name }}</a></span> 
                article(s). Stay tuned and keep in touch. We value your readership and keep on visiting this site for the latest news in Kenya and around the world. Thank you.
            </p>
     	@endforelse
    @endif
    <br/>
    <h3>More News</h3>
    @include('politics_articles') <!-- Latest Politics Articles -->
    @include('entertainment_articles') <!-- Latest Entertainment Articles -->
    @include('all_articles') <!-- All Articles In Randomn Order-->
    @include('user.newsletter') <!-- Newsletter Subscription Form-->

    @endsection
