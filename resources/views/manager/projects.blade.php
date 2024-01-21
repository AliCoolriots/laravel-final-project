@extends('layouts.app') 

@section('content')
    <div class="container vh-100 w-100">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-primary">View Projects</h1>
            <a href="/manager" class="btn btn-outline-primary">Back to Request</a>
        </div>


        <ul class="nav nav-tabs" id="myTabs">
            <li class="nav-item">
                <a class="nav-link active" id="active-tab" data-bs-toggle="tab" href="#activeProjects">Active</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="completed-tab" data-bs-toggle="tab" href="#completedProjects">Completed</a>
            </li>
        </ul>

        <div class="tab-content mt-3">
            <div class="tab-pane fade show active" id="activeProjects">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach($activeProjects as $project)
                        @include('manager.project-card', ['project' => $project])
                    @endforeach
                </div>
            </div>

            <div class="tab-pane fade" id="completedProjects">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach($completedProjects as $project)
                        @include('manager.project-card', ['project' => $project])
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            const myTabs = new bootstrap.Tab(document.getElementById('active-tab'));
            myTabs.show();
        });
    </script> --}}
@endsection
