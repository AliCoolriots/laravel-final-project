@extends('layouts.app')

@section('content')
    <div class="container w-50 ">
        <div class="card shadow bg-white ">
            <div class="card-header  text-primary">
                <h5 class="mb-0">Enhance Request</h5>
            </div>
            <div class="card-body">
                <form action="/owner/store-enhance-request/{{ $id }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="systemName" class="form-label">System Name</label>
                        <input type="text" class="form-control" name="system_name" value="{{ $system->system_name }}" placeholder="Enter System Name">
                    </div>
                    <div class="mb-3">
                        <label for="systemDescription" class="form-label">System Description</label>
                        <textarea class="form-control" name="system_description" placeholder="Enter System Description" maxlength="255" required rows="5"></textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Create Request</button>
                </form>
            </div>
        </div>
    </div>
@endsection
