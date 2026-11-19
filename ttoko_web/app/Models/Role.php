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
}
