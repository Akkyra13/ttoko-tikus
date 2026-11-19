<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private function validated(Request $req, bool $isCreate = false): array
    {
        // create form: password + password_confirmation
        if ($isCreate) {
            return $req->validate([
                'username' => 'required|max:45',
                'password' => 'required|min:8|confirmed',
                'role'     => 'required|exists:role,idrole',
            ]);
        }

        // edit form: optional newpassword + newpassword_confirmation
        // (current password is checked separately in update())
        return $req->validate([
            'username'    => 'required|max:45',
            'newpassword' => 'nullable|required_with:newpassword_confirmation|min:8|confirmed',
            'role'        => 'required|exists:role,idrole',
        ]);
    }

    public function index(Request $req)
    {
        $model = new User;
        $page = $req->query('filter', null);
        if (empty($page)) {
            $data = $model->getUsers();
        } elseif ($page === 'owner') {
            $data = $model->getUsersOwner();
        } elseif ($page === 'manajer') {
            $data = $model->getUsersManager();
        } elseif ($page === 'kasir') {
            $data = $model->getUsersCashier();
        } elseif ($page === 'inventaris') {
            $data = $model->getUsersInventory();
        }
        return view('tables.user.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = (new Role)->getRoles();
        return view('tables.user.create', compact(['roles']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validated($request, true);
        $result = (new User)->addUser($data);

        return redirect()->route('user.index')
            ->with('success', 'User Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = (new User)->getWhere($id);
        return view('tables.user.edit', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = (new User)->getWhere($id);
        $roles = (new Role)->getRoles();
        return view('tables.user.edit', compact(['data', 'roles']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
        'password' => ['required', function ($attr, $value, $fail) use ($id) {
            if (! (new User)->checkPassword((int) $id, $value)) {
                $fail('password incorrect');
            }
        }],
        ]);

        $data = $this->validated($request);
        (new User)->updateUser($data, (int) $id);

        return redirect()->route('user.index')
            ->with('success', 'User Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = (new Barang)->deleteItem($id);
        return redirect()->route('barang.index')
            ->with('success', 'Item Removed');
    }
}
