@extends('layouts.master')
@section('title', 'Change Password')
@section('content')

    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-md-6">
                <h1 class="h3">Change Password</h1>
            </div>
        </div>
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h2 class="h5 mb-0">Change Password</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('users.change_pass.save', $user->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                <strong>Error!</strong> {{ $error }}
                            </div>
                        @endforeach
                        <div class="form-group mb-3">
                            <label for="old_password">Old Password</label>
                            <input type="password" class="form-control" id="old_password" name="old_password" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">New Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password_confirmation">Confirm New Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
