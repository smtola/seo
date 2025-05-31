@extends('layouts.app')

@section('content')
    <h1>Edit Product</h1>
    <form action="{{ route('products.update', $product->slug) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" required>
        </div>
        <div>
            <label for="slug">Slug:</label>
            <input type="text" name="slug" value="{{ old('slug', $product->slug) }}" required>
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea name="description">{{ old('description', $product->description) }}</textarea>
        </div>
        <div>
            <label for="price">Price:</label>
            <input type="number" name="price" value="{{ old('price', $product->price) }}" step="0.01" required>
        </div>
        <button type="submit">Update Product</button>
    </form>
@endsection