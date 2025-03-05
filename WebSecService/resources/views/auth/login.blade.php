@extends('layouts.master')
@section('title', 'Login')
@section('content')
    <div class="d-flex justify-content-center mt-5">
        <div class="card col-sm-6 mt-5 shadow-lg" style="padding: 20px;">
            <div class="card-body">
                <h1 class="mb-4 text-center" style="font-size: 60px;">Login</h1>
                <div class="form-group">
                    <form action="{{ route('do_login') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">
                                    <strong>Error!</strong> {{ $error }}
                                </div>
                            @endforeach
                        </div>
                        <div class="form-group mb-2">
                            <label for="model" class="form-label">Email:</label>
                            <input type="email" class="form-control" placeholder="email" name="email" required style="margin-bottom: 10px;">
                        </div>
                        <div class="form-group mb-2">
                            <label for="model" class="form-label">Password:</label>
                            <input type="password" class="form-control" placeholder="password" name="password" required style="margin-bottom: 10px;">
                        </div>
                        <div class="form-group p-2 mb-2 text-center" style="display: flex; justify-content: space-between; align-items: center;">
                            <button type="submit" class="btn btn-primary">Login</button>
                            <a href="{{ route('register') }}" class="btn btn-link">Don't have an account?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
