<?php

use App\Models\Category;

function categories()
{
	return Category::eagerLoaded()->limit(10)->get();
}

function footer_categories()
{
	return Category::eagerLoaded()->get();
}