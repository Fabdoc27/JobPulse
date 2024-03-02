@extends('layout.frontend_layout')

@section('page-title')
    <title>Job Pulse | Blogs</title>
@endsection

@section('page-content')
    @if ($blogs)
        <div class="container">
            <div class="row py-3">
                <div class="col-md-4 offset-md-8">
                    <form action="{{ route('blogs') }}" method="GET" class="mb-3">
                        <div class="input-group border border-dark-subtle border-1 rounded">
                            <input type="text" name="search" class="form-control" placeholder="Search by title or tags">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <h3 class="text-center">All Blogs</h3>
                @foreach ($blogs as $blog)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-lg">
                            <img src="{{ asset('blogs/' . $blog->img_url) }}" class="card-img-top" alt="Blog Image">
                            <div class="card-body">
                                <h4 class="card-title">{{ $blog->title }}</h4>
                                <p class="mt-1 mb-1 fw-semibold">
                                    Posted On : {{ $blog->created_at->format('d-m-y') }}
                                </p>
                                @foreach ($blog->tags as $tags)
                                    <span class="badge bg-primary fs-12 mb-2">{{ ucwords($tags) }}</span>
                                @endforeach
                                <p class="card-text">{{ Str::limit($blog->description, 150) }}</p>
                                <a href="{{ route('blogs.details', $blog) }}" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{-- Pagination --}}
                <div class="mt-3">
                    {{ $blogs->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    @endif
@endsection
