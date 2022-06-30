<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Editor\EditorController;
use App\Http\Controllers\Author\AuthorController;
use App\Http\Controllers\Admin\EditorUserController;
use App\Http\Controllers\Admin\AuthorUserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Author\ArticleController;
use App\Http\Controllers\Editor\EditorArticleController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\User\FrontEndArticleController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\PagesController;
use App\Http\Controllers\User\NewsLetterController;
use App\Http\Controllers\Admin\FrontEndUsersController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\UserChangePasswordController;
use App\Http\Controllers\Admin\UserBanController;
use App\Http\Controllers\Admin\ImpersonateController;
use App\Http\Controllers\All\CKEditorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::controller(FrontEndArticleController::class)->group(function(){
	Route::get('/category/{slug}', 'category')->name('category.articles');
	Route::get('/article/{slug}', 'article')->name('article.details');
	Route::get('/tag/{slug}', 'tag')->name('tag.articles');
	Route::get('/article-by/{slug}', 'articleBy')->name('articleBy.articles');
});
//Blog Pages Routes
Route::controller(PagesController::class)->group(function(){
	Route::get('/contact', 'contact')->name('contact')->middleware('doNotCacheResponse');
	Route::post('/contact-store', 'store')->name('contact.store');
	Route::get('/portfolio', 'portfolio')->name('portfolio');
	Route::get('/about', 'about')->name('about');
});
//Newsletter Route
Route::post('newsletter', [NewsLetterController::class, 'store'])->name('newsletter');
// Social login routes
Route::controller(LoginController::class)->group(function(){
	Route::get('login/{provider}','redirectToProvider');
	Route::get('{provider}/callback','handleProviderCallback');
});
//Authorization routes
Route::group(['middleware'=>'doNotCacheResponse'],function(){
	Auth::routes();
});

Route::group(['middleware'=>'prevent-back-history'],function(){ // Start of prevent-back-history middleware
	
Route::prefix('user')->name('user.')->middleware(['auth','user'])->group(function(){
	Route::get('/dashboard',UserDashboardController::class)->name('dashboard');
	Route::get('/change-password', [UserChangePasswordController::class,'index'])->name('change.password')->middleware('doNotCacheResponse');
	Route::post('/change-password', [UserChangePasswordController::class,'userChangePassword']);
});

Route::prefix('admin')->name('admin.')->middleware(['auth','admin','impersonate.protect','can:isAdmin','doNotCacheResponse','password.confirm'])->group(function(){
	Route::get('/dashboard',AdminController::class)->name('dashboard');
	Route::resource('/editors',EditorUserController::class);
	Route::resource('/authors',AuthorUserController::class);
	Route::resource('/categories',CategoryController::class);
	Route::resource('/sub-categories',SubCategoryController::class);
	Route::resource('/tags',TagController::class);
	Route::get('/front-end-users',FrontEndUsersController::class)->name('frontendusers');
	Route::get('/bann/{id}',[UserBanController::class,'ban'])->name('bann');
    Route::get('/revoke-bann/{id}',[UserBanController::class,'revoke'])->name('revoke');
	Route::get('impersonate/{id}',[ImpersonateController::class,'impersonate'])->name('impersonate');
	
});

Route::prefix('editor')->name('editor.')->middleware(['auth','editor','can:isEditor','admin_ban','doNotCacheResponse','password.confirm'])->group(function(){
	Route::get('/dashboard',EditorController::class)->name('dashboard');
	Route::resource('/articles',EditorArticleController::class);
	Route::get('impersonate-leave',[ImpersonateController::class,'impersonateLeave'])->name('impersonate-leave');
});

Route::prefix('author')->name('author.')->middleware(['auth','author','can:isAuthor','admin_ban','doNotCacheResponse','sweetalert','password.confirm'])->group(function(){
	Route::get('/dashboard',AuthorController::class)->name('dashboard');
	Route::resource('/articles',ArticleController::class);
	Route::get('impersonate-leave',[ImpersonateController::class,'impersonateLeave'])->name('impersonate-leave');
	Route::post('/upload-image',[CKEditorController::class,'upload'])->name('upload');
});

}); // End of prevent-back-history middleware
//RSS Feed route
Route::feeds();