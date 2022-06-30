<?php

namespace App\Http\Controllers\Author;

use Auth;
use Storage;
use Alert;
use App\Models\Article;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Tag;
use App\Traits\ImageUploadTrait;
use App\Services\ArticleService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleFormRequest as StoreRequest;
use App\Http\Requests\ArticleFormRequest as UpdateRequest;

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
    public function store(StoreRequest $request)
    {
        //
        if(Auth::user()->isAuthor()){
        	$data = $request->all();
        	$data['image'] = $this->verifyAndUpload($request,'image','public/storage/');
        	$data['category_id'] = $request->category_id;
        	$data['user_id'] = auth()->user()->id;
        	$article = Article::create($data);
        	if($request->has('tags')){
            	$tags = $request->tags;
            	$article->tags()->sync($tags);
            }
            $article = Article::with('category','tags')->findOrFail($article->id);
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
            Article::findOrFail($id)->increment('total_views');
            
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
    public function update(UpdateRequest $request, $id)
    {
        //
        $article = Article::findOrFail($id);
        if(Auth::user()->isAuthor() && $article){
            Storage::delete('public/storage/'.$article->image);
            $data = $request->all();
            $data['image'] = $this->verifyAndUpload($request,'image','public/storage/');
            $data['category_id'] = $request->category_id;
            $data['user_id'] = auth()->user()->id;
            $article->update($data);
            if($request->has('tags')){
            	$tags = $request->tags;
            	$article->tags()->sync($tags);
            }
            $article = Article::with('category','tags')->findOrFail($article->id);
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
