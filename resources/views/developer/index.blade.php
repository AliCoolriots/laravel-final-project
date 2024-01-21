
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center ">
            <h2 class="mb-4 text-primary ">Projects for {{ $developer->name }}</h2>
            <a href="developer/profile" class="mb-4 btn btn-outline-primary">View Profile</a>
        </div>

        <ul class="nav nav-tabs mb-4" id="projectTabs">
            <li class="nav-item">
                <a class="nav-link active" id="active-tab" data-bs-toggle="tab" href="#activeProjects">Active Projects</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="completed-tab" data-bs-toggle="tab" href="#completedProjects">Completed Projects</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="activeProjects">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @forelse ($developerProjects as $project)
                        @if ($project->status == 'completed')
                            @continue
                        @endif

                        @include('developer/project-card') 
                        
                    @empty
                        <div class="col">
                            <div class="alert alert-info" role="alert">
                                No projects assigned.
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="tab-pane fade" id="completedProjects">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @forelse ($developerProjects as $project)
                        @if ($project->status != 'completed')
                            @continue
                        @endif

                        @include('developer/project-card')      

                    @empty
                        <div class="col">
                            <div class="alert alert-info" role="alert">
                                No projects assigned.
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
