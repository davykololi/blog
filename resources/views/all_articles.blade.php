<div>
	<h2 style="text-transform: uppercase;">The Latest {{ config('app.name') }} News</h2>
	@forelse( $allArticles as $article )
    	@include('article')
    @empty
    	<p class="text-danger">No Article(s)</p>
    @endforelse
</div>