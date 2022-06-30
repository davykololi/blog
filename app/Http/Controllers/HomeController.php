<?php

namespace App\Http\Controllers;

use SEOMeta;
use OpenGraph;
use Twitter;
use JsonLd;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Spatie\SchemaOrg\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $featuredArticles = Article::latest()->published()->paginate(2);
        $allArticles = Article::query()->published()->inRandomOrder()->limit(10)->get();
        $asides = Article::query()->latest()->published()->limit(10)->get();
        $categories = categories();
        $category = Category::with('articles')->limit(10)->get();
        $tags = Tag::with('articles')->get();

        $laravel = Category::laravelCategory();
        $laravelArticles = $laravel->articles()->published()->latest()->limit(5)->get();

        $reactJs = Category::reactJsCategory();
        $reactJsArticles = $reactJs->articles()->published()->latest()->limit(5)->get();

        $vueJs = Category::vueJsCategory();
        $vueJsArticles = $vueJs->articles()->published()->latest()->limit(5)->get();

        $tailwindCss = Category::tailwindCssCategory();
        $tailwindCssArticles = $tailwindCss->articles()->published()->latest()->limit(5)->get();

        $websiteName = config('app.name');
        $title = 'Home';
        $desc = 'The platform for laravel, vue js, react js, tailwind css and bootstrap tutorials and other latest programming online tutorials';
        $keywords = 'react js tutorials, vue js tutorials, laravel tutorials,tailwind css tutorials';
        $url = URL::current();
        $tel = '+254 0724351952';
        $logo = 'https://frencymedia.com/static/logo.jpg';

        SEOMeta::setTitle($title);
        SEOMeta::setDescription($desc);
        SEOMeta::setCanonical($url);

        OpenGraph::setTitle($title);
        OpenGraph::setDescription($desc);
        OpenGraph::setUrl($url);
        OpenGraph::addProperty('type','Website');
        OpenGraph::addProperty('locale','en-US');

        Twitter::setTitle($title);
        Twitter::setSite('@frencymedia');
        Twitter::setDescription($desc);
        Twitter::setUrl($url);

        JsonLd::setTitle($title);
        JsonLd::setDescription($desc);
        JsonLd::setType('Website');
        JsonLd::addImage($logo);

        $webSite = Schema::Website()
                ->name($websiteName)
                ->headline($title)
                ->description($desc)
                ->keywords($keywords)
                ->email('frencydia@gmail.com')
                ->url($url)
                ->contactPoint(Schema::ContactPoint()->telephone($tel)->areaServed('Worldwide'))
                ->address(Schema::PostalAddress()->addressCountry('Kenya')->postalCode('254')->streetAddress('688'))
                ->sameAS("http://www.frencymedia.com")
                ->logo(Schema::ImageObject()->url($logo));
                
        echo $webSite->toScript();

        $data = [
        	'title' => $title,
            'categories' => $categories,
            'featuredArticles' => $featuredArticles,
            'allArticles' => $allArticles,
            'asides' => $asides,
            'tags' => $tags,
            'laravel' => $laravel,
            'laravelArticles' => $laravelArticles,
            'reactJs' => $reactJs,
            'reactJsArticles' => $reactJsArticles,
            'vueJs' => $vueJs,
            'vueJsArticles' => $vueJsArticles,
            'tailwindCss' => $tailwindCss,
            'tailwindCssArticles' => $tailwindCssArticles,
        ];

        return view('home',$data);
    }
}
