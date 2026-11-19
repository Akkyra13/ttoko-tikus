<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Vendor
{
    public const BADAN_HUKUM = [
        'P' => 'PT',
        'C' => 'CV',
    ];

    public const AKTIF = [
        1 => 'Aktif',
        0 => 'Non-Aktif',
    ];

    public function getVendors(): array
    {
        return DB::select("select * from vendor_v");
    }

    public function getVendorsAct(): array
    {
        return DB::select("select * from vendor_v_act");
    }

    public function getWhere(int $id): ?object
    {
        return DB::selectOne(
            "select v.*, r.nama_vendor, r.badan_hukum, r.status as status_id
            from vendor_v v
            join vendor r on v.ID_Vendor = r.idvendor
            where v.ID_Vendor = :id",
            ['id' => $id]
        );
    }

    public function addVendor(array $d): bool
    {
        return DB::insert(
            "insert into vendor (nama_vendor, badan_hukum, status)
            values (:nama, :badan, :status)",
            [
                'nama'   => $d['nama'],
                'badan'  => $d['badan_hukum'],
                'status' => $d['status'],
            ]
        );
    }

    public function updateVendor(array $d, int $id): int
    {
        return DB::update(
            "update vendor
            set nama_vendor = :nama, badan_hukum = :badan, status = :status
            where idvendor = :id",
            [
                'nama'   => $d['nama'],
                'badan'  => $d['badan_hukum'],
                'status' => $d['status'],
                'id'     => $id,
            ]
        );
    }

    public function deleteVendor(int $id): int
    {
        return DB::delete(
            "delete from vendor where idvendor = :id",
            ['id' => $id]
        );
    }
}
