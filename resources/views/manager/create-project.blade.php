@extends('layouts.app')

    @section('content')
    <div class="container mt-5">
        <h1>Create Project</h1>

        <form action='store-project' method="POST">
            @csrf

            <div class="mb-3">
                <label for="owner" class="form-label">System Name</label>
                <input type="text" class="form-control" id="system_name" name="system_name" required>
            </div>

            <div class="mb-3">
                <label for="owner" class="form-label">System Owner</label>
                <input type="text" class="form-control" id="bu_name" name="bu_name" required>
            </div>

            <div class="mb-3">
                <label for="system_pic" class="form-label">System Pic</label>
                <input type="text" class="form-control" id="system_pic" name="system_pic" required>
            </div>

            <div class="mb-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>

            <div class="mb-3">
                <label for="duration" class="form-label">Duration (in days)</label>
                <input type="number" class="form-control" id="duration" name="duration" required>
            </div>

            <div class="mb-3">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" class="form-control" id="end_date" name="end_date" required>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="ahead_of_schedule">Ahead of Schedule</option>
                    <option value="on_schedule">On Schedule</option>
                    <option value="delayed">Delayed</option>
                    <option value="completed">Completed</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="developers" class="form-label">Learder Developer</label>
                <select class="form-select" id="leader_developer_id" name="leader_developer_id" required>
                    @foreach($developers as $developer)
                        <option value="{{ $developer->id }}">{{ $developer->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Assign Developers</label>
                @foreach($developers as $developer)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="developers[]" value="{{ $developer->id }}" id="developer{{ $developer->id }}">
                        <label class="form-check-label" for="developer{{ $developer->id }}">
                            {{ $developer->name }}
                        </label>
                    </div>
                @endforeach
            </div>

            <div class="mb-3">
                <label for="development_methodology" class="form-label">Development Methodology</label>
                <input type="text" class="form-control" id="development_methodology" name="development_methodology" required>
            </div>

            <div class="mb-3">
                <label for="system_platform" class="form-label">System Platform</label>
                <input type="text" class="form-control" id="system_platform" name="system_platform" required>
            </div>

            <div class="mb-3">
                <label for="deployment_type" class="form-label">Deployment Type</label>
                <input type="text" class="form-control" id="deployment_type" name="deployment_type" required>
            </div>

            <button type="submit" class="btn btn-primary">Create Project</button>
        </form>
    </div>
    @endsection