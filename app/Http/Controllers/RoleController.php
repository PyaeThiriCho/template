<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('backend.role.list', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('backend.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|unique:roles,name',
            'permissions' => 'required|array',
        ]);

        $role = new Role();
        $role->name = $request->name; 
        $role->guard_name = 'web'; 
        $role->save();

        //Convert permission IDs to names
        $permissions = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();

        // Attach permissions by name
        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')->with('success', 'Role created successfully');       
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('backend.role.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => ['required', Rule::unique('roles')->ignore($role->id)],
            'permissions' => 'required|array',
        ]);

        $role->name = $request->name; 
        $role->guard_name = 'web'; 
        $role->save();

        // Convert permission IDs to names
        $permissions = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();

        // Sync permissions
        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')->with('success', 'Role created successfully');       
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index');   
    }
}
