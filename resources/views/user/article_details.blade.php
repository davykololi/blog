@extends('layouts.app')
    
@section('content')
<main id="main">
  @if($article)
   {{ Breadcrumbs::render('article.details',$article) }} 
    <!-- ======= Blog Single Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">
        <div class="row">
          <div class="col-lg-8 entries">
            <article class="entry entry-single">
              <div class="entry-img">
                <img src="{{ $article->imageUrl() }}" alt="{{ $article->title }}" class="img-fluid">
              </div>
              <h1 class="entry-title">
                <a href="{{ $article->path() }}">{{ $article->title }}</a>
              </h1>
              <div class="entry-meta">
                <ul>
                  <li class="d-flex align-items-center"><i class="bi bi-person"></i> 
                    <a href="{{ $article->user->path() }}">{{ $article->user->name }}</a>
                  </li>
                  <li class="d-flex align-items-center"><i class="bi bi-clock"></i> 
                    <a href="{{ $article->path() }}"><time datetime="{{$article->createdDate()}}">{{$article->createdDate()}}</time></a>
                  </li>
                  <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> 
                    <a href="{{ $article->path() }}">{{ $article->comments->count() }} Comments</a>
                  </li>
                </ul>
              </div>
              <div class="entry-content">
                <p>{!! $article->content !!}</p>
              </div>
              <div class="entry-footer">
                <i class="bi bi-folder"></i>
                <ul class="cats">
                  <li><a href="#">Business</a></li>
                </ul>

                <i class="bi bi-tags"></i>
                <ul class="tags">
                  <li><a href="#">Creative</a></li>
                  <li><a href="#">Tips</a></li>
                  <li><a href="#">Marketing</a></li>
                </ul>
              </div>

              <div class="container mt-4 text-center " loading="lazy">
                <h5><b>Share This Article:</b></h5>
                  {!! $shareComponent !!}
              </div><!-- End Social Media Share -->
              
            </article><!-- End blog entry -->
            <div class="blog-author d-flex align-items-center">
              <img src="{{ asset('assets/img/blog/blog-author.jpg') }}" class="rounded-circle float-left" alt="">
              <div>
                <h4>{{ $article->user->name }}<h4>
                <div class="social-links">
                  <a href="https://twitters.com/#"><i class="bi bi-twitter"></i></a>
                  <a href="https://facebook.com/#"><i class="bi bi-facebook"></i></a>
                  <a href="https://instagram.com/#"><i class="biu bi-instagram"></i></a>
                </div>
                <p>
                  Itaque quidem optio quia voluptatibus dolorem dolor. Modi eum sed possimus accusantium. Quas repellat voluptatem officia numquam sint aspernatur voluptas. Esse et accusantium ut unde voluptas.
                </p>
              </div>
            </div><!-- End blog author bio -->

            <div class="blog-comments">
              <h4 class="comments-count">{{ $article->comments->count() }} Comments</h4>
              <div id="comment-1" class="comment">
                <div class="d-flex">
                  <div class="comment-img"><img src="{{asset('assets/img/blog/comments-1.jpg') }}" alt=""></div>
                  <div>
                    <h5><a href="">Georgia Reader</a> <a href="#" class="reply"><i class="bi bi-reply-fill"></i> Reply</a></h5>
                    <time datetime="2020-01-01">01 Jan, 2020</time>
                    <p>
                      Et rerum totam nisi. Molestiae vel quam dolorum vel voluptatem et et. Est ad aut sapiente quis molestiae est qui cum soluta.
                      Vero aut rerum vel. Rerum quos laboriosam placeat ex qui. Sint qui facilis et.
                    </p>
                  </div>
                </div>
              </div><!-- End comment #1 -->
              <div id="comment-2" class="comment">
                <div class="d-flex">
                  <div class="comment-img"><img src="{{asset('assets/img/blog/comments-2.jpg') }}" alt=""></div>
                  <div>
                    <h5><a href="">Aron Alvarado</a> <a href="#" class="reply"><i class="bi bi-reply-fill"></i> Reply</a></h5>
                    <time datetime="2020-01-01">01 Jan, 2020</time>
                    <p>
                      Ipsam tempora sequi voluptatem quis sapiente non. Autem itaque eveniet saepe. Officiis illo ut beatae.
                    </p>
                  </div>
                </div>
                <div id="comment-reply-1" class="comment comment-reply">
                  <div class="d-flex">
                    <div class="comment-img"><img src="{{asset('assets/img/blog/comments-3.jpg') }}" alt=""></div>
                    <div>
                      <h5><a href="">Lynda Small</a> <a href="#" class="reply"><i class="bi bi-reply-fill"></i> Reply</a></h5>
                      <time datetime="2020-01-01">01 Jan, 2020</time>
                      <p>
                        Enim ipsa eum fugiat fuga repellat. Commodi quo quo dicta. Est ullam aspernatur ut vitae quia mollitia id non. Qui ad quas nostrum rerum sed necessitatibus aut est. Eum officiis sed repellat maxime vero nisi natus. Amet nesciunt nesciunt qui illum omnis est et dolor recusandae.

                        Recusandae sit ad aut impedit et. Ipsa labore dolor impedit et natus in porro aut. Magnam qui cum. Illo similique occaecati nihil modi eligendi. Pariatur distinctio labore omnis incidunt et illum. Expedita et dignissimos distinctio laborum minima fugiat.

                        Libero corporis qui. Nam illo odio beatae enim ducimus. Harum reiciendis error dolorum non autem quisquam vero rerum neque.
                      </p>
                    </div>
                  </div>
                </div><!-- End comment reply #1-->
              </div><!-- End comment #2-->
              <div class="reply-form">
                <h4>Leave a Reply</h4>
                <p>Your email address will not be published. Required fields are marked * </p>
                <form action="">
                  <div class="row">
                    <div class="col-md-6 form-group">
                      <input name="name" type="text" class="form-control" placeholder="Your Name*">
                    </div>
                    <div class="col-md-6 form-group">
                      <input name="email" type="text" class="form-control" placeholder="Your Email*">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col form-group">
                      <input name="website" type="text" class="form-control" placeholder="Your Website">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col form-group">
                      <textarea name="comment" class="form-control" placeholder="Your Comment*"></textarea>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Post Comment</button>
                </form>
              </div>
            </div><!-- End blog comments -->
          </div><!-- End blog entries list -->
          @include('partials.frontend_sidebar')
        </div>
      </div>
    </section><!-- End Blog Single Section -->
    @include('laravel_tutorials')<!-- Laravel Tutorials -->
    @include('reactjs_tutorials')<!-- React js Tutorials -->
    @include('tailwindcss_tutorials')<!-- Tailwind css Tutorials -->
    @include('vuejs_tutorials')<!-- Vue Js Tutorials -->
    @include('all_articles')<!-- Recent Articles -->
    @endif
  </main><!-- End #main -->
@endsection
