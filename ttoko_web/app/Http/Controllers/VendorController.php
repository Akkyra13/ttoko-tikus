<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Vendor;

class VendorController extends Controller
{
    private function validated(Request $req): array
    {
        return $req->validate([
            'nama'        => 'required|max:100',
            'badan_hukum' => 'required|in:' . implode(',', array_keys(Vendor::BADAN_HUKUM)),
            'status'      => 'required|in:' . implode(',', array_keys(Vendor::AKTIF)),
        ]);
    }

    public function index(Request $req)
    {
        $model = new Vendor;
        $page = $req->query('filter', null);
        if (empty($page)) {
            $data = $model->getVendors();
        } else {
            $data = $model->getVendorsAct();
        }
        return view('tables.vendor.index', compact('data'));
    }

    public function create()
    {
        $badan = Vendor::BADAN_HUKUM;
        $status = Vendor::AKTIF;
        return view('tables.vendor.create', compact(['badan', 'status']));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        (new Vendor)->addVendor($data);

        return redirect()->route('vendor.index')
            ->with('success', 'Vendor Added');
    }

    public function show(string $id)
    {
    }

    public function edit(string $id)
    {
        $data = (new Vendor)->getWhere((int) $id);
        if ($data === null) {
            abort(404);
        }
        $badan = Vendor::BADAN_HUKUM;
        $status = Vendor::AKTIF;
        return view('tables.vendor.edit', compact(['data', 'badan', 'status']));
    }

    public function update(Request $request, string $id)
    {
        $data = $this->validated($request);
        (new Vendor)->updateVendor($data, (int) $id);

        return redirect()->route('vendor.index')
            ->with('success', 'Vendor Updated');
    }

    public function destroy(string $id)
    {
        try {
            (new Vendor)->deleteVendor((int) $id);
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->route('vendor.index')
                    ->withErrors(['vendor' => 'Vendor masih dipakai di pengadaan. Ubah status ke Non-Aktif saja.']);
            }
            throw $e;
        }

        return redirect()->route('vendor.index')
            ->with('success', 'Vendor Removed');
    }
}
