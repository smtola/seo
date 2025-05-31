@extends('layouts.app')

@section('content')
    <h1>Post Catalog</h1>
    <a href="{{ route('posts.create') }}" class="btn btn-primary">Create Product</a>
    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif
    <ul>
        @forelse($posts as $post)
            <li>
                <a href="{{ route('posts.show', $post->slug) }}">{{ $post->name }}</a>
                - ${{ number_format($post->price, 2) }}
                <a href="{{ route('posts.edit', $post->slug) }}">Edit</a>
                <form action="{{ route('posts.destroy', $post->slug) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Delete this post?')">Delete</button>
                </form>
            </li>
        @empty
            <li>No posts available.</li>
        @endforelse
    </ul>
@endsection