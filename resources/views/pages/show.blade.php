@extends('layouts.app')

@section('content')
    <h1>{{ $page->title }}</h1>
    <div>
        {!! nl2br(e($page->content)) !!}
    </div>
@endsection