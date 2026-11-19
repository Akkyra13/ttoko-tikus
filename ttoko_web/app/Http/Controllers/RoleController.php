<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private function validated(Request $req): array
    {
        $output = $req->validate([
            'name'   => 'required|max:45',
        ]);
        return $output;
    }

    public function index(Request $req)
    {
        $data = (new Role)->getRoles();
        return view('tables.role.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = (new Role)->getRoles();
        return view('tables.role.create', compact(['roles']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validated($request);
        $result = (new Role)->addRole($data);

        return redirect()->route('role.index')
            ->with('success', 'Role Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = (new Role)->getWhere($id);
        return view('tables.role.edit', compact(['data']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $this->validated($request);
        (new Role)->updateRole($data, (int) $id);

        return redirect()->route('role.index')
            ->with('success', 'Role Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = (new Role)->deleteRole($id);
        return redirect()->route('role.index')
            ->with('success', 'Role Removed');
    }

}
