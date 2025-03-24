@extends('layouts.master')
@section('title', 'Profile')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1>{{ $user->name }}</h1>
            </div>
            <div class="card-body">
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Registered on:</strong> {{ $user->created_at->format('d M Y') }}</p>
                <p><strong>Roles:</strong>
                    @if ($user->getRoleNames()->isEmpty())
                        <span class="badge bg-secondary">No Role</span>
                    @else
                        @foreach ($user->getRoleNames() as $roleName)
                            @if ($roleName == 'Admin')
                                <span class="badge bg-danger">{{ $roleName }}</span>
                            @elseif ($roleName == 'Super Admin')
                                <span class="badge bg-dark">{{ $roleName }}</span>
                            @else
                                <span class="badge bg-primary">{{ $roleName }}</span>
                            @endif
                        @endforeach
                    @endif
                </p>
                @php
                    $superAdmin = \Spatie\Permission\Models\Role::where('name', 'Super Admin')->first();
                    $admin = \Spatie\Permission\Models\Role::where('name', 'Admin')->first();
                @endphp

                <p><strong>Permissions:</strong>
                    @if ($userPermissions->isEmpty())
                        <span class="badge bg-secondary">No Permission</span>
                    @else
                        @foreach ($userPermissions as $permission)
                            <span class="badge {{ $permission['color'] }}">{{ $permission['display_name'] }}</span>
                        @endforeach
                    @endif
                </p>




                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Edit Profile</a>
                <a href="{{ route('users.change_pass', $user->id) }}" class="btn btn-primary">Change Password</a>
            </div>
        </div>
    </div>
@endsection
