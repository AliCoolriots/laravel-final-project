@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mb-4 text-center">
            <h1>Welcome, {{ $manager->name }}</h1>
        </div>
        <div class="d-flex align-items-center gap-3 justify-content-end mb-4">
            <a href="manager/projects" class="btn btn-outline-primary">View Projects</a>
            <a href="manager/profile" class="btn btn-outline-primary">View Profile</a>
        </div>

        <div class="card bg-white shadow">
            <div class="card-header  text-primary">
                <h2>Requests</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>Owner Name</th>
                            <th>System Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($requests as $request)
                            <tr>
                                <td>{{ $request->owner->name }}</td>
                                <td>{{ $request->system_name }}</td>
                                <td>
                                    <a href={{"/manager/view-request/$request->id"}} class="btn btn-primary btn-sm">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No requests available.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
