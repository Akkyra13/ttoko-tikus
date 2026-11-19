<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Satuan;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $req)
    {
        $model = new Barang;
        $page = $req->query('filter', null);
        if (empty($page)) {
            $data = $model->getItems();
        } else {
            $data = $model->getItemsAvail();
        }
        return view('tables.barang.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenis = Barang::JENIS;
        $stok = Barang::STOK;
        $satuan = (new Satuan)->getUnits();
        return view('tables.barang.create', compact(['jenis', 'stok', 'satuan']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validated($request);
        $result = (new Barang)->addItem($data);

        return redirect()->route('barang.index')
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
        $data = (new Barang)->getWhere($id);
        $jenis = Barang::JENIS;
        $stok = Barang::STOK;
        $satuan = (new Satuan)->getUnits();
        return view('tables.barang.edit', compact(['data', 'jenis', 'stok', 'satuan']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $this->validated($request);
        (new Barang)->updateItem($data, (int) $id);

        return redirect()->route('barang.index')
            ->with('success', 'Item Updated');
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

    private function validated(Request $req): array
    {
        $output = $req->validate([
            'nama'   => 'required|max:45',
            'jenis'  => 'required|in:' . implode(',', array_keys(Barang::JENIS)),
            'satuan' => 'required|in:1,2,3,4,5',
            'stok'   => 'in:0,1',
            'harga'  => 'required|integer|min:0'
        ]);
        return $output;
    }
}
