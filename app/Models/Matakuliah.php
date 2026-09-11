<?php
namespace App\Models;

use App\Core\Model;

class Matakuliah extends Model
{
    public function getAll(): array
    {
        $query = "SELECT mk.*, p.nama AS prodi_nama 
                  FROM matakuliah mk 
                  JOIN prodi p ON mk.prodi_id = p.id 
                  ORDER BY mk.id";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll();
    }
}