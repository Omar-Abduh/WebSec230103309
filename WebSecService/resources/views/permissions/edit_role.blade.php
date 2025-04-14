@extends('layouts.master')
@section('title', 'Edit Role')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Role</div>

                    <div class="card-body">
                        <form action="{{ route('roles.update', $role->id) }}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group">
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger">
                                        <strong>Error!</strong> {{ $error }}
                                    </div>
                                @endforeach

                                <div class="mb-3">
                                    <label for="name" class="form-label">Role Name:</label>
                                    <input type="text" class="form-control" placeholder="Role Name" name="name"
                                        required value="{{ $role->name }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
