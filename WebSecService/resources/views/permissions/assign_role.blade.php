@extends('layouts.master')
@section('title', 'Assign Role to Permission')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h2 class="h5 mb-0">Assign Role to Permission</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('permissions.store_role_assignment', $permissions->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="role" class="form-label">Select Role</label>
                                <select name="role_id" id="role" class="form-control">
                                    <option value="">No Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            @if ($selectedRoles->contains($role->id)) selected @endif>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Assign Role</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
