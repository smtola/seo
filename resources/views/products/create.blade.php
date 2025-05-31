@extends('layouts.app')

@section('content')
    <h1>Create Product</h1>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
        </div>
        <div>
            <label for="slug">Slug:</label>
            <input type="text" name="slug" value="{{ old('slug') }}" required>
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea name="description">{{ old('description') }}</textarea>
        </div>
        <div>
            <label for="price">Price:</label>
            <input type="number" name="price" value="{{ old('price', 0) }}" step="0.01" required>
        </div>
        <button type="submit">Create Product</button>
    </form>
@endsection