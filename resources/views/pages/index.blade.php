@extends('layouts.app')

@section('content')
    <h1>Pages Catalog</h1>
    <a href="{{ route('pages.create') }}" class="btn btn-primary">Create Product</a>
    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif
    <ul>
        @forelse($pages as $page)
            <li>
                <a href="{{ route('pages.show', $page->slug) }}">{{ $page->name }}</a>
                - ${{ number_format($page->price, 2) }}
                <a href="{{ route('pages.edit', $page->slug) }}">Edit</a>
                <form action="{{ route('pages.destroy', $page->slug) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Delete this pages?')">Delete</button>
                </form>
            </li>
        @empty
            <li>No pages available.</li>
        @endforelse
    </ul>
@endsection