<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class User
{
    private $db;

    // start database connection
    public function __construct()
    {
    }

    // public function validated(Request $req): array
    //get all users data
    public function getUsers(): array
    {
        $result = DB::select("SELECT * FROM user_v");
        return $result;
    }

    public function getUsersCashier(): array
    {
        $result = DB::select("SELECT * FROM user_v where Role = 'Kasir'");
        return $result;
    }

    public function getUsersInventory(): array
    {
        $result = DB::select("SELECT * FROM user_v where Role = 'Inventaris'");
        return $result;
    }

    public function getUsersManager(): array
    {
        $result = DB::select("SELECT * FROM user_v where Role = 'Manajer'");
        return $result;
    }

    public function getUsersOwner(): array
    {
        $result = DB::select("SELECT * FROM user_v where Role = 'Owner'");
        return $result;
    }

    public function getWhere(int $id): ?object
    {
        $result = DB::selectOne(
            "select *, r.idrole as role_id from user_v v
            join user r on v.ID_User = r.iduser
            where ID_User = :id",
            ['id' => $id]
        );
        return $result;
    }

    public function getWhereUsername(string $id): ?object
    {
        $result = DB::selectOne(
            "select *, r.idrole as role_id from user_v v
            join user r on v.ID_User = r.iduser
            where r.username = :id",
            ['id' => $id]
        );
        return $result;
    }

    public function updateUser(array $d, int $id)
    {
        $query =
            "update user
            set username = :name, idrole = :role";
        $param = [
                'name' => $d['username'],
                'role' => $d['role'],
                'id' => $id,
            ];

        if (!empty($d['newpassword'])) {
            $query .= ", password_hash = :hash";
            $param['hash'] = hash('sha256', $d['newpassword']);
        }

            $query .= " where iduser = :id";

        return DB::update($query, $param);
    }

    public function addUser(array $d)
    {
        $result = DB::insert(
            "insert into user (username, password_hash, idrole) values
            (:username, :password, :idrole)",
            [
                'username' => $d['username'],
                'password' => hash('sha256', $d['password']),
                'idrole' => $d['role'],
            ]
        );
    }

    public function deleteUser(string $id)
    {
        DB::delete(
            "delete from user where iduser = :id",
            [
                'id' => (int) $id,
            ]
        );
    }


    public function checkPassword(int $id, string $string): bool
    {
        $pass = DB::selectOne(
        "select password_hash from user where iduser = :id",
            [
                'id' => $id,
            ]
        );

        if ($pass === null) {
            return false;
        }

        return hash_equals($pass->password_hash, hash('sha256', $string));
    }

    public function checkPasswordUsername(string $id, string $string): bool
    {
        $pass = DB::selectOne(
        "select password_hash from user where username = :id",
            [
                'id' => $id
            ]
        );

        if ($pass === null) {
            return false;
        }

        return hash_equals($pass->password_hash, hash('sha256', $string));
    }
}
