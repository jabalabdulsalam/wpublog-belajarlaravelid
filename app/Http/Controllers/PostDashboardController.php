<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PostDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->where('author_id', Auth::user()->id);

        if (request('keyword')) {
            $posts->where('title', 'like', '%' . request('keyword') . '%');
        }

        return view('dashboard.index', [
            'posts' => $posts->paginate(7)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Validator::make(
            $request->all(),
            [
                'title' => 'required|min:4|max:255|unique:posts',
                'category_id' => 'required',
                'body' => 'required|min:50',
            ],
            [
                'required' => 'Field :attribute harus diisi.',
                'title.unique' => ':attribute sudah ada, silahkan gunakan :attribute lain.',
                'title.min' => ':attribute minimal 4 karakter.',
                'title.max' => ':attribute maksimal 255 karakter.',
                'category_id.required' => 'Field :attribute harus dipilih.',
                'body.required' => 'Field :attribute harus diisi.',
                'body.min' => 'Tulisan minimal harus :min karakter atau lebih.',
            ],
            [
                'title' => 'Judul',
                'category_id' => 'Kategori',
                'body' => 'Post',
            ]
        )->validate();

        Post::create([
            'title' => $request->title,
            'author_id' => Auth::user()->id,
            'category_id' => $request->category_id,
            'slug' => Str::slug($request->title),
            'body' => $request->body,
        ]);

        return redirect('/dashboard')->with('success', 'New post has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('dashboard.show', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('dashboard.edit', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // Validation
        $request->validate([
            'title' => 'required|min:4|max:255|unique:posts,title,' . $post->id,
            'category_id' => 'required',
            'body' => 'required',
        ]);

        // Update Post
        $post->update([
            'title' => $request->title,
            'author_id' => Auth::user()->id,
            'category_id' => $request->category_id,
            'slug' => Str::slug($request->title),
            'body' => $request->body,
        ]);

        // Redirect
        return redirect('/dashboard')->with('success', 'Your Post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('/dashboard')->with('success', 'Your Post has been deleted!');
    }
}
