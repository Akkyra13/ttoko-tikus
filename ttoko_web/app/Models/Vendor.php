<?php

namespace App\Models;

class Vendor
{
    private $db;

    // start database connection
    public function __construct()
    {
        $this->db = Database::dbConnect();
    }

    //get all users data
    public function getVendors(): array
    {
        $query = "SELECT * FROM vendor_v";
        $result = $this->db->query($query);
        return $result->fetchAll();
    }
}
