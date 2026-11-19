<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Satuan
{

    public const AKTIF = [
          1 => 'Aktif',
          0 => 'Non-Aktif',
    ];

    public function __construct()
    {
    }

    //get all users data
    public function getUnits(): array
    {
        $result = DB::select(
            "SELECT * FROM satuan_v"
        );
        return $result;
    }

    public function getUnitsAct(): array
    {
        $result = DB::select(
            "SELECT * FROM satuan_v_act"
        );
        return $result;
    }

    public function getUnitsNAct(): array
    {
        $result = DB::select(
            "SELECT * FROM satuan_v_nact"
        );
        return $result;
    }

    public function getWhere(int $d): ?object
    {
        $result = DB::selectOne(
            "select *, r.status as statuss from satuan_v v
            join satuan r on v.ID_Satuan = r.idsatuan
            where ID_Satuan = :id",
            ['id' => $d]
        );
        return $result;
    }

    public function updateUnit(array $d, int $id) //ga perlu output
    {
        $result = DB::update(
            "UPDATE satuan SET nama_satuan = :nama, status = :aktif
            WHERE idsatuan = :idsatuan",
            [
            'idsatuan' => $id,
            'nama' => $d['satuan'],
            'aktif' => $d['aktif']
            ]
        );
    }

    public function addUnit(array $d) //ga perlu output
    {
        $result = DB::insert(
            "insert into satuan( nama_satuan, status)
            values(:nama, 0)",
            ['nama' => $d['satuan']]
        );
    }

    public function deleteUnit(int $id) //ga perlu output juga
    {
        $result = DB::delete(
            "delete from satuan where idsatuan = :id",
            ['id' => $id]
        );
    }
}
