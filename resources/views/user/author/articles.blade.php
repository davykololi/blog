@extends('layouts.app')
    
@section('content')
<main id="main">
    {{ Breadcrumbs::render('articleBy.articles',$author) }}
    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">
        <div class="row">
          <div class="col-lg-8 entries">
                @if(!empty($authorArticles))
                @forelse($authorArticles as $article)
                    @include('article')
                @empty
                  <article class="entry">
                    <p class="text-danger">
                        <b>Sorry esteemed reader!, We are yet to publish 
                        <span style="color: blue"><a href="{!! $author->path() !!}">{{ $tag->name }}</a></span> 
                        tutorials. Stay tuned and keep in touch. We value your readership and keep on visiting this site for the latest news in Kenya and around the world. Thank you.</b>
                    </p>
                  </article>
                @endforelse
                @endif
            <div class="blog-pagination">
              <ul class="justify-content-center">
                <li>{{$authorArticles->links()}}</li>
              </ul>
            </div>
          </div><!-- End blog entries list -->
          @include('partials.frontend_sidebar')
        </div>
      </div>
    </section><!-- End Blog Section -->
    @include('laravel_tutorials')<!-- Laravel Tutorials -->
    @include('reactjs_tutorials')<!-- React js Tutorials -->
    @include('tailwindcss_tutorials')<!-- Tailwind css Tutorials -->
    @include('vuejs_tutorials')<!-- Vue Js Tutorials -->
    @include('all_articles')<!-- Recent Articles -->
    @include('about_intro')<!-- About Us Introduction -->
    @include('faq.faq')<!-- Frequently Asked Questions -->
  </main><!-- End #main -->
@endsection
