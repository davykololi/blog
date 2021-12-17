    @extends('layouts.app')
    
    @section('content')
    {{ Breadcrumbs::render('home') }}
    <div class="">
      @include('all_articles') <!-- All Latest Articles-->
      {!! $allArticles->render() !!}
    </div>

    @include('politics_articles') <!-- Latest Politics Articles -->
    @include('entertainment_articles') <!-- Latest Entertainment Articles -->
    @include('all_articles') <!-- All Articles In Randomn Order-->
    @include('user.newsletter') <!-- Newsletter Subscription Form-->

    @endsection
