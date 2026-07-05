<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use App\Http\Requests\Access\StoreAccessRequest;
use App\Http\Requests\Access\UpdateAccessRequest;

// use App\Http\Requests\Access\UpdateAccessRequest;

class RoleController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:manage roles'),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Role::orderBy('name')->get();
        return view('pages.role.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAccessRequest $request)
    {
        Role::create([
            'name' => $request->validated('nama'),
            'guard_name' => 'web',
        ]); 
        return redirect()->back()->with('success', 'Role berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $permissions = Permission::orderBy('name')->get();
        return view('pages.role.show', compact('role', 'permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAccessRequest $request, Role $role)
    {
        $role->update([
            'name' => $request->validated('nama'),
        ]);

        return redirect()->back()->with('success', 'Role berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->back()->with('success', 'Role berhasil dihapus.');
    }
}
