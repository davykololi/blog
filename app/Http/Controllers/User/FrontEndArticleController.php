<?php

namespace App\Http\Controllers\User;

use Str;
use SEOMeta;
use OpenGraph;
use Twitter;
use JsonLd;
use Share;
use App\Models\Category;
use App\Models\Article;
use App\Models\Tag;
use App\Models\User;
use App\Models\Comment;
use Spatie\SchemaOrg\Schema;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontEndArticleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->url = URL::current();
        $this->appLogo = "https://frencymedia.com/static/logo.png";
        $this->appSubDomain = "http://www.frencymedia.com";
        $this->appMail = 'frencymedia@gmail.com';
        $this->orgName = config('app.name');
    }

    // Category Articles
    public function category($slug)
    {
        $category = Category::whereSlug($slug)->first();
        $categoryArticles = $category->articles()->with('category:id,name')->published()->latest()->get();

        $allArticles = Article::published()->latest()->inRandomOrder()->limit(10)->get();

        $politics = Category::whereName('Politics')->first();
        $politicsArticles = $politics->articles()->published()->latest()->limit(5)->get();

        $entertainment = Category::whereName('Entertainment')->first();
        $entertainmentArticles = $entertainment->articles()->published()->latest()->limit(5)->get();

        $title = $category->name." ".'News';
        $desc = $category->description;
        $publishedDate = $category->created_at;
        $modifiedDate = $category->updated_at;

        SEOMeta::setTitle($title);
        SEOMeta::setDescription($desc);
        SEOMeta::setKeywords($category->keywords);
        SEOMeta::setCanonical($this->url);

        OpenGraph::setTitle($title);
        OpenGraph::setDescription($desc);
        OpenGraph::setUrl($this->url);
        OpenGraph::addProperty('type','articleSection');

        Twitter::setTitle($title);
        Twitter::setSite('@frencymedia');
        Twitter::setDescription($desc);
        Twitter::setUrl($this->url);
        Twitter::setType('summary_large_image');

        JsonLd::setTitle($title);
        JsonLd::setDescription($desc);
        JsonLd::setType('articleSection');
        
        foreach($categoryArticles as $article){
        OpenGraph::addImage('https://frencymedia.com/storage/storage/'.$article->image,
            ['secure_url' => 'https://frencymedia.com/storage/storage/'.$article->image,
            'height'=>'628','width' =>'1200'
        ]);
        JsonLd::addImage('https://frencymedia.com/storage/storage/'.$article->image);
        Twitter::setImage('https://frencymedia.com/storage/storage/'.$article->image);
        }

        $newsArticles = Schema::NewsArticle()
                ->articleSection($title)
                ->description($desc)
                ->datePublished($publishedDate)
                ->dateModified($modifiedDate)
                ->email($this->appMail)
                ->url($this->url)
                ->sameAS($this->appSubDomain)
                ->logo(Schema::ImageObject()->url($this->appLogo));
        echo $newsArticles->toScript();

        $data = [
            'category' => $category,
            'categoryArticles' => $categoryArticles,
            'allArticles' => $allArticles,
            'politics' => $politics,
            'politicsArticles' => $politicsArticles,
            'entertainment' => $entertainment,
            'entertainmentArticles' => $entertainmentArticles,
        ];

        return view('user.category.articles',$data);
    }
    
    public function article($slug)
    {
    	$article = Article::with('user.comments','category','tags')->where('slug',$slug)->published()->first();
    	if(!$article)
    	{
       		return redirect('/')->withErrors('requested page not found');
    	}

        $allArticles = Article::published()->latest()->inRandomOrder()->limit(10)->get();

        $politics = Category::whereName('Politics')->first();
        $politicsArticles = $politics->articles()->published()->latest()->limit(5)->get();

        $entertainment = Category::whereName('Entertainment')->first();
        $entertainmentArticles = $entertainment->articles()->published()->latest()->limit(5)->get();

        $title = $article->title;
        $desc = $article->description;
        $publishedDate = $article->created_at;
        $modifiedDate = $article->updated_at;
        $author = $article->user->name;
        $imageUrl = 'https://frencymedia.com/storage/storage/'.$article->image;
        $width = '1200';
        $height = '628';

        SEOMeta::setTitle($title);
        SEOMeta::setDescription($desc);
        SEOMeta::setKeywords($article->keywords);
        SEOMeta::addMeta('article:published_time', $article->created_at->toW3CString(),'property');
        SEOMeta::addMeta('article:section', strtolower($article->category->name),'property');
        SEOMeta::setCanonical($this->url);

        OpenGraph::setTitle($title);
        OpenGraph::setDescription($desc);
        OpenGraph::setUrl($this->url);
        OpenGraph::addProperty('type','Article');
        OpenGraph::addProperty('locale','en-US');
        OpenGraph::addImage('https://frencymedia.com/storage/storage/'.$article->image,
            ['secure_url' => 'https://frencymedia.com/storage/storage/'.$article->image,
            'height'=>'628','width' =>'1200'
        ]);

        Twitter::setTitle($title);
        Twitter::setSite('@frencymedia');
        Twitter::setDescription($desc);
        Twitter::setUrl($this->url);
        Twitter::setImage('https://frencymedia.com/storage/storage/'.$article->image);
        Twitter::setType('summary_large_image');

        JsonLd::setTitle($title);
        JsonLd::setDescription($desc);
        JsonLd::setType('NewsArticle');
        JsonLd::addImage('https://frencymedia.com/storage/storage/'.$article->image);

        $newsArticles = Schema::NewsArticle()
                ->headline($title)
                ->description($desc)
                ->datePublished($publishedDate)
                ->dateModified($modifiedDate)
                ->image(Schema::ImageObject()->url($imageUrl)->width($width)->height($height))
                ->author(Schema::Person()->name($author))
                ->publisher(Schema::Organization()->name($this->orgName))
                ->email($this->appMail)
                ->url($this->url)
                ->sameAS($this->appSubDomain)
                ->affiliate(Schema::Organization()->name($this->orgName))
                ->logo(Schema::ImageObject()->url($this->appLogo));
        echo $newsArticles->toScript();

        $shareConponent = Share::currentPage()
            ->facebook()
            ->twitter()
            ->linkedin($desc)
            ->telegram()
            ->whatsapp()
            ->reddit();
        
        $data = [
            'article' => $article,
            'shareConponent' => $shareConponent,
            'allArticles' => $allArticles,
            'politics' => $politics,
            'politicsArticles' => $politicsArticles,
            'entertainment' => $entertainment,
            'entertainmentArticles' => $entertainmentArticles,
        ];

    	return view('user.article.article',$data);
  	}

    public function tag($slug)
    {
        $tag = Tag::whereSlug($slug)->first();
        if(!$tag)
        {
            return redirect('/')->withErrors('requested page not found');
        }

        $tagArticles = $tag->articles()->published()->latest()->limit(10)->get();
        $allArticles = Article::published()->latest()->inRandomOrder()->limit(10)->get();

        $politics = Category::whereName('Politics')->first();
        $politicsArticles = $politics->articles()->published()->latest()->limit(5)->get();

        $entertainment = Category::whereName('Entertainment')->first();
        $entertainmentArticles = $entertainment->articles()->published()->latest()->limit(5)->get();

        $title = $tag->name;
        $desc = $tag->description;
        $publishedDate = $tag->created_at;
        $modifiedDate = $tag->updated_at;

        SEOMeta::setTitle($title);
        SEOMeta::setDescription($desc);
        SEOMeta::setKeywords($tag->keywords);
        SEOMeta::setCanonical($this->url);

        OpenGraph::setTitle($title);
        OpenGraph::setDescription($desc);
        OpenGraph::setUrl($this->url);
        OpenGraph::addProperty('type','Place');

        Twitter::setTitle($title);
        Twitter::setSite('@frencydia');
        Twitter::setDescription($desc);
        Twitter::setUrl($this->url);
        Twitter::setType('summary_large_image');

        JsonLd::setTitle($title);
        JsonLd::setDescription($desc);
        JsonLd::setType('Place');

        foreach($tag->articles as $article){
        OpenGraph::addImage('https://frencymedia.com/storage/storage/'.$article->image,
            ['secure_url' => 'https://frencymedia.com/storage/storage/'.$article->image,
            'height'=>'628','width' =>'1200'
        ]);
        JsonLd::addImage('https://frencymedia.com/storage/storage/'.$article->image);
        Twitter::setImage('https://frencymedia.com/storage/storage/'.$article->image);
        }

        $tagNews = Schema::Place()
                ->headline($title)
                ->description($desc)
                ->datePublished($publishedDate)
                ->dateModified($modifiedDate)
                ->email($this->appMail)
                ->url($this->url)
                ->sameAS($this->appSubDomain)
                ->logo(Schema::ImageObject()->url($this->appLogo));
        echo $tagNews->toScript();
        
        $data = [
            'tag' => $tag,
            'tagArticles' => $tagArticles,
            'allArticles' => $allArticles,
            'politics' => $politics,
            'politicsArticles' => $politicsArticles,
            'entertainment' => $entertainment,
            'entertainmentArticles' => $entertainmentArticles,
        ];

        return view('user.tag.articles',$data);
    }

    public function articleBy($slug)
    {
        $author = User::whereRole('author')->whereSlug($slug)->first();
        if(!$author)
        {
            return redirect('/')->withErrors('requested page not found');
        }

        $authorArticles = $author->articles()->published()->latest()->limit(10)->get();
        $allArticles = Article::published()->latest()->inRandomOrder()->limit(10)->get();

        $politics = Category::whereName('Politics')->first();
        $politicsArticles = $politics->articles()->published()->latest()->limit(5)->get();

        $entertainment = Category::whereName('Entertainment')->first();
        $entertainmentArticles = $entertainment->articles()->published()->latest()->limit(5)->get();

        $name = $author->name;
        $title = 'Articles By'." ".$name;
        $email = $author->email;
        $image = 'https://frencymedia.com/storage/storage/'.$author->image;
        $publishedDate = $author->created_at;
        $modifiedDate = $author->updated_at;
        $phone = $author->phone_no;
        $area = $author->area;

        SEOMeta::setTitle($name);
        SEOMeta::setDescription($title);
        SEOMeta::setKeywords($author->keywords);
        SEOMeta::setCanonical($this->url);

        OpenGraph::setTitle($name);
        OpenGraph::setDescription($title);
        OpenGraph::setUrl($this->url);
        OpenGraph::addProperty('type','Person');

        Twitter::setTitle($name);
        Twitter::setSite('@frencymedia');
        Twitter::setDescription($title);
        Twitter::setUrl($this->url);
        Twitter::setType('summary_large_image');

        JsonLd::setTitle($name);
        JsonLd::setDescription($title);
        JsonLd::setType('Person');

        foreach($authorArticles as $article){
        OpenGraph::addImage('https://frencymedia.com/storage/storage/'.$article->image,['height'=>'628','width' =>'1200']);
        JsonLd::addImage('https://frencymedia.com/storage/storage/'.$article->image);
        Twitter::setImage('https://frencymedia.com/storage/storage/'.$article->image);
        }

        $userArticles = Schema::Person()
                ->name($name)
                ->image($image)
                ->logo(Schema::ImageObject()->url($this->appLogo))
                ->url($this->url)
                ->sameAS($this->appSubDomain)
                ->datePublished($publishedDate)
                ->dateModified($modifiedDate)
                ->contactPoint([Schema::ContactPoint()->email($email)->phone($phone)->areaServed($area)])
              	->affiliate(Schema::Organization()->name($this->orgName)->email($this->appMail));
        echo $userArticles->toScript();
        
        $data = [
            'author' => $author,
            'authorArticles' => $authorArticles,
            'allArticles' => $allArticles,
            'politics' => $politics,
            'politicsArticles' => $politicsArticles,
            'entertainment' => $entertainment,
            'entertainmentArticles' => $entertainmentArticles,
        ];

        return view('user.author.articles',$data);
    }
}
