<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('home')->with([
            'posts' => Post::all(),
            'users' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:10',
            'content' => 'required|max:200',
        ]);

        $post = new Post;

        $post->content = $request->input('content');
        $post->title = $request->input('title');
        $post->user_id = Auth::user()->id;

        $post->save();

        return view('home')->with([
            'posts' => Post::all()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post, $id)
    {


        // $request->validate([
        //     'title' => 'required|max:10',
        //     'content' => 'required|max:200',
        // ]);

        // $post = Post::findOrFail($id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post, $id)
    {
        $post = Post::findOrfail($id);
        $post->delete();

        return redirect()->back()
            ->with('success', "Post supprimé avec succès");
    }
}
