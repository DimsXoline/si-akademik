<?php
namespace App\Models;

use App\Core\Model;

class Prodi extends Model
{
    public function getAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM prodi ORDER BY id");
        return $stmt->fetchAll();
    }
}