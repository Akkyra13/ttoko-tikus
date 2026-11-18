<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class User
{
    private $db;

    // start database connection
    public function __construct()
    {
        $this->db = Database::dbConnect();
    }

    //get all users data
    public function getUsers(): array
    {
        $result = DB::select("SELECT * FROM user_v");
        return $result;
    }

    public function getUsersCashier(): array
    {
        $result = DB::select("SELECT * FROM user_v where Role = 'kasir'");
        return $result;
    }

    public function getUsersInventory(): array
    {
        $result = DB::select("SELECT * FROM user_v where Role = 'inventaris'");
        return $result;
    }

    public function getUsersManager(): array
    {
        $result = DB::select("SELECT * FROM user_v where Role = 'manajer'");
        return $result;
    }
}
