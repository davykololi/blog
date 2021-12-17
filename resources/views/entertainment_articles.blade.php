<div>	
    @if($entertainment)
		<h2 style="text-transform: uppercase;">{{ $entertainment->name }} News</h2>
    @else
        <h2 style="text-transform: uppercase;">{{ $entertainment->name }} News Notyet Published</h2>
    @endif

	@if(!empty($entertainmentArticles))
     	@forelse($entertainmentArticles as $article)
            @include('article')
     	@empty
            <p class="text-danger">
                Sorry esteemed reader!, We are yet to publish <span style="color: blue">{{ $entertainment->name }}</span> article(s). Stay tuned and keep in touch. We value your readership and keep on visiting this site for the latest news in Kenya and around the world. Thank you.
            </p>
     	@endforelse
    @endif
</div>
