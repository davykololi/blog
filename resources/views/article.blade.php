    <article> 
      <div class="list-group">
        <div class="list-group-item">
          <h3><a href="{{ $article->path() }}">{{ $article->title }}</a></h3>
          <i>Posted On: {{ $article->created_at->toDayDateTimeString() }}<span style="color: purple"> By: </span>
            <a href="{{ $article->user->path() }}">{{ $article->user->name }}</a>
          </i>
          <br/>
          <p><img src="{{ $article->imageUrl() }}" style="width: 20%" alt="{{ $article->title }}"></p>
        </div>
        <div class="list-group-item">
            <p>{!! $article->excerpt() !!}<a href="{!! $article->path() !!}" class="btn btn-link">Read More</a></p>
            @include('partials.article_tags')
        </div>
      </div>
    </article>