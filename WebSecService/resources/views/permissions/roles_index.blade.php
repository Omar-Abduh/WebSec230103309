@extends('layouts.master')
@section('title', 'Permissions')
@section('content')
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-md-6">
                <h1 class="h3">Roles</h1>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('roles.create') }}" class="btn btn-success">Add Role</a>
            </div>
        </div>
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h2 class="h5 mb-0">Roles List</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Roles</th>
                                <th scope="col"># Permissions</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Updated At</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td scope="col">{{ $role->id }}</td>
                                    <td scope="col">{{ $role->name }}</td>
                                    <td scope="col">
                                        <a href="{{ route('permissions.index') }}">{{ $role->permissions->count() }}</a>
                                    </td>
                                    <td scope="col">{{ $role->created_at->format('d M Y') }}</td>
                                    <td scope="col">{{ $role->updated_at->format('d M Y') }}</td>
                                    <td scope="col" class="gap-2">
                                        <a href="" class="btn btn-info btn-sm">Assign Permissions</a>
                                        <a href="{{ route('roles.edit', $role->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <a href="{{ route('roles.delete', $role->id) }}" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
