<?php

namespace App\Http\Controllers\Author;

use Auth;
use Storage;
use Alert;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Traits\ImageUploadTrait;
use App\Services\ArticleService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $articles =  auth()->user()->articles()->with('category:id,name')->latest()->paginate(5);
        $title = 'Author Articles';
        
        return view('author.articles.index',compact('articles','title'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        $tags = Tag::all()->pluck('name','id');

        return view('author.articles.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'content' => 'required|string',
            'caption' => 'required',
            'keywords' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg,bmp|max:2048',
            'category'   => 'required|exists:categories,id',
            'tags'   => 'required|exists:tags,id',
        ]);

        if(Auth::user()->isAuthor()){
        	$data = $request->all();
        	$data['image'] = $this->verifyAndUpload($request,'image','public/storage/');
        	$data['category_id'] = $request->category;
        	$data['user_id'] = auth()->user()->id;
        	$article = Article::create($data);
        	$tags = $request->tags;
        	$article->tags()->sync($tags);
            toastr()->success(ucwords($article->title." ".'Article created successfully'));

        	return redirect()->route('author.articles.index');
        } else {
            toastr()->error(ucwords('You have no sufficient permission for writing article'));

        	return redirect('/');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $article = Article::findOrFail($id);
        if(Auth::user()->isAuthor() && $article){
        	return view('author.articles.show',compact('article'));
        } else {
            toastr()->error(ucwords('You have no sufficient permission to view this article'));

        	return redirect('/');
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $article = Article::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all()->pluck('name','id');
        $articleTags = $article->tags;

        return view('author.articles.edit',compact('article','categories','tags','articleTags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required',
            'content' => 'required|string',
            'caption' => 'required',
            'keywords' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg,bmp|max:2048',
            'category'   => 'required|exists:categories,id',
            'tags'   => 'required|exists:tags,id',
        ]);

        $article = Article::findOrFail($id);
        if(Auth::user()->isAuthor() && $article){
            Storage::delete('public/storage/'.$article->image);
            $data = $request->all();
            $data['image'] = $this->verifyAndUpload($request,'image','public/storage/');
            $data['category_id'] = $request->category;
            $data['user_id'] = auth()->user()->id;
            $article->update($data);
            $tags = $request->tags;
            $article->tags()->sync($tags);
            toastr()->success(ucwords($article->title." ".'Article updated successfully'));
     
            return redirect()->route('author.articles.index');
        } else {
            toastr()->error(ucwords('You have no sufficient permission for editing this article'));

        	return redirect('/');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $article = Article::findOrFail($id);
        if(Auth::user()->isAuthor() && $article){
            Storage::delete('public/storage/'.$article->image);
            $article->delete();
            $article->tags()->detach(); 
            toastr()->success(ucwords($article->title." ".'Article deleted successfully'));
    
            return redirect()->route('author.articles.index');
        }
    }
}
