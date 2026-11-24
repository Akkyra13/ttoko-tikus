<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Pengadaan
{
    private $db;

    // start database connection
    public function __construct()
    {
    }

    // public function validated(Request $req): array
    //get all users data
    public function getPengadaan(): array
    {
        $result = DB::select("SELECT * FROM pengadaan_v");
        return $result;
    }

    public function getPengadaanProc(): array
    {
        $result = DB::select("SELECT * FROM pengadaan_v_proses ");
        return $result;
    }

    public function addPengadaan(int $iduser, int $idvendor): int
    {
        DB::insert(
            "insert into pengadaan (user_iduser, vendor_idvendor) values (:user, :vendor)",
            ['user' => $iduser, 'vendor' => $idvendor]
        );
        return (int) DB::getPdo()->lastInsertId();
    }

    public function getDetail(int $id): ?object
    {
        return DB::selectOne(
            "select v.*, p.status as status_kode,
                exists(select 1 from penerimaan t where t.idpengadaan = p.idpengadaan) as ada_penerimaan
            from pengadaan_v v
            join pengadaan p on p.idpengadaan = v.ID_Pengadaan
            where v.ID_Pengadaan = :id",
            ['id' => $id]
        );
    }

    public function order(int $id): bool
    {
        return DB::update(
            "update pengadaan set status = 'P'
            where idpengadaan = :id and status = 'O'
            and exists (select 1 from detil_pengadaan d where d.idpengadaan = :id2)",
            ['id' => $id, 'id2' => $id]
        ) === 1;
    }

    public function cancel(int $id): bool
    {
        return DB::update(
            "update pengadaan set status = 'B'
            where idpengadaan = :id
            and (status = 'O'
                or (status = 'P' and not exists (select 1 from penerimaan t where t.idpengadaan = :id2)))",
            ['id' => $id, 'id2' => $id]
        ) === 1;
    }
}
