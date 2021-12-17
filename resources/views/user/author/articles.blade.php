    @extends('layouts.app')
    
    @section('content')
    <h2 style="text-transform: uppercase;">Latest Articles By {{ $author->name }}</h2>
    @if(!empty($authorArticles))
     	@forelse($authorArticles as $article)
            @include('article')
     	@empty
            <p class="text-danger">No Article(s)</p>
     	@endforelse
    @endif

    @include('all_articles') <!-- All Articles -->
    @include('politics_articles') <!-- Politics Articles -->
    @include('entertainment_articles') <!-- Entertainment Articles -->
    @include('user.newsletter') <!-- Newsletter Subscription Form-->

    @endsection
