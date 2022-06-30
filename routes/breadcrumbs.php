<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use App\Models\Category;
use App\Models\Tag;
use App\Models\Article;
use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail): void{
    $trail->push('Home', route('home'));
});

// Home > About
Breadcrumbs::for('about', function (BreadcrumbTrail $trail): void{
    $trail->parent('home');
    $trail->push('About Us', route('about'));
});

// Home > Contact
Breadcrumbs::for('contact', function (BreadcrumbTrail $trail): void{
    $trail->parent('home');
    $trail->push('Contact Us', route('contact'));
});

// Home > Portfolio
Breadcrumbs::for('portfolio', function (BreadcrumbTrail $trail): void{
    $trail->parent('home');
    $trail->push('Portfolio', route('portfolio'));
});

// Home > Login
Breadcrumbs::for('login', function (BreadcrumbTrail $trail): void{
    $trail->parent('home');
    $trail->push('Login', route('login'));
});

// Home > Register
Breadcrumbs::for('register', function (BreadcrumbTrail $trail): void{
    $trail->parent('home');
    $trail->push('Register', route('register'));
});

// Home > Category 
Breadcrumbs::for('category.articles', function (BreadcrumbTrail $trail, Category $category): void{
    $trail->parent('home');
    $trail->push($category->name, route('category.articles',['slug'=>$category->slug]));  
});

// Home > Tag
Breadcrumbs::for('tag.articles', function (BreadcrumbTrail $trail, Tag $tag): void{
    $trail->parent('home');
    $trail->push($tag->name, route('tag.articles',['slug'=>$tag->slug]));
});

// Home > Author
Breadcrumbs::for('articleBy.articles', function (BreadcrumbTrail $trail, User $user): void{
    $trail->parent('home');
    $trail->push($user->name, route('articleBy.articles',['slug'=>$user->slug]));
});

// Home > Category > Article Details
Breadcrumbs::for('article.details', function (BreadcrumbTrail $trail, Article $article): void{
    $trail->parent('home');
    $trail->push($article->category->name, route('category.articles',['slug'=>$article->category->slug]));
    $trail->push($article->title, route('article.details',['slug'=>$article->slug]));
});
