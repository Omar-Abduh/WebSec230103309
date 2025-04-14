@extends('layouts.master')
@section('title', 'Register')
@section('content')
    <div class="d-flex justify-content-center mt-5">
        <div class="card col-sm-6 mt-5 shadow-lg">
            <div class="card-body">
                <h1 class="mb-4 text-center" style="font-size: 60px;">Register</h1>
                <div class="form-group">
                    <form action="{{ route('do_register') }}" method="post">
                        {{ csrf_field() }}
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                <strong>Error!</strong> {{ $error }}
                            </div>
                        @endforeach
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" placeholder="Enter your name" name="name"
                                required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" placeholder="Enter your email" name="email"
                                required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" class="form-control" placeholder="Enter your password" name="password"
                                required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password_confirmation" class="form-label">Password Confirmation:</label>
                            <input type="password" class="form-control" placeholder="Confirm your password"
                                name="password_confirmation" required>
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary w-100">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
