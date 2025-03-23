@extends('layouts.master')
@section('title', 'Give Permission')
@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Give Permissions to Role: <span class="badge bg-primary">{{ $role->name }}</span></h2>
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h3 class="h5 mb-0">Role Permissions</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-sm">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Permission</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="role-permissions">
                                    @foreach ($role->permissions as $permission)
                                        <tr data-id="{{ $permission->id }}">
                                            <td><span class="badge bg-success">{{ $permission->display_name }}</span></td>
                                            <td>
                                                <form method="POST" action="{{ route('roles.remove_permission', $role->id) }}" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="permission_id" value="{{ $permission->id }}">
                                                    <button type="submit" class="btn btn-danger btn-sm btn-remove-permission">Remove</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h3 class="h5 mb-0">Available Permissions</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-sm">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Permission</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="available-permissions">
                                    @foreach ($permissions as $permission)
                                        @if (!$role->permissions->contains($permission))
                                            <tr data-id="{{ $permission->id }}">
                                                <td><span class="badge bg-secondary">{{ $permission->display_name }}</span></td>
                                                <td>
                                                    <form method="POST" action="{{ route('roles.add_permission', $role->id) }}" class="d-inline">
                                                        @csrf
                                                        <input type="hidden" name="permission_id" value="{{ $permission->id }}">
                                                        <button type="submit" class="btn btn-success btn-sm btn-add-permission">Add</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle remove permission button click
            document.querySelectorAll('.btn-remove-permission').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const form = this.closest('form');
                    const row = this.closest('tr');
                    const permissionId = row.getAttribute('data-id');
                    
                    // Send AJAX request to remove permission from role
                    fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ permission_id: permissionId })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Move the row to available permissions table
                            document.getElementById('available-permissions').appendChild(row);
                            row.querySelector('.btn-remove-permission').classList.replace('btn-danger', 'btn-success');
                            row.querySelector('.btn-remove-permission').classList.replace('btn-remove-permission', 'btn-add-permission');
                            row.querySelector('.btn-add-permission').textContent = 'Add';
                        }
                    })
                    .catch(() => {
                        // Revert changes if the request fails
                        document.getElementById('role-permissions').appendChild(row);
                        row.querySelector('.btn-add-permission').classList.replace('btn-success', 'btn-danger');
                        row.querySelector('.btn-add-permission').classList.replace('btn-add-permission', 'btn-remove-permission');
                        row.querySelector('.btn-remove-permission').textContent = 'Remove';
                    });
                });
            });

            // Handle add permission button click
            document.querySelectorAll('.btn-add-permission').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const form = this.closest('form');
                    const row = this.closest('tr');
                    const permissionId = row.getAttribute('data-id');
                    
                    // Send AJAX request to add permission to role
                    fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ permission_id: permissionId })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Move the row to role permissions table
                            document.getElementById('role-permissions').appendChild(row);
                            row.querySelector('.btn-add-permission').classList.replace('btn-success', 'btn-danger');
                            row.querySelector('.btn-add-permission').classList.replace('btn-add-permission', 'btn-remove-permission');
                            row.querySelector('.btn-remove-permission').textContent = 'Remove';
                        }
                    })
                    .catch(() => {
                        // Revert changes if the request fails
                        document.getElementById('available-permissions').appendChild(row);
                        row.querySelector('.btn-remove-permission').classList.replace('btn-danger', 'btn-success');
                        row.querySelector('.btn-remove-permission').classList.replace('btn-remove-permission', 'btn-add-permission');
                        row.querySelector('.btn-add-permission').textContent = 'Add';
                    });
                });
            });
        });
    </script>
@endsection
