<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class DetilPenerimaan
{
    public function getItems(int $id): array
    {
        return DB::select(
            "select d.iddetil_pengadaan, d.idbarang, b.nama as barang,
                d.harga_satuan, d.jumlah, d.sub_total,
                priceFormat(d.harga_satuan) as harga_format,
                priceFormat(d.sub_total) as subtotal_format
            from detil_pengadaan d
            join barang b on b.idbarang = d.idbarang
            where d.idpengadaan = :id
            order by d.iddetil_pengadaan",
            ['id' => $id]
        );
    }

    public function getBarangOptions(int $id): array
    {
        return DB::select(
            "select b.idbarang, b.nama, b.harga
            from barang b
            where b.idbarang not in (select idbarang from detil_pengadaan where idpengadaan = :id)
            order by b.nama",
            ['id' => $id]
        );
    }

    private function lockDraft(int $id): bool
    {
        $row = DB::selectOne(
            "select status from pengadaan where idpengadaan = :id for update",
            ['id' => $id]
        );
        return $row !== null && $row->status === 'O';
    }

    public function addItem(int $id, array $d): ?string
    {
        return DB::transaction(function () use ($id, $d) {
            if (! $this->lockDraft($id)) {
                return 'bukan_draf';
            }

            $ada = DB::selectOne(
                "select 1 as x from detil_pengadaan where idpengadaan = :id and idbarang = :barang",
                ['id' => $id, 'barang' => $d['idbarang']]
            );
            if ($ada !== null) {
                return 'duplikat';
            }

            DB::insert(
                "insert into detil_pengadaan (idpengadaan, idbarang, jumlah, harga_satuan)
                values (:id, :barang, :jumlah, :harga)",
                [
                    'id'     => $id,
                    'barang' => $d['idbarang'],
                    'jumlah' => $d['jumlah'],
                    'harga'  => $d['harga_satuan'],
                ]
            );
            return null;
        });
    }

    public function updateItem(int $id, int $item, array $d): ?string
    {
        return DB::transaction(function () use ($id, $item, $d) {
            if (! $this->lockDraft($id)) {
                return 'bukan_draf';
            }

            DB::update(
                "update detil_pengadaan
                set jumlah = :jumlah, harga_satuan = :harga
                where iddetil_pengadaan = :item and idpengadaan = :id",
                [
                    'jumlah' => $d['jumlah'],
                    'harga'  => $d['harga_satuan'],
                    'item'   => $item,
                    'id'     => $id,
                ]
            );
            return null;
        });
    }

    public function removeItem(int $id, int $item): ?string
    {
        return DB::transaction(function () use ($id, $item) {
            if (! $this->lockDraft($id)) {
                return 'bukan_draf';
            }

            DB::delete(
                "delete from detil_pengadaan where iddetil_pengadaan = :item and idpengadaan = :id",
                ['item' => $item, 'id' => $id]
            );
            return null;
        });
    }
}
