@extends('layouts.app')

@section('content')
    <h1>{{ $product->name }}</h1>
    <p>{{ $product->description }}</p>
    <p><b>Price:</b> ${{ $product->price }}</p>
@endsection