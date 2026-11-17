<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table = 'vendor';
    protected $primaryKey = 'idvendor';
    protected $timestamp = false;
    protected $fillable = [
        'nama_vendor', 'badan_hukum'
    ];
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

    public function getVendorsActive(): array
    {
        $query = "SELECT * FROM vendor_v WHERE Status = 'Aktif'";
        $result = $this->db->query($query);
        return $result->fetchAll();
    }
}
