<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use App\Models\Country;
use Carbon\Carbon;


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

//all the routes accessable by the website non logged in
Route::group(['middleware' => ['web']], function (){ 
    Route::get('/', function () { 
        //App\Helpers\GlobalFunctions::pr("example of pr()", false, true);
        return view('welcome'); 
    });
});

Route::auth();

//all the routes accessable when logged in 
Route::group(['middleware' => ['auth']], function (){ 

    //profile page
    Route::resource('/profile', '\App\Http\Controllers\ProfileController');
    
    //post pages
    Route::resource('/posts', '\App\Http\Controllers\PostsController');

    //baker pages
});

Route::get('/admin/user/roles', ['middleware' => ['role', 'auth', 'web'], function(){ return "middlewat"; }]);

Route::get('/admin', '\App\Http\Controllers\AdminController@index');

Route::get('/admin/index', function(){ return view('admin.index'); });

//sending email
use Illuminate\Support\Facades\Mail;
Route::get('/sendmail', function(){

    $data = array();
    $data['title'] = "Hello!";
    $data['content'] = "This email was sent on " . date('d/m/Y H:i:s');

    Mail::send('mail.test', $data, function($message) {
        $message->to("jonathancauchi1991@gmail.com", "Jonathan")->subject("Hello again!");
    });

});

//------------------------------------------------------------------------------------

//ALL THE BELOW IS AN EXAMPLE OF MOSTLY EVERYTHING - DO NOT DELETE

/*

Route::get('/profile', function () {
    return "Profile page";
});

Route::get('/login', function () {
    return "Login page";
});

Route::get('/about', function () {
    return "About page";
});

Route::get('/contact', function () {
    return "Contact page";
});

Route::get('/post/{id}', function($id) {
    return "this is my id : " . $id;
});

Route::get('/posttwo/{id}/{name}', function($id, $name) {
    return "this is my id : " . $id . " - " . $name;
});

Route::get('admin/posts/example', array('as' => 'admin.home', function(){

    $url = route('admin.home');

    return "url is : " . $url;
}));

*/



//to use a function in a controller - in this case using the index
//Route::get('/post/{id}', '\App\Http\Controllers\PostsController@index');

//to set up a resource - use powershell to see the route list of the resource : php artisan route:list
//Route::resource('posts', '\App\Http\Controllers\PostsController');

//call controller function contact to load contact view
//Route::get('/contact', '\App\Http\Controllers\PostsController@contact');

//route calls a view with single parameter
//Route::get('/post/{id}', '\App\Http\Controllers\PostsController@show_post');

//route calls a view with multi parameters
//Route::get('/post/{id}/{name}/{password}', '\App\Http\Controllers\PostsController@show_post');

//---

//The router calls the controller
//The controller gets the view

//you can also call the view directly from the router, see first example

//---

/*

Create the Route in this file that will load the desired page according to the url supplied and point it to the correct controller
Create the function in the controller libraries and make it load the view that is required

*/


//********

//DATABASE QUERIES

//RAW

/*

Route::get('/CUDfunctions', function(){
    DB::insert('insert into post (title, body) values (?, ?)', ['php', 'text']);
    //DB::update('update post set body = ? where id = ?', ['new_body', '1']);
    //DB::delete('delete from post where id = ?', ['1']);
});

Route::get('/Rfunction', function(){
    $results = DB::select('select * from post where id = ?', ['2']);
    //var_dump($results);
    foreach($results as $k => $v) {
        return $v->title . " --- " . $v->body;
    }
});

//ELOQUENT

/*

Route::get('/read', function(){

    $posts = Post::all();
    
    foreach($posts as $post){
        return $post->title;
    }
});

*/

