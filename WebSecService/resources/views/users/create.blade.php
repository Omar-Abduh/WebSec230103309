@extends('layouts.master')
@section('title', 'Create User')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#clean_role").click(function() {
                $('#roles').val([]);
            });
        });
    </script>
    <div class="d-flex justify-content-center">
        <div class="row m-4 col-sm-8">
            <form action="{{ route('users.store') }}" method="post">
                {{ csrf_field() }}
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">
                        <strong>Error!</strong> {{ $error }}
                    </div>
                @endforeach
                <div class="row mb-2">
                    <div class="col-12">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" placeholder="Name" name="name" required>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-12">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" placeholder="Email" name="email" required>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-12">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                    </div>
                </div>
                @can('admin_users')
                    <div class="col-12 mb-2">
                        <label for="role" class="form-label">Role:</label> (<a href='#' id='clean_role'>reset</a>)
                        <select class="form-select" id='role' name="role">
                            <option value="" selected disabled>Select Role</option>
                            @foreach ($roles as $role)
                                <option value='{{ $role->name }}'>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endcan

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
