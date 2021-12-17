<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use App\Models\Category;
use App\Models\Article;
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail){
    $trail->push('Home', route('home'));
});

// Home > Blog > [Category]
Breadcrumbs::for('category', function (BreadcrumbTrail $trail, Category $category){
    $trail->parent('home');
    $trail->push($category->name, route('category.articles',['name'=>$category->name]));
});

// Home > Article
Breadcrumbs::for('article', function (BreadcrumbTrail $trail, Category $category, Article $article){
    $trail->parent('category',$category);
    $trail->push($article->title, route('article.details',['title'=>$article->title]));
});

