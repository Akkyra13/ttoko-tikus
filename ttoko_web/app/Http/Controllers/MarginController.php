<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Margin;
use App\Models\User;

class MarginController extends Controller
{
    private function validated(Request $req, bool $isCreate = false): array
    {
        $rules = [
            'persen' => 'required|numeric|min:0|max:100',
            'status' => 'required|in:' . implode(',', array_keys(Margin::AKTIF)),
        ];
        if ($isCreate) {
            $rules['iduser'] = 'required|exists:user,iduser';
        }
        return $req->validate($rules);
    }

    public function index(Request $req)
    {
        $model = new Margin;
        $page = $req->query('filter', null);
        if (empty($page)) {
            $data = $model->getMargins();
        } else {
            $data = $model->getMarginsAct();
        }
        return view('tables.margin.index', compact('data'));
    }

    public function create()
    {
        $status = Margin::AKTIF;
        $users = (new User)->getUsers();
        return view('tables.margin.create', compact(['status', 'users']));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request, true);
        (new Margin)->addMargin($data);

        return redirect()->route('margin.index')
            ->with('success', 'Margin Added');
    }

    public function show(string $id)
    {
    }

    public function edit(string $id)
    {
        $data = (new Margin)->getWhere((int) $id);
        if ($data === null) {
            abort(404);
        }
        $status = Margin::AKTIF;
        return view('tables.margin.edit', compact(['data', 'status']));
    }

    public function update(Request $request, string $id)
    {
        $data = $this->validated($request);
        (new Margin)->updateMargin($data, (int) $id);

        return redirect()->route('margin.index')
            ->with('success', 'Margin Updated');
    }

    public function destroy(string $id)
    {
        try {
            (new Margin)->deleteMargin((int) $id);
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->route('margin.index')
                    ->withErrors(['margin' => 'Margin masih dipakai di penjualan, tidak bisa dihapus.']);
            }
            throw $e;
        }

        return redirect()->route('margin.index')
            ->with('success', 'Margin Removed');
    }
}
