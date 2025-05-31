@extends('layouts.app')

@section('content')
    <h1>Create Page</h1>
    <form action="{{ route('pages.store') }}" method="POST">
        @csrf
        <div>
            <label for="title">Title:</label>
            <input type="text" name="title" value="{{ old('title') }}" required>
        </div>
        <div>
            <label for="slug">Slug:</label>
            <input type="text" name="slug" value="{{ old('slug') }}" required>
        </div>
        <div>
            <label for="content">Content:</label>
            <textarea name="content" rows="5">{{ old('content') }}</textarea>
        </div>
        <button type="submit">Create Page</button>
    </form>
@endsection