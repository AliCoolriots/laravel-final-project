@extends('layouts.app')

    @section('content')
    <div class="container mt-5">
        <h1>Request Details</h1>

        <div class="card">
            <div class="card-body">
                {{-- <h5 class="card-title">System Name: {{ $request->system_name }}</h5>
                <p class="card-text">Owner: {{ $request->owner_name }}</p>
                <p class="card-text">Description: {{ $request->description }}</p> --}}
                <h5 class="card-title">System Name: system 1</h5>
                <p class="card-text">Owner: ali </p>
                <p class="card-text">Type: new </p>
                <p class="card-text">Description: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem corrupti accusantium consequatur illum, inventore fugiat quae soluta, ducimus repellat deleniti voluptatum doloribus assumenda sapiente? Laborum labore libero tempore nisi dolor.</p>
                <a href={{"create-project"}} class="btn btn-primary btn-sm">Create project</a>
                {{-- {{"manager/create-project".$request}} --}}
            </div>
        </div>
    </div>
    @endsection