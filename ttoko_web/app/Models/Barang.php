<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Barang
{
    public const JENIS = [
          'O' => 'Office',
          'P' => 'Travel',
          'G' => 'Gaming',
          'E' => 'Ergonomic',
    ];

    public const STOK = [
          1 => 'Stok Tersedia',
          0 => 'Stok Habis',
    ];

    public function __construct()
    {
    }

    //get all users data
    public function getItems(): array
    {
        $result = DB::select(
            "SELECT * FROM barang_v"
        );
        return $result;
    }

    public function getItemsAvail(): array
    {
        $result = DB::select(
            "SELECT * FROM barang_v_avail"
        );
        return $result;
    }

    public function getWhere(int $d): ?object
    {
        $result = DB::selectOne(
            "SELECT v.*, r.harga as harga_int FROM barang_v v
            join barang r on v.idbarang = r.idbarang
            WHERE v.idbarang = :id",
            ['id' => $d]
        );
        return $result;
    }

    public function updateItem(array $d, int $id) //ga perlu output
    {
        $result = DB::insert(
            "UPDATE barang SET jenis = :jenis, nama = :nama, idsatuan = :idsatuan, harga = :harga
            WHERE idbarang = :idbarang",
            [
            'idbarang' => $id,
            'jenis' => $d['jenis'],
            'nama' => $d['nama'],
            'idsatuan' => $d['satuan'],
            'harga' => $d['harga']
            ]
        );
    }

    public function addItem(array $d) //ga perlu output
    {
        $result = DB::insert(
            "insert into barang(jenis, nama, idsatuan, harga)
            values(:jenis, :nama, :idsatuan, :harga)",
            [
                'jenis' => $d['jenis'],
                'nama' => $d['nama'],
                'idsatuan' => $d['satuan'],
                'harga' => $d['harga']
            ]
        );
    }

    public function deleteItem(int $id) //ga perlu output juga
    {
        $result = DB::delete(
            "delete from barang where idbarang = :id",
            ['id' => $id]
        );
    }
}
