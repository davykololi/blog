<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
 use App\Http\Requests\TagCreateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tags = Tag::latest()->paginate(5);

        return view('admin.tags.index',compact('tags'))->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagCreateRequest $request)
    {
        //
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'required',
            'keywords' => 'required|string',
        ]);

        $tag = Tag::create($validated);
        toastr()->success(ucwords($tag->name." ".'tag created successfully'));

        return redirect()->route('admin.tags.index');
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
        $tag = Tag::findOrFail($id);

        return view('admin.tags.show',compact('tag'));
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
        $tag = Tag::findOrFail($id);

        return view('admin.tags.edit',compact('tag'));
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
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'required',
            'keywords' => 'required|string',
        ]);

        $tag = Tag::findOrFail($id);
        $tag->update($validated);
        toastr()->success(ucwords($tag->name." ".'tag updated successfully'));

        return redirect()->route('admin.tags.index');
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
        $tag = Tag::findOrFail($id);
        $tag->delete();
        toastr()->success(ucwords($tag->name." ".'tag deleted successfully'));

        return redirect()->route('admin.tags.index');
    }
}
