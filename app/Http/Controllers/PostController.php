<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $posts = [];
        // $posts = Post::orderBy('id', 'desc')->get();
        // $posts = DB::select('select * from posts order By id desc');

        // ORM
        // $posts = Post::all();
        // $posts = Post::orderBy('id', 'desc')->get();
        // $posts = Post::where('user_id', 1)->get(); // where('user_id', '=', 1)
        // $posts = Post::orderBy('id', 'desc')->Paginate(5);
        // $posts = Post::userid()->visitor()->Paginate(5);

        // dd($request->has('trashed'));
        if ($request->has('trashed')) {
            $posts = Post::onlyTrashed()->Paginate(10);
        } else {
            // $posts = Post::Paginate(10);
            $posts = Post::orderBy('id', 'desc')->Paginate(10);
        }


        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $title = $request->post_title;
        // $detail = $request->post_detail;
        // DB::insert('insert into posts (post_title,post_detail) values (?,?)', [$title, $detail]);

        // ORM
        $post = new Post();
        $post->post_title = $request->post_title;
        $post->post_detail = $request->post_detail;
        $post->save();

        // return view('posts.index');
        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $posts = Post::find($id);
        return view('posts.show', compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $posts = DB::select('select * from posts where id = ?', [$id]);

        // ORM
        $posts = Post::where('id', $id)->first();
        return view('posts.edit', compact('posts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $title = $request->post_title;
        // $detail = $request->post_detail;
        // DB::update('update posts set post_title = ?, post_detail = ? where id = ?', [$title, $detail, $id]);

        // ORM
        $post = Post::findOrFail($id);
        $post->post_title = $request->post_title;
        $post->post_detail = $request->post_detail;
        $post->save();

        return redirect('/posts');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $post = DB::delete('delete from posts where id = ?', [$id]);

        // ORM
        // $post = Post::find($id)->delete();
        Post::where('id', $id)->delete();
        return redirect('/posts');
    }

    public function trashed()
    {
        $posts = Post::onlyTrashed()->lastest()->get();
        return redirect('/posts');
    }

    public function restore($id)
    {
        Post::where('id', $id)->restore();
        return redirect('/posts');
    }

    public function restoreAll()
    {
        Post::onlyTrashed()->restore();
        return redirect('/posts');
    }

}
