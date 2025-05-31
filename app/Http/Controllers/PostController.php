<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        SEOTools::setTitle('Blog Posts');
        SEOTools::setDescription('Browse the latest blog posts.');
        return view('posts.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        SEOTools::setTitle($post->title);
        SEOTools::setDescription(\Illuminate\Support\Str::limit($post->content, 160));
        SEOTools::opengraph()->setUrl(route('posts.show', $post->slug));
        SEOTools::setCanonical(route('posts.show', $post->slug));
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts,slug',
            'content' => 'required|string',
        ]);
        $post = Post::create($request->only('title', 'slug', 'content'));
        return redirect()->route('posts.show', $post->slug)->with('success', 'Post created successfully.');
    }

    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts,slug,' . $post->id,
            'content' => 'required|string',
        ]);
        $post->update($request->only('title', 'slug', 'content'));
        return redirect()->route('posts.show', $post->slug)->with('success', 'Post updated successfully.');
    }

    public function destroy($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}