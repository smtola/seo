<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::orderBy('created_at', 'desc')->get();
        SEOTools::setTitle('Pages');
        SEOTools::setDescription('Browse our site pages.');
        return view('pages.index', compact('pages'));
    }

    public function show($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        SEOTools::setTitle($page->title);
        SEOTools::setDescription(\Illuminate\Support\Str::limit($page->content, 160));
        SEOTools::opengraph()->setUrl(route('pages.show', $page->slug));
        SEOTools::setCanonical(route('pages.show', $page->slug));
        return view('pages.show', compact('page'));
    }

    public function create()
    {
        return view('pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug',
            'content' => 'required|string',
        ]);
        $page = Page::create($request->only('title', 'slug', 'content'));
        return redirect()->route('pages.show', $page->slug)->with('success', 'Page created successfully.');
    }

    public function edit($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        return view('pages.edit', compact('page'));
    }

    public function update(Request $request, $slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug,' . $page->id,
            'content' => 'required|string',
        ]);
        $page->update($request->only('title', 'slug', 'content'));
        return redirect()->route('pages.show', $page->slug)->with('success', 'Page updated successfully.');
    }

    public function destroy($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        $page->delete();
        return redirect()->route('pages.index')->with('success', 'Page deleted successfully.');
    }
}