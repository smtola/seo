@extends('layouts.app')

@section('content')
    <h1>Edit Post</h1>
    <form action="{{ route('posts.update', $post->slug) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="title">Title:</label>
            <input type="text" name="title" value="{{ old('title', $post->title) }}" required>
        </div>
        <div>
            <label for="slug">Slug:</label>
            <input type="text" name="slug" value="{{ old('slug', $post->slug) }}" required>
        </div>
        <div>
            <label for="content">Content:</label>
            <textarea name="content" rows="5">{{ old('content', $post->content) }}</textarea>
        </div>
        <button type="submit">Update Post</button>
    </form>
@endsection