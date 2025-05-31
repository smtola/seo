@extends('layouts.app')

@section('content')
    <h1>Edit Page</h1>
    <form action="{{ route('pages.update', $page->slug) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="title">Title:</label>
            <input type="text" name="title" value="{{ old('title', $page->title) }}" required>
        </div>
        <div>
            <label for="slug">Slug:</label>
            <input type="text" name="slug" value="{{ old('slug', $page->slug) }}" required>
        </div>
        <div>
            <label for="content">Content:</label>
            <textarea name="content" rows="5">{{ old('content', $page->content) }}</textarea>
        </div>
        <button type="submit">Update Page</button>
    </form>
@endsection