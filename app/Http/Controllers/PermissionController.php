<?php

namespace App\Http\Controllers;
// use App\Http\Controllers\Permission;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('backend.permission.list', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|unique:permissions,name'
        ]);

        $permission = new Permission();
        $permission->name = $request->name;
        $permission->guard_name = 'web'; 
        $permission->save();

        return redirect()->route('permissions.index')->with('success', 'Permission created successfully');       
        }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        return view('backend.permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
       $request->validate([
        'name' => 'required|min:3|unique:permissions,name,' . $permission->id
        ]);

        $permission->name = $request->name;
        $permission->guard_name = 'web'; 
        $permission->save();

        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {

        $permission->delete();
        return redirect()->route('permissions.index');   
    }
}
