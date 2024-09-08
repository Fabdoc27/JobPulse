@extends('layout.master')

@section('title')
    <title>Job Pulse | Blogs</title>
@endsection

@section('sidebar')
    @include('components.leftSidebar')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 card mb-3 shadow p-3">
            <div class="w-50  ratio ratio-16x9 mb-4 mx-auto">
                <img class="rounded img-fluid" src="{{ asset('blogs/' . $blog->img_url) }}" alt="Blog Image">
            </div>
            <h3 class="mb-3">Title : {{ $blog->title }}</h3>
            <p class="fs-15">Tags :
                @foreach ($blog->tags as $tags)
                    <span class="badge bg-primary fs-6">{{ ucwords($tags) }}</span>
                @endforeach
            </p>
            <h3 class="mt-2">Description</h3>
            <p class="fs-15">{!! nl2br(e($blog->description)) !!}</p>
        </div>
    </div>
@endsection
