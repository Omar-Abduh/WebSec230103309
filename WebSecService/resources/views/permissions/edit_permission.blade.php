@extends('layouts.master')
@section('title', 'Edit Permission')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Permission</div>

                    <div class="card-body">
                        <form action="{{ route('permissions.update', $permission->id) }}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group">
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger">
                                        <strong>Error!</strong> {{ $error }}
                                    </div>
                                @endforeach

                                <div class="mb-3">
                                    <label for="name" class="form-label">Permission Display Name:</label>
                                    <input type="text" class="form-control"
                                        placeholder="Permission Display Name ex. Add something " name="display_name"
                                        required value="{{ $permission->display_name }}">
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Permission Name:</label>
                                    <input type="text" class="form-control"
                                        placeholder="Permission Name ex. add_something" name="name" required
                                        value="{{ $permission->name }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
