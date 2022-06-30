@if(!empty($category))
	<h3 class="sidebar-title">{{ $category->name }} Tutorials</h3>
@elseif(!empty($tag))
	<h3 class="sidebar-title">{{ $tag->name }} Tutorials</h3>
@elseif(!empty($author))
	<h3 class="sidebar-title">{{ $author->name }} Tutorials</h3>
@else
	<h3 class="sidebar-title">Recent Tutorials</h3>
@endif