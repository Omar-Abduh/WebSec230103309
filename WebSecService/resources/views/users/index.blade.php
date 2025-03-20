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
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Show Profile</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>{{ $user->updated_at }}</td>
                                    <td>
                                        <a href="{{ route('users.profile', $user->id) }}">Show {{ $user->name }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm" >Edit</a>
                                        <a href="{{ route('users.change_pass', $user->id) }}" class="btn btn-warning btn-sm" >Change Password</a>
                                        <a href="{{ route('users.destroy', $user->id) }}" class="btn btn-danger btn-sm" >Delete</a>
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