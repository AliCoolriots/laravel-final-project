@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="mb-4 text-primary ">Project Progress</h1>
            <a href={{"/manager/projects/$project->id"}} class="btn btn-outline-primary mb-4">Back to The Project</a>
        </div>

        <div class="card shadow ">
            <div class="card-header">
                <h2 class="card-title">{{ $project->system_name }}</h2>
            </div>
            <div class="card-body bg-white">
                <ul class="list-group list-group-flush">
                    @forelse ($progress as $Aprogress)
                        <li class="list-group-item bg-white">
                            <div class="mb-2">
                                <strong class="text-primary">Date:</strong> {{ $Aprogress->date }}
                            </div>
                            <div class="mb-2">
                                <strong class="text-primary">Description:</strong> {{ $Aprogress->description }}
                            </div>
                            <div>
                                <strong class="text-primary">Added by:</strong> {{ $Aprogress->developer->name }}
                            </div>
                        </li>
                    @empty
                        <li class="list-group-item">No progress available.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection
