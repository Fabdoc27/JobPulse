@extends('layout.frontend_layout')

@section('page-title')
    <title>Job Pulse | Blogs</title>
@endsection

@section('page-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 p-3">
                <div class="w-75 ratio ratio-16x9 mb-4 mx-auto">
                    <img class="rounded img-fluid" src="{{ asset('blogs/' . $blog->img_url) }}" alt="Blog Image">
                </div>
                <h3 class="mb-3">Title : {{ $blog->title }}</h3>
                <p class="fs-15 fw-medium">Tags :
                    @foreach ($blog->tags as $tags)
                        <span class="badge bg-primary fs-6">{{ ucwords($tags) }}</span>
                    @endforeach
                </p>
                <p class="fs-15 fw-medium">
                    Posted : {{ $blog->created_at->diffForHumans() }}
                </p>
                <p class="fs-16">{!! nl2br(e($blog->description)) !!}</p>
            </div>
        </div>
    </div>
@endsection
