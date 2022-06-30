@extends('layouts.app')
    
@section('content')
<main id="main">
    {{ Breadcrumbs::render() }}
    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">
        <div class="row">
          <div class="col-lg-8 entries">
            @if(!empty($featuredArticles))
            @foreach($featuredArticles as $article)
              @include('article')
            @endforeach
            @endif
            <div class="justify-content-center">
              {{ $featuredArticles->links() }}
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