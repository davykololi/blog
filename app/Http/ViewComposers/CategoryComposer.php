<?php

namespace App\Http\ViewComposers;

use App\Models\Category;
use Illuminate\View\View;

class CategoryComposer 
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */

    public function compose(View $view){
        $categories = Category::with('articles')->get();
        $navs = Category::with('articles')->limit(10)->get();
        $view->with(['categories'=>$categories,'navs'=>$navs]); 
    }
}
