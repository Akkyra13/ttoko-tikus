<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetilPenerimaan;

class DetilPengadaanController extends Controller
{
    private function validated(Request $req, bool $baru): array
    {
        $rules = [
            'jumlah'       => 'required|integer|min:1',
            'harga_satuan' => 'required|integer|min:1',
        ];
        if ($baru) {
            $rules['idbarang'] = 'required|integer|exists:barang,idbarang';
        }
        return $req->validate($rules);
    }

    private function result(string $pengadaan, ?string $err, string $ok)
    {
        $pesan = [
            'bukan_draf' => 'Pengadaan sudah dikirim atau dibatalkan, barang tidak bisa diubah.',
            'duplikat'   => 'Barang sudah ada di pengadaan ini. Ubah jumlahnya saja.',
        ];
        if ($err !== null) {
            return redirect()->route('pengadaan.show', $pengadaan)
                ->withErrors(['item' => $pesan[$err]])->withInput();
        }
        return redirect()->route('pengadaan.show', $pengadaan)->with('success', $ok);
    }

    public function store(Request $request, string $pengadaan)
    {
        $data = $this->validated($request, true);
        $err = (new DetilPengadaan)->addItem((int) $pengadaan, $data);
        return $this->result($pengadaan, $err, 'Barang ditambahkan');
    }

    public function update(Request $request, string $pengadaan, string $item)
    {
        $data = $this->validated($request, false);
        $err = (new DetilPengadaan)->updateItem((int) $pengadaan, (int) $item, $data);
        return $this->result($pengadaan, $err, 'Barang diperbarui');
    }

    public function destroy(string $pengadaan, string $item)
    {
        $err = (new DetilPengadaan)->removeItem((int) $pengadaan, (int) $item);
        return $this->result($pengadaan, $err, 'Barang dihapus');
    }
}
