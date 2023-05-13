<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\CreatePostRequest;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all posts
        //$posts = Post::all();
        $posts = Post::orderBy('id', 'asc')->get();
        //$posts = Post::latest()->get();
        
        //return the view to display all posts
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //load the view for post creation
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\CreatePostRequest $request)
    {
        //internal function to validate
        //use the below when you do not create a request specific for the form
        /*$this->validate($request, [
            'title' => 'required|max:5',
            'body' => 'required'
        ]);*/

        //to get all inputs posted from html
        //return $request->all();

        //to get a particular input posted from html
        //return $request->get('title');

        //you can call the input posted as a property as well
        //return $request->title;

        //---

        $file = $request->file('file');

        //manipulate file being uploaded
        //echo $file->getClientOriginalName();
        //echo "<br>";
        //echo $file->getSize();
        //die();

        //one way of storing info in database 

        $input = $request->all();

        if($file = $request->file('file')){

            $name = $file->getClientOriginalName();

            $file->move('images', $name);

            $input['path'] = $name . "_" .time();
        }

        Post::create($input);

        //---

        //$input = $request->all();
        //$input['title'] = $request->title;
        //Post::create($request->all());

        //---

        //$post = new Post;
        //$post->title = $request->title;
        //$post->save();

        //---

        //after created - we redirect
        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //find the post required - or fail
        $post = Post::findOrFail($id);
        //return the view as needed
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //find the post required - or fail
        $post = Post::findOrFail($id);

        return view('posts.edit', compact('post'));
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
        //get the post
        $post = Post::findOrFail($id);

        $post->update($request->all());

        return redirect('/posts?c=1');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //get the post
        $post = Post::findOrFail($id);
        //delete the post
        $post->delete();
        //redirect
        return redirect('/posts?d=1');
    }


    public function contact(){

        $people = ['Jonathan','Joe','George','Mario','Steve'];

        return view('contact', compact('people'));
    }

    //function displays a view with multiple parameters from URL
    public function show_post($id, $name, $password){

        //return view('post')->with('id', $id);

        //more compact version to pass multi parameters easier 
        return view('post', compact('id', 'name', 'password'));
    }
}
