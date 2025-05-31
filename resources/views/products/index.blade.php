@extends('layouts.app')

@section('content')
    <h1>Product Catalog</h1>
    <a href="{{ route('products.create') }}" class="btn btn-primary">Create Product</a>
    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif
    <ul>
        @forelse($products as $product)
            <li>
                <a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                - ${{ number_format($product->price, 2) }}
                <a href="{{ route('products.edit', $product->slug) }}">Edit</a>
                <form action="{{ route('products.destroy', $product->slug) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Delete this product?')">Delete</button>
                </form>
            </li>
        @empty
            <li>No products available.</li>
        @endforelse
    </ul>
@endsection