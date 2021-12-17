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
        $allArticles = Article::latest()->published()->paginate(20);
        $category = Category::with('articles')->limit(10)->get();

        $politics = Category::whereName('Politics')->first();
        $politicsArticles = $politics->articles()->published()->latest()->limit(5)->get();

        $entertainment = Category::whereName('Entertainment')->first();
        $entertainmentArticles = $entertainment->articles()->published()->latest()->limit(5)->get();

        $websiteName = config('app.name');
        $title = 'Home';
        $desc = 'Home for the latest captivating news in Kenya,East Africa,Africa and around the world';
        $keywords = 'latest captivating news in kenya';
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
            'allArticles' => $allArticles,
            'politics' => $politics,
            'politicsArticles' => $politicsArticles,
            'entertainment' => $entertainment,
            'entertainmentArticles' => $entertainmentArticles,
        ];

        return view('home',$data);
    }
}
