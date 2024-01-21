
        <div class="col mb-4">
            <div class="card h-100 shadow">
                <div class="card-body bg-white">
                    <h5 class="card-title"><strong>{{ $project->system_name }}</strong></h5>
                    <ul class="list-group list-group-flush">
                    </ul>
                        <li class="list-group-item">
                            <strong>Status:</strong> {{ $project->status }}
                        </li>
                        <li class="list-group-item">
                            <strong>Start Date:</strong> {{ $project->start_date }}
                        </li>
                        <li class="list-group-item">
                            <strong>Duration:</strong> {{ $project->duration }} days
                        </li>
                        <li class="list-group-item">
                            <strong>End Date:</strong> {{ $project->end_date }}
                        </li>
                        <li class="list-group-item">
                            <strong>Leader:</strong> {{ $project->leaderdeveloper->name }}
                        </li>
                    </ul>
                </div>
                <div class="card-footer">
                    <a href={{"/developer/projects/$project->id"}} class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>
