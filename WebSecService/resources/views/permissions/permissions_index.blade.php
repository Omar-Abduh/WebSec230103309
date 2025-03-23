@extends('layouts.master')
@section('title', 'Permissions')
@section('content')
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-md-6">
                <h1 class="h3">Permissions</h1>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('permissions.create') }}" class="btn btn-success">Add Permission</a>
            </div>
        </div>
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h2 class="h5 mb-0">Permissions List</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Permissions</th>
                                <th scope="col">DB_Record</th>
                                <th scope="col">Role</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td scope="col">{{ $permission->id }}</td>
                                    <td scope="col">{{ $permission->display_name }}</td>
                                    <td scope="col">{{ $permission->name }}</td>
                                    <td scope="col">
                                        @php
                                            $assignedRole = $roles->filter(function ($role) use ($permission) {
                                                return $role->permissions->contains($permission);
                                            });
                                        @endphp
                                        @if ($assignedRole->isNotEmpty())
                                            @foreach ($assignedRole as $role)
                                                <span class="badge bg-primary">{{ $role->name }}</span>
                                            @endforeach
                                        @else
                                            <span class="badge bg-secondary">No Role</span>
                                        @endif

                                    </td>
                                    <td scope="col">{{ $permission->created_at->format('d M Y') }}</td>
                                    <td scope="col"
                                        class="d-flex align-items-center justify-content-center flex-wrap gap-2">
                                        <a href="" class="btn btn-info btn-sm">Assign To Role</a>
                                        <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="{{ route('permissions.delete', $permission->id) }}" class="btn btn-danger btn-sm">Delete</a>
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