/*

//search the data 
Route::get('/find/{id}', function($id){
    $posts = Post::find($id);
    if(isset($posts->title)) { return "This is my title : " . $posts->title; }
    else { return "record not found";}
});

Route::get('/find_where', function(){
    $posts = Post::where('id', 2)->orderBy('id', 'desc')->take(1)->get();
    return $posts;
});

//function that search in the table and it fails if the record is not found
Route::get('/find_more', function(){
    $posts = Post::findOrFail(1);
    return $posts;

    //$posts = Post::where("users_count", '<', 50)->firstOrFail();
    //return $posts;
});

//to perform a basic insert
Route::get('/basic_insert', function(){
    $post = new Post;
    $post->title = "New title";
    $post->body = "New content";
    $post->save();
});

//to perform a basic insert 2
Route::get('/basic_insert_2', function(){
    $post = Post::find(2);
    $post->title = "New title wa";
    $post->body = "New content wa";
    $post->save();
});

//to perform a basic create
Route::get('/basic_create', function(){
    Post::create(['title' => 'this is a new title', 'body' => "this is a new body", "user_id" => "123"]);
});

//to perform a basic update
Route::get('/basic_update', function(){
    Post::where('id', 2)->where('is_admin', 0)->update(['title' => "im updating title", 'body' => "im updating body"]);
});

//to perform a basic delete
Route::get('/basic_delete', function(){
    $post = Post::find(3);
    $post->delete();
});

//to perform a basic delete 2
Route::get('/basic_delete_2', function(){
    Post::destroy(4);
    Post::destroy(5,6);
    Post::where('is_admin', 0)->delete();
});

//to perform a delete and put in a trash (soft delete)
Route::get('/soft_delete', function(){
    Post::find(9)->delete();
});

//to search for soft deleted
Route::get('/read_soft_delete', function(){
    $post = Post::withTrashed()->where('id', 9)->get();
    return $post;
});

//to search for soft deleted 2
Route::get('/read_soft_delete_2', function(){
    $post = Post::onlyTrashed()->get();
    return $post;
});

//restore soft delete 
Route::get('/restore_soft_delete', function(){
    Post::withTrashed()->where('id', 9)->restore();
});

//force delete a soft deleted parameter
Route::get('/force_delete', function(){
    Post::withTrashed()->where('id', 10)->forceDelete();
});

//force delete a soft deleted parameter 2 - only trash
Route::get('/force_delete_2', function(){
    //Post::withTrashed()->where('id', 10)->forceDelete();
    Post::onlyTrashed()->where('id', 11)->forceDelete();
});

//--------------------------------------------------------------

//ELOQUENT RELATIONSHIP

//one to one relationship - uses hasOne
Route::get('/user/{id}/post', function($id){
    $user = User::find($id)->post;
    return $user;
});

//inverse relationship - uses belongsTo
Route::get('/post/{id}/user', function($id){
    return Post::find($id)->user->name;
});

//one to many
Route::get('/get_all_posts/{id}', function($id){
    $user = User::find($id);
    foreach($user->get_all_posts as $post){
        echo $post->title;
        echo "<br>";
    }
});

//many to many
Route::get('/get_m2m_roles/{id}', function($id){

    $user = User::find($id)->get_roles()->orderBy('id', 'desc')->get();

    return $user;

    $user = User::find($id);
    foreach($user->get_roles as $role){
        echo $role->name;
        echo "<br>";
    }
});

//inverse many to many
//accessing the intermidiate table / pivot table

Route::get('/inverse_get_m2m/{id}', function($id){
    $user = User::find($id);
    foreach($user->get_roles as $role){
        echo $role->pivot->created_at;
    }
});

//has many through relation
Route::get('/user/country', function(){
    //search for country id 1 
    $country = Country::find(1);
    //load all posts from the country specifed above
    foreach($country->posts as $post){
        echo $post->title;
        echo "<br>";
    }
});

//polymorphic relationship

Route::get('/polymorphic_relations_1', function(){
    $post = Post::find(11);
    foreach($post->photos as $photo){
        echo $photo->path;
    }
});

----------------------------------------

//
Route::get('/dates', function(){
        $date = new DateTime('+1week');
        echo $date->format('Y-m-d');
        echo "<br>";
        echo Carbon::now()->addDays(10)->diffForHumans();
        echo "<br>";
        echo Carbon::now()->subMonths(5)->diffForHumans();
        echo "<br>";
        echo Carbon::now()->yesterday()->diffForHumans();
        echo "<br>";
        echo Carbon::now()->yesterday();
        echo "<br>";
        echo strtotime(Carbon::now()->yesterday());
        echo "<br>";
    });

    //route for the accessors
    Route::get('/get_name', function(){
        $user = User::find(1);
        echo $user->name;
    });

    //route for the mutator
    Route::get('/set_name', function(){
        $user = User::find(1);
        $user->name = "test";
        $user->save();
    });

*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
