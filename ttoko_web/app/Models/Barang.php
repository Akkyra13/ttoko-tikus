<?php

namespace App\Models;


class Barang
{
    public const JENIS = [
          'O' => 'Office',
          'P' => 'Travel',
          'G' => 'Gaming',
          'E' => 'Ergonomic',
    ];

    public const STOK = [
          1 => 'Stok Tersedia',
          0 => 'Stok Habis',
    ];
    private $db;

    // start database connection
    public function __construct()
    {
        $this->db = Database::dbConnect();
    }

    //get all users data
    public function getItems(): array
    {
        $query = "SELECT * FROM barang_v";
        $result = $this->db->query($query);
        return $result->fetchAll();
    }

    public function getItemsAvail(): array
    {
        $query = "SELECT * FROM barang_v_avail";
        $result = $this->db->query($query);
        return $result->fetchAll();
    }

    public function getWhere(int $d): array
    {
        $query = "SELECT * FROM barang_v where ID_Item = :id";
        $run = $this->db->prepare($query);
        $run->execute(['id' => $d]);
        return $run->fetch();
    }
}
