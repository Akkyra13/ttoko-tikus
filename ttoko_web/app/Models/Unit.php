<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;

class Unit
{
    private $db;

    // start database connection
    public function __construct()
    {
    }

    //get all users data
    public function getUnits(): array
    {
        $result = DB::select(
            "select * from satuan_v"
        );
        return $result;
    }

}
