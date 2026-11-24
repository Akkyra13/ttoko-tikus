<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Penerimaan
{
    private $db;

    // start database connection
    public function __construct()
    {
    }

    // public function validated(Request $req): array
    //get all users data
    public function getPenerimaan(): array
    {
        $result = DB::select("SELECT * FROM penerimaan_v");
        return $result;
    }

    public function addPenerimaan(int $iduser, int $idpengadaan)
    {
        DB::insert(
            "insert into penerimaan (idpengadaan, iduser) values (:pengadaan, :user)",
            ['user' => $iduser, 'pengadaan' => $idpengadaan]
        );
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
