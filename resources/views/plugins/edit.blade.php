@extends('layout.master')

@section('title')
    <title>Job Pulse | Plugins</title>
@endsection

@section('sidebar')
    @include('components.leftSidebar')
@endsection

@section('content')
    <form action="{{ route('plugin.update', $plugin) }}" method="POST">
        <div class="col-md-6">
            @csrf
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" name="name" value="{{ old('name', $plugin->name) }}">
                @error('name')
                    <p class="text-danger text-center mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">
                    Features (press Enter to add a line break )
                </label>
                <textarea type="text" class="form-control" rows="10" name="features">{{ old('features', $plugin->features) }}</textarea>
                @error('features')
                    <p class="text-danger text-center mt-2">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
