<?php

namespace App\Models;

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
        $query = "SELECT * FROM user_v";
        $result = $this->db->query($query);
        return $result->fetchAll();
    }

    public function getUsersCashier(): array
    {
        $query = "SELECT * FROM user_v where Role = 'kasir'";
        $result = $this->db->query($query);
        return $result->fetchAll();
    }

    public function getUsersInventory(): array
    {
        $query = "SELECT * FROM user_v where Role = 'inventaris'";
        $result = $this->db->query($query);
        return $result->fetchAll();
    }

    public function getUsersManager(): array
    {
        $query = "SELECT * FROM user_v where Role = 'manajer'";
        $result = $this->db->query($query);
        return $result->fetchAll();
    }
}
