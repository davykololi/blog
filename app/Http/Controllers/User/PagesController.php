<?php

namespace App\Http\Controllers\User;

use SEOMeta;
use OpenGraph;
use Twitter;
use JsonLd;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Contact;
use Carbon\Carbon;
use Spatie\SchemaOrg\Schema;
use App\Jobs\SendContactJob;
use App\Http\Requests\ContactFormRequest;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function contact()
    {
    	$allArticles = Article::latest()->published()->paginate(2);
        $asides = Article::latest()->published()->limit(10)->get();
        $categories = Category::with('articles')->limit(10)->get();
        $category = Category::with('articles')->limit(10)->get();
        $tags = Tag::with('articles')->get();

        $title = 'Contact Us';
        $desc = 'FrencyMedia Contact Us Page';
        $url = URL::current();

        SEOMeta::setTitle($title);
        SEOMeta::setDescription($desc);
        SEOMeta::setKeywords('contact us');
        SEOMeta::setCanonical($url);

        OpenGraph::setTitle($title);
        OpenGraph::setDescription($desc);
        OpenGraph::setUrl($url);
        OpenGraph::addProperty('type','ContactPage');

        Twitter::setTitle($title);
        Twitter::setSite('@frencymedia');
        Twitter::setDescription($desc);
        Twitter::setUrl($url);

        JsonLd::setTitle($title);
        JsonLd::setDescription($desc);
        JsonLd::setType('ContactPage');

        $contact = Schema::ContactPage()
                ->name($title)
                ->description($desc)
                ->url($url)
                ->logo("https://frencymedia.com/static/logo.png")
                ->sameAS("https://www.frencymedia.com")
                ->contactPoint([Schema::ContactPoint()
                ->telephone('254 0724351952')
                ->email('frencymedia@gmail.com')]);
        echo $contact->toScript();

        $data = array(
            'title' => $title,
        	'categories' => $categories,
            'allArticles' => $allArticles,
            'asides' => $asides,
            'tags' => $tags,
        );
    	
    	return view('user.contact',$data);
    }

    public function store(ContactFormRequest $request)
    {
        $contact = new Contact;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->save();

        // Mail Delivery logic goes here
        $emailJob = (new SendContactJob($contact))->delay(Carbon::now()->addMinutes(2));
        $this->dispatch($emailJob);

        return redirect()->back()->withSuccess(ucwords('Thank you for contacting us. We will get back to you soon'));
        //  return redirect()->route('contact.create');
    }

    public function portfolio()
    {
        $title = 'Portfolio';
        $desc = 'FrencyMedia Portfolio Page';
        $url = URL::current();

        SEOMeta::setTitle($title);
        SEOMeta::setDescription($desc);
        SEOMeta::setKeywords('portfolio');
        SEOMeta::setCanonical($url);

        OpenGraph::setTitle($title);
        OpenGraph::setDescription($desc);
        OpenGraph::setUrl($url);
        OpenGraph::addProperty('type','PortfolioPage');

        Twitter::setTitle($title);
        Twitter::setSite('@frencymedia');
        Twitter::setDescription($desc);
        Twitter::setUrl($url);

        JsonLd::setTitle($title);
        JsonLd::setDescription($desc);
        JsonLd::setType('PortfolioPage');

        $portfolio = Schema::ContactPage()
                ->name($title)
                ->description($desc)
                ->url($url)
                ->logo("https://frencymedia.com/static/logo.png")
                ->sameAS("https://www.frencymedia.com")
                ->contactPoint([Schema::ContactPoint()
                ->telephone('254 0724351952')
                ->email('frencymedia@gmail.com')]);
        echo $portfolio->toScript();

        $data = array(
            'title' => $title,
        );

        return view('user.portfolio',$data);
    }

    public function about()
    {
        $title = 'About Us';
        $desc = 'FrencyMedia About Us Page';
        $url = URL::current();

        SEOMeta::setTitle($title);
        SEOMeta::setDescription($desc);
        SEOMeta::setKeywords('about us');
        SEOMeta::setCanonical($url);

        OpenGraph::setTitle($title);
        OpenGraph::setDescription($desc);
        OpenGraph::setUrl($url);
        OpenGraph::addProperty('type','AboutUsPage');

        Twitter::setTitle($title);
        Twitter::setSite('@frencymedia');
        Twitter::setDescription($desc);
        Twitter::setUrl($url);

        JsonLd::setTitle($title);
        JsonLd::setDescription($desc);
        JsonLd::setType('AboutUsPage');

        $about = Schema::ContactPage()
                ->name($title)
                ->description($desc)
                ->url($url)
                ->logo("https://frencymedia.com/static/logo.png")
                ->sameAS("https://www.frencymedia.com")
                ->contactPoint([Schema::ContactPoint()
                ->telephone('254 0724351952')
                ->email('frencymedia@gmail.com')]);
        echo $about->toScript();

        $data = array(
            'title' => $title,
        );

        return view('user.about',$data);
    }
}
