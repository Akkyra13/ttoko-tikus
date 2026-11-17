<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Unit;
use App\Models\BarangViewAvail;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        $data = new Barang;
        $page = $req->query('filter', null);
        if (empty($page)) {
            $data = $data->getItems();
        } else {
            $data = $data->getItemsAvail();
        }
        return view('tables.barang.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tables.barang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        Barang::create($request->validated());
        return redirect()->route('barang.index')
            ->with('success', 'Barang ditambahkan');
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
        $satuan = (new Unit)->getUnits();
        return view('tables.barang.edit', compact(['data', 'jenis', 'stok', 'satuan']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data->update($request->validated());
        return redirect()->route('barang.index')
            ->with('success', 'Barang terupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $idt)
    {
        $data->delete();
        return redirect()->route('barang.index')
            ->with('success', 'Barang dihapus');
    }
}
