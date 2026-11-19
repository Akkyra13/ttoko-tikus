<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Satuan;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $req)
    {
        $model = new Satuan;
        $page = $req->query('filter', null);
        if (empty($page)) {
            $data = $model->getUnits();
        } elseif ($page === 'aktif') {
            $data = $model->getUnitsAct();
        } else {
            $data = $model->getUnitsNAct();
        }
        return view('tables.satuan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = (new Satuan)->getUnits();
        $status = Satuan::AKTIF;
        return view('tables.satuan.create', compact(['data', 'status']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validated($request);
        $result = (new Satuan)->addUnit($data);

        return redirect()->route('satuan.index')
            ->with('success', 'Item Added');
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
        $data = (new Satuan)->getWhere($id);
        $status = Satuan::AKTIF;
        return view('tables.satuan.edit', compact(['data', 'status']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $this->validated($request);
        (new Satuan)->updateUnit($data, (int) $id);

        return redirect()->route('satuan.index')
            ->with('success', 'Item Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = (new Satuan)->deleteUnit($id);
        return redirect()->route('satuan.index')
            ->with('success', 'Item Removed');
    }

    private function validated(Request $req): array
    {
        $output = $req->validate([
            'satuan'   => 'required|max:45',
            'aktif'  => 'in:' . implode(',', array_keys(Satuan::AKTIF)),
        ]);
        return $output;
    }
}
