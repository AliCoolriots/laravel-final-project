@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <h1 class="display-4 mb-4 text-primary ">Welcome to Your Project Management System</h1>
        <p class="lead">Effortlessly manage and track your projects with our user-friendly platform.</p>

        <div class="row mt-5">
            <div class="col-lg-4 mb-4">
                <div class="card h-100 shadow bg-white ">
                    <div class="card-body">
                        <h5 class="card-title">Project Owners</h5>
                        <p class="card-text">Initiate, manage, and monitor your systems with ease.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-4">
                <div class="card h-100 shadow bg-white ">
                    <div class="card-body">
                        <h5 class="card-title">Developers</h5>
                        <p class="card-text">Contribute to projects, update progress, and collaborate with your team.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-4">
                <div class="card h-100 shadow bg-white ">
                    <div class="card-body">
                        <h5 class="card-title">Managers</h5>
                        <p class="card-text">Oversee projects, review progress, and facilitate effective communication.</p>
                    </div>
                </div>
            </div>
        </div>

        <p class="mt-5">
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Get Started</a>
        </p>
    </div>
@endsection
