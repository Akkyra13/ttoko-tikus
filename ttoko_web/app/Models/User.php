<?php

require_once("database.php");

class User
{
    private $db;

    // start database connection
    public function __construct()
    {
        $this->db = database::dbConnect();
    }

    //get all users data
    public function getUsers(): array
    {
        $query = "SELECT * FROM user_v";
        $result = $this->db->query($query);
        return $result->fetchAll();
    }
}
