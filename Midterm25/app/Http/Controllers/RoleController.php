<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.role.index', compact('roles'));
    }
    
    // Create role
    public function create(){
        $roles = Role::all();
        return view('admin.role.create', compact('roles'));
    }

    // Store role
    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        Role::create(['name' => $request->name]);

        return redirect()->route('role.index')->with([
            'success' => 'Role created successfully.',
            'success_description' => 'The role has been added to the system.'
        ]);
    }

    // Edit role
    public function edit(Role $role){
        return view('admin.role.edit', compact('role'));
    }

    // Update role
    public function update(Request $request, Role $role){
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
        ]);

        $role->update(['name' => $request->name]);

        return redirect()->route('role.index')->with([
            'success' => 'Role updated successfully.',
            'success_description' => 'The role details have been updated.'
        ]);
    }

    // Delete role
    public function destroy(Role $role){
        $role->delete();
        return redirect()->route('role.index')->with([
            'success' => 'Role deleted successfully.',
            'success_description' => 'The role has been removed from the system.'
        ]);
    }
}
