<?php

namespace App\Models;

class Margin
{
    private $db;

    // start database connection
    public function __construct()
    {
        $this->db = Database::dbConnect();
    }

    //get all users data
    public function getMargins(): array
    {
        $query = "SELECT * FROM margin_v";
        $result = $this->db->query($query);
        return $result->fetchAll();
    }
}
