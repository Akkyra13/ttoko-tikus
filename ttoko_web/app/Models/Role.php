<?php

namespace App\Models;

class Role
{
    private $db;

    // start database connection
    public function __construct()
    {
        $this->db = Database::dbConnect();
    }

    //get all users data
    public function getRoles(): array
    {
        $query = "SELECT * FROM role_v";
        $result = $this->db->query($query);
        return $result->fetchAll();
    }
}
