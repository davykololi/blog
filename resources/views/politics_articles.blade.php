<div>	
    @if($politics)
		<h2 style="text-transform: uppercase;">{{ $politics->name }} News</h2>
	@if(!empty($politicsArticles))
     	@forelse($politicsArticles as $article)
            @include('article')
     	@empty
            <p class="text-danger">No Article(s)</p>
     	@endforelse
    @endif
    @endif
</div>
