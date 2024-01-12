@extends('layouts.app')

    @section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Welcome {{ $manager->name }}</h1>

        <a href="manager/projects" class="btn btn-secondary btn-sm mb-4 ml-atuo">View Projetcs</a>
    
        <div class="card">
            <div class="card-header">
                <h2>Requests</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Owner name</th>
                            <th>System name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Ali</td>
                            <td>System 1</td>
                            <td>
                                <a href="manager/view-request" class="btn btn-primary btn-sm">View</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection