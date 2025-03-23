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
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Edit Profile</a>
            <a href="{{ route('users.change_pass', $user->id) }}" class="btn btn-primary">Change Password</a>
        </div>
    </div>
</div>
@endsection