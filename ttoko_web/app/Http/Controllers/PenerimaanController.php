<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penerimaan;
use App\Models\Pengadaan;
use App\Models\Vendor;
use App\Models\DetilPenerimaan;

class PenerimaanController extends Controller
{
    private function validated(Request $req): array
    {
        $aktif = array_column((new Vendor)->getVendorsAct(), 'ID_Vendor');
        return $req->validate([
            'vendor' => 'required|integer|in:' . implode(',', $aktif),
        ], [
            'vendor.in' => 'Pilih vendor yang masih aktif.',
        ]);
    }

    public function index(Request $req)
    {
        $model = new Penerimaan;
        $page = $req->query('filter', null);
        if (empty($page)) {
            $data = $model->getPenerimaan();
        } else {
            $data = $model->getPengadaanProc();
        }
        return view('tables.penerimaan.index', compact('data'));
    }

    public function create()
    {
        $data = (new Pengadaan)->getPengadaan();
        return view('tables.penerimaan.create', compact('data'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $id = (new Pengadaan)->addPengadaan((int) session('iduser'), (int) $data['vendor']);

        return redirect()->route('pengadaan.show', $id)
            ->with('success', 'Pengadaan dibuat. Tambahkan barang lalu kirim pesanan.');
    }

    public function show(string $id)
    {
        $model = new Pengadaan;
        $data = $model->getDetail((int) $id);
        if ($data === null) {
            abort(404);
        }
        $draf = $data->status_kode === 'O';
        $bisaBatal = $draf || ($data->status_kode === 'P' && ! $data->ada_penerimaan);
        $detil = new DetilPengadaan;
        $items = $detil->getItems((int) $id);
        $barang = $data->status_kode === 'O' ? $detil->getBarangOptions((int) $id) : [];
        return view('tables.pengadaan.show', compact(['data', 'items', 'barang', 'draf', 'bisaBatal']));
    }

    public function kirim(string $id)
    {
        if (! (new Pengadaan)->order((int) $id)) {
            return redirect()->route('pengadaan.show', $id)
                ->withErrors(['pengadaan' => 'Pengadaan hanya bisa dikirim saat masih Draf dan berisi minimal 1 barang.']);
        }
        return redirect()->route('pengadaan.show', $id)->with('success', 'Pengadaan dikirim');
    }

    public function destroy(string $id)
    {
        if (! (new Pengadaan)->cancel((int) $id)) {
            return back()
                ->withErrors(['pengadaan' => 'Pengadaan tidak bisa dibatalkan']);
        }
        return back()->with('success', 'Pengadaan ' . $id . ' dibatalkan');
    }
}
