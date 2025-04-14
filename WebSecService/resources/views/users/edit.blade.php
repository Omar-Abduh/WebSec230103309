@extends('layouts.master')
@section('title', 'Edit Profile')
@section('content')

    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-md-6">
                <h1 class="h3">Edit Profile</h1>
            </div>
        </div>
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h2 class="h5 mb-0">Edit Profile Details</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                <strong>Error!</strong> {{ $error }}
                            </div>
                        @endforeach
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ old('name', $user->name) }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                                value="{{ old('email', $user->email) }}" required>
                        </div>
                        @can('assign_role_user')
                            <div class="col-12 mb-2">
                                <label for="roles" class="form-label">Roles:</label> (<a href='#'
                                    id='clean_roles'>reset</a>)
                                <select multiple class="form-select select2" id='roles' name="roles[]">
                                    @if ($roles->isEmpty())
                                        <option disabled>No Roles</option>
                                    @else
                                        @foreach ($roles as $role)
                                            <option value='{{ $role->name }}'
                                                {{ $user->roles->pluck('name')->contains($role->name) ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-12 mb-2">
                                <label for="permissions" class="form-label">Direct Permissions:</label> (<a href='#'
                                    id='clean_permissions'>reset</a>)
                                <select multiple class="form-select select2" id='permissions' name="permissions[]">
                                    @if ($permissions->isEmpty())
                                        <option disabled>No Permissions</option>
                                    @else
                                        @foreach ($permissions as $permission)
                                            <option value='{{ $permission->name }}'
                                                {{ $user->getDirectPermissions()->pluck('name')->contains($permission->name) ? 'selected' : '' }}>
                                                {{ $permission->display_name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <input type="hidden" name="roles[]" value="" />
                            <input type="hidden" name="permissions[]" value="" />
                        @endcan
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        /* Custom styling for highlighting selected roles */
        .form-select option:checked {
            background-color: #17a2b8 !important;
            color: white !important;
            font-weight: bold;
        }
    </style>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Initialize select2 for roles and permissions
            $('.select2').select2({
                placeholder: "Select roles",
                allowClear: true
            });

            // Reset roles
            $('#clean_roles').click(function(e) {
                e.preventDefault();
                $('#roles').val(null).trigger('change');
            });

            // Reset permissions
            $('#clean_permissions').click(function(e) {
                e.preventDefault();
                $('#permissions').val(null).trigger('change');
            });
        });
    </script>
@endpush
