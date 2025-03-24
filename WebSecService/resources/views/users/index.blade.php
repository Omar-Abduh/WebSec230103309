@extends('layouts.master')
@section('title', 'Users')
@section('content')
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-md-6">
                <h1 class="h3">Users</h1>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('users.create') }}" class="btn btn-success">Add User</a>
            </div>
        </div>
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h2 class="h5 mb-0">User List</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">
                                    <a href="{{ route('roles.index') }}">Roles</a>
                                </th>
                                <th scope="col"># Permissions</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Updated At</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td scope="col">
                                        <a href="{{ route('users.profile', $user->id) }}">{{ $user->id }}</a>
                                    </td>
                                    <td scope="col">{{ $user->name }}</td>
                                    <td scope="col">{{ $user->email }}</td>
                                    <td scope="col">
                                        @if ($user->getRoleNames()->isEmpty())
                                            <a href="">
                                                <span class="badge bg-secondary">No Role</span>
                                            </a>
                                        @else
                                            @foreach ($user->getRoleNames() as $roleName)
                                                @if ($roleName == 'Admin')
                                                    <span class="badge bg-danger">{{ $roleName }}</span>
                                                @elseif ($roleName == 'Super Admin')
                                                    <span class="badge bg-dark">{{ $roleName }}</span>
                                                    <!-- Change color for Super Admin -->
                                                @else
                                                    <span class="badge bg-primary">{{ $roleName }}</span>
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>

                                    {{-- <td scope="col">
                                        @if ($user->permissions->isEmpty())
                                            <span class="badge bg-secondary">No Permissions</span>
                                        @else
                                            <div class="d-flex flex-wrap">
                                                @foreach ($user->permissions as $index => $permission)
                                                    <div class="col-3 p-1"> <!-- Ensures 3 items per row -->
                                                        <span class="badge bg-info text-dark w-100 text-center small p-1">
                                                            {{ $permission->display_name }}
                                                        </span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </td>
                                     --}}
                                    <td scope="col">{{ count($user->getAllPermissions()) }}</td>
                                    <td scope="col">{{ $user->created_at->format('d M Y') }}</td>
                                    <td scope="col">{{ $user->updated_at->format('d M Y') }}</td>
                                    <td scope="col">
                                        <div class="d-flex flex-wrap gap-2">
                                            <a href="{{ route('users.edit', $user->id) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                            <a href="{{ route('users.change_pass', $user->id) }}"
                                                class="btn btn-warning btn-sm">Change Password</a>
                                        </div>
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
