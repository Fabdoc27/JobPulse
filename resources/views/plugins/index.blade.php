@extends('layout.master')

@section('title')
    <title>Job Pulse | Plugins</title>
@endsection

@section('sidebar')
    @include('components.leftSidebar')
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p class="text-center m-0">{{ session('success') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <p class="text-center m-0">{{ session('error') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (auth()->user()->role == 'owner')
        <div class="row">
            @foreach ($plugins as $plugin)
                <div class="col-md-4">
                    <div class="card shadow-lg p-3">
                        <h4 class="m-0">{{ $plugin->name }}</h4>
                        <p class="my-3">{!! nl2br(e($plugin->features)) !!}</p>
                        <div class="d-flex gap-2 align-items-center">
                            <div class="d-flex gap-2 align-items-center">
                                <a href="{{ route('plugin.edit', $plugin) }}" class="d-inline-block btn btn-primary">
                                    Edit
                                </a>
                                <a href="#" class="btn d-inline-block btn-danger delete-btn"
                                    data-plugin-id="{{ $plugin->id }}" data-bs-toggle="modal"
                                    data-bs-target="#confirmDeleteModal">
                                    Delete
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <a href="{{ route('plugin.create') }}" class="d-inline-block btn btn-primary">
            Create Plugin
        </a>
        @foreach ($plugins as $plugin)
            {{-- delete modal --}}
            <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this plugin?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <form id="deleteForm" action="{{ route('plugin.destroy', $plugin) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- delete modal --}}
        @endforeach
    @elseif(auth()->user()->role == 'company')
        <div class="row">
            @foreach ($plugins as $plugin)
                <div class="col-md-4">
                    <div class="card shadow-lg p-3">
                        <h4 class="m-0">{{ $plugin->name }}</h4>
                        <p class="my-3">{!! nl2br(e($plugin->features)) !!}</p>
                        <div class="d-flex gap-2 align-items-center">
                            <div class="d-flex gap-2 align-items-center">
                                <form action="{{ route('plugin.status', ['plugin' => $plugin]) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" name="plugin_id" value="{{ $plugin->id }}">
                                    @if ($companyData['activePlugins']->contains($plugin->id))
                                        <button type="submit" class="btn btn-danger">Deactivate</button>
                                    @else
                                        <button type="submit" class="btn btn-success">Activate</button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-btn').forEach(item => {
                item.addEventListener('click', event => {
                    const pluginId = item.getAttribute('data-plugin-id');
                    document.querySelector('#deleteForm').action =
                        '{{ route('plugin.destroy', '') }}' + '/' + pluginId;
                });
            });
        });
    </script>
@endsection
