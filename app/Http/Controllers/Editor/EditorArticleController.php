<?php

namespace App\Http\Controllers\Editor;

use Auth;
use Storage;
use App\Models\User;
use App\Models\Tag;
use App\Models\Article;
use App\Models\Category;
use Carbon\Carbon;
use App\Traits\ImageUploadTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EditorArticleController extends Controller
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
        $articles = Article::where('published_at', '<=', Carbon::now())->orderBy('published_at', 'desc')->paginate(config('blog.articles_per_page')); 
        
        return view('editor.articles.index',compact('articles'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        return view('editor.articles.show',compact('article'));
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
        $authors = User::where('role','author')->get();

        return view('editor.articles.edit',compact('article','categories','tags','articleTags','authors'));
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
        if($article){
            Storage::delete('public/storage/'.$article->image);
            $data = $request->all();
            $data['image'] = $this->verifyAndUpload($request,'image','public/storage/');
            $data['category_id'] = $request->category;
            $data['user_id'] = $request->author;
            $data['is_published']  = $request->has('publish');
            $data['published_at'] = now();
            $data['published_by'] = Auth::user()->name;
            $article->update($data);
            $tags = $request->tags;
            $article->tags()->sync($tags);
            toastr()->success(ucwords($article->title." ".'Article updated successfully'));
     
            return redirect()->route('editor.articles.index');
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
        if($article){
            Storage::delete('public/storage/'.$article->image);
            $article->delete();
            toastr()->success(ucwords($article->title." ".'Article deleted successfully'));
    
            return redirect()->route('editor.articles.index');
        }
    }
}
