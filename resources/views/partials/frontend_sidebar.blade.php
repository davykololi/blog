          <div class="col-lg-4">

            <div class="sidebar">

              <h3 class="sidebar-title">Search</h3>
              <div class="sidebar-item search-form">
                <form action="">
                  <input type="text">
                  <button type="submit"><i class="bi bi-search"></i></button>
                </form>
              </div><!-- End sidebar search formn-->

              <h3 class="sidebar-title">Categories</h3>
              
              <div class="sidebar-item categories">
                <ul>
                  @if(!empty($categories))
                  @foreach($categories as $cat)
                  <li><a href="{!! $cat->path() !!}">{{ $cat->name }} <span>({{ $cat->articles->count() }})</span></a></li>
                  @endforeach
                  @endif
                </ul>
              </div><!-- End sidebar categories-->

              <!-- Sidebar Titles -->
              @include('partials.aside_titles')
              <!-- End Sidebar Titles -->
              <div class="sidebar-item recent-posts">
                @if(!empty($asides))
                @foreach($asides as $art)
                <div class="post-item clearfix">
                  <img src="{{ $art->imageUrl() }}" alt="{{ $art->title }}" loading="lazy">
                  <h4><a href="{{ $art->path() }}">{{ $art->title }}</a></h4>
                  <time datetime="{{$art->createdDate()}}">{{$art->createdDate()}}</time>
                </div>
                @endforeach
                @endif
              </div><!-- End sidebar recent posts-->

              <h3 class="sidebar-title">Popular Articles</h3>
              <div class="sidebar-item recent-posts">
                
                <div class="post-item clearfix">
                  <img src="#" alt="#" loading="lazy">
                  <h4><a href="#"></a></h4>
                  <time datetime="#"></time>
                </div>
                
              </div><!-- End sidebar category articles-->

              <h3 class="sidebar-title">Tags</h3>
              <div class="sidebar-item tags">
                <ul>
                  @if(!empty($tags))
                  @foreach($tags as $tag)
                  <li><a href="{!! $tag->path() !!}">{{ $tag->name }}</a></li>
                  @endforeach
                  @endif
                </ul>
              </div><!-- End sidebar tags-->
              
            </div><!-- End sidebar -->

          </div><!-- End blog sidebar -->