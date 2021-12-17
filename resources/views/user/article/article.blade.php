    @extends('layouts.app')
    
    @section('content')
    @if($article)
    <div class="row">
      <div class="col-md-4 col-sm-12">
        SIDEBAR
      </div>
      <div class="col-md-8 col-sm-12">
        <h1>{!! $article->title !!}</h1>
        <i>Posted On: {{ $article->created_at->toDayDateTimeString() }}<span style="color: purple"> By: </span>
          <a href="{{ $article->user->path() }}">{{ $article->user->name}}</a>
        </i>
        <p><img src="{{ $article->imageUrl() }}" width="350" height="250" alt="{{ $article->title }}"></p>
        <p>{!! $article->content !!}</p>
      <div class="container mt-4 text-center">
        <h5><b>share:</b></h5>
        {!! $shareConponent !!}
      </div> 
      <div>
        <h2>Leave a comment</h2>
      </div>
      @if(Auth::guest())
        <p>Login to Comment</p>
      @else
        <div class="panel-body">
          <form method="post" action="">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="on_post" value="{{ $article->id }}">
            <input type="hidden" name="slug" value="{{ $article->slug }}">
            <div class="form-group">
              <textarea required="required" placeholder="Enter comment here" name = "content" class="form-control"></textarea>
            </div>
            <input type="submit" name='content' class="btn btn-success" value = "Submit"/>
          </form>
        </div>
      @endif
      <div>
        <ul style="list-style: none; padding: 0">
          @foreach($article->comments as $comment)
            <li class="panel-body">
              <div class="list-group">
                <div class="list-group-item">
                  <h3>{{ $comment->author->name }}</h3>
                  <p>{{ $comment->created_at->format('M d,Y \a\t h:i a') }}</p>
                </div>
                <div class="list-group-item">
                  <p>{{ $comment->content }}</p>
                </div>
              </div>
            </li>
          @endforeach
        </ul>
      </div> 
      </div>
    </div>
    @else
    404 error
    @endif

    <hr/>
    <br/><br/>

    @include('politics_articles') <!-- Latest Politics Articles -->
    @include('entertainment_articles') <!-- Latest Entertainment Articles -->
    @include('all_articles') <!-- All Articles In Randomn Order-->
    @include('user.newsletter') <!-- Newsletter Subscription Form-->

    @endsection

    @section('script')
        @yield('script')
    @endsection
