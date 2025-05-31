@extends('layouts.app')

@section('content')
  <div class="container">
        <h1>Welcome to the Product Catalog</h1>
        <p>Explore our demo app with products, posts, and pages. Use the links below to browse:</p>
        <ul>
            <li><a href="{{ route('products.index') }}">View Products</a></li>
            <li><a href="{{ route('posts.index') }}">View Blog Posts</a></li>
            <li><a href="{{ route('pages.index') }}">View Pages</a></li>
        </ul>
        <hr>
        <p style="color:#888;">&copy; {{ date('Y') }} Product Catalog Demo</p>
    </div>
@endsection