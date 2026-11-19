<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Role
{
    private $db;

    // start database connection
    public function __construct()
    {
    }

    //get all users data
    public function getRoles(): array
    {
        $result = DB::select(
            "select * from role_v"
        );
        return $result;
    }

    public function addRole(array $d)
    {
        DB::insert(
            "insert into role (nama_role) values
            (:name)",
            [
                'name' => $d['name']
            ]
        );
    }

    public function getWhere(int $id): ?object
    {
        $result = DB::selectOne(
            "select * from role_v
            where ID_Role = :id",
            [
                'id' => $id
            ]
        );
        return $result;
    }

    public function updateRole(array $d, int $id)
    {
        DB::update(
            "update role set nama_role = :name
            where idrole = :id",
            [
                'name' => $d['name'],
                'id' => $id,
            ]
        );
    }

    public function deleteRole(int $id)
    {
        DB::delete(
            "delete from role where idrole = :id",
            [
                'id' => $id
            ]
        );
    }
}
