<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $postsFromDb = Post::all(); // Collection

        return View('posts.index' , ['allPosts' =>$postsFromDb]);

    }

    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $allUsers = User::all();
        return view('posts.create',['users' =>$allUsers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "title" =>['required','min:3'],
            "description" => ['required','max:1000','min:5'],
            "post_creator" => ['required','exists:users,id'],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' .  $extension;
            $path = 'public/images/';
            $file->move($path, $fileName);
        }

        Post::create([
            "title" => $request->title,
            "description" => $request->description,
            "user_id" => $request->post_creator,
            "image" => $path.$fileName,
        ]);
        // dd($data);
        // return $data;
        return to_route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {

        return view('posts.show',['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {

        $allUsers = User::all();
        return view('posts.edit',['users' =>$allUsers,'post' =>$post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $singlePost = Post::findOrFail($id);
        $request->validate([
            "title" =>['required','min:3'],
            "description" => ['required','max:1000','min:5'],
            "post_creator" => ['required','exists:users,id'],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $filePath = $singlePost->image;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' .  $extension;
            $path = 'public/images/';
            $file->move($path, $fileName);
            $filePath = $path.$fileName;
        }
        $singlePost->update([
            'title' => $request->title,
            'description' => $request->description,
            "user_id" => $request->post_creator,
            "image" => $filePath,
        ]);
        return to_route('posts.show',$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $destroyPost = Post::find($id);
        $destroyPost->delete();
        return to_route('posts.index');
    }
}
