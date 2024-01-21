
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4 text-primary">Request Details</h1>

        <div class="card bg-white shadow ">
            <div class="card-body">
                <h5 class="card-title">System Name: {{ $request->system_name }}</h5>
                <p class="card-text">Owner: {{ $request->owner->name }}</p>
                <p class="card-text">Type: {{ $request->type }}</p>
                <p class="card-text">Description: {{ $request->description }}</p>
                <a href={{"/manager/create-project/$request->id"}} class="btn btn-primary btn-sm">Create Project</a>
            </div>
        </div>
    </div>
@endsection

