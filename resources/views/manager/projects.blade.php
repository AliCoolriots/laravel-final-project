<!-- index.blade.php -->

@extends('layouts.app') <!-- If you have a master layout, use it -->

@section('content')
    <div class="container mt-5">
        <h1>View Projects</h1>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($projects as $project)
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                        <h5 class="card-title">{{ $project->system_name }}</h5>
                            <p class="card-text">
                                Name: {{ $project->system_name }}<br>
                                Owner: {{ $project->bu_name }}<br>
                                Status: {{ $project->status }}<br>
                                Start Date: {{ $project->start_date }}<br>
                                End Date: {{ $project->end_date }}
                            </p> 
                            {{-- <a href="{{ route('viewProject', ['id' => $project->id]) }}" class="btn btn-primary">View Details</a> --}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
