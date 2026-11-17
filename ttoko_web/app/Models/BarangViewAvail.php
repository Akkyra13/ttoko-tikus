<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangViewAvail extends Model
{
    protected $table = 'barang_v_avail';
    protected $primaryKey = 'ID_Item';
    public $timestamps = false;
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
        $query = "SELECT * FROM barang_v where Stok = 'Stok Tersedia'";
        $result = $this->db->query($query);
        return $result->fetchAll();
    }
}
