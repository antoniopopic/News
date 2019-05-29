<?php
use App\Http\Controllers\PostController;
use App\Post;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CommentController;

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

Route::get('/', function () {
    $posts = Post::latest()->paginate(30);
    return View::make('posts.index')->with('posts', $posts);
});

//Users

Route::get('/users', 'UsersController@index')->name('users.index')->middleware('roles:admin');
Route::get('/users/create', 'UsersController@create')->name('users.create')->middleware('roles:admin');
Route::post('/users', 'UsersController@store')->name('users.store')->middleware('roles:admin');
Route::get('/users/{user}',	'UsersController@show')->name('users.show')->middleware('roles:admin');
Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit')->middleware('roles:admin');
Route::patch('/users/{user}',	'UsersController@update')->name('users.update')->middleware('roles:admin');
Route::delete('/users/{user}', 'UsersController@destroy')->name('users.destroy')->middleware('roles:admin');

Route::get('/profile', 'UsersController@profile')->name('profile');
Route::post('/profile', 'UsersController@avatar');
Route::post('/','UsersController@changePassword')->name('changePassword');

Auth::routes(['verify' => true]);

Route::get('/home', function () {
    return redirect('/posts');
})->name('home');

Route::group(['middleware'=>['roles:admin,editor']],function(){
Route::get('/posts/create', 'PostController@create')->name('posts.create');
Route::post('/posts', 'PostController@store')->name('posts.store');
Route::get('/posts/{post}/edit', 'PostController@edit')->name('posts.edit');
Route::patch('/posts/{post}',	'PostController@update')->name('posts.update');
Route::delete('/posts/{post}', 'PostController@destroy')->name('posts.destroy');
Route::get('/search', 'PostController@search'); 
});
Route::get('/posts', 'PostController@index')->name('posts.index');
Route::get('/posts/{slug}',	'PostController@show')->name('posts.show');


Route::post('/posts/{slug}/comment', 'CommentController@store')->middleware('verified');
Route::get('/posts/{slug}/comments', 'CommentController@show')->name('posts.comments');

Route::get('/posts/categories/{category}', 'CategoryController@index')->name('categories');

Route::get('/posts/tags/{tag}', 'TagController@index')->name('tags');
Route::post('/tags', 'TagController@store')->name('tags.store');

