<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Margin
{
    public const AKTIF = [
        1 => 'Aktif',
        0 => 'Non-Aktif',
    ];

    public function getMargins(): array
    {
        return DB::select("select * from margin_v");
    }

    public function getMarginsAct(): array
    {
        return DB::select("select * from margin_v_act");
    }

    public function getWhere(int $id): ?object
    {
        return DB::selectOne(
            "select v.*, r.persen, r.status as status_id, r.iduser
            from margin_v v
            join margin_penjualan r on v.ID_Margin = r.idmargin_penjualan
            where v.ID_Margin = :id",
            ['id' => $id]
        );
    }

    public function addMargin(array $d): int
    {
        return DB::transaction(function () use ($d) {
            DB::insert(
                "insert into margin_penjualan (persen, status, iduser)
                values (:persen, 0, :iduser)",
                [
                    'persen' => $d['persen'] / 100,
                    'iduser' => $d['iduser'],
                ]
            );
            $id = (int) DB::getPdo()->lastInsertId();

            if ((int) $d['status'] === 1) {
                $this->aktifkan($id);
            }
            return $id;
        });
    }

    public function updateMargin(array $d, int $id): void
    {
        DB::transaction(function () use ($d, $id) {

            $current = DB::selectOne('select status from margin_penjualan where idmargin_penjualan = :id for update',
                ['id' => $id]
            );

            if ($current === null || ((int) $current->status === 1 and (int) $d['status'] === 0)) {
                return false;
            }

            DB::update(
                "update margin_penjualan
                set persen = :persen, status = if(:status = 1, status, 0)
                where idmargin_penjualan = :id",
                [
                    'persen' => $d['persen'] / 100,
                    'status' => $d['status'],
                    'id'     => $id,
                ]
            );

            if ((int) $d['status'] === 1) {
                $this->aktifkan($id);
            }
            return true;
        });
    }

    public function aktifkan(int $id): void
    {
        DB::statement("call aktifkanMargin(:id)", ['id' => $id]);
    }

    public function deleteMargin(int $id): bool
    {
        $query = DB::delete(
            "delete from margin_penjualan where idmargin_penjualan = :id and status = 0",
            ['id' => $id]
        );

        if (!$query === 0) {
            return true;
        }

        return false;

    }
}
