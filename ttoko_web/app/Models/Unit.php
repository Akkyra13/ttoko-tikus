<?php

namespace App\Models;

class Unit
{
    private $db;

    // start database connection
    public function __construct()
    {
        $this->db = Database::dbConnect();
    }

    //get all users data
    public function getUnits(): array
    {
        $query = "SELECT * FROM satuan_v";
        $result = $this->db->query($query);
        return $result->fetchAll();
    }
}
