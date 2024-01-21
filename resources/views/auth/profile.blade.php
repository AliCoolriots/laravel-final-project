@extends('layouts.app')

@section('content')
    <div class="container mb-3">
        <h1 class="mb-4 text-primary">{{$role}} Profile</h1>

        <div class="card shadow bg-white">
            <div class="card-body">
                <h2 class="card-title">{{ $user->name }}</h2>

                <table class="table table-bordered mt-4">
                    <tbody>
                        <tr>
                            <th scope="row" class="text-muted">Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-muted">Role</th>
                            <td>{{$role}}</td>
                        </tr>
                    </tbody>
                </table>

                <div class="mt-4 d-flex gap-2">
                    <a href={{"/".strtolower($role)}} class="btn btn-outline-primary">Back to Dashboard</a>
                </div>
            </div>
        </div>
    </div>
@endsection
