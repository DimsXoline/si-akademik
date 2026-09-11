<?php
namespace App\Repositories;

use PDO;
use App\Models\Mahasiswa;

class MahasiswaRepository extends BaseRepository
{
    public function getAll(): array
    {
        $stmt = $this->db->query("SELECT m.*, p.nama AS nama_prodi 
                                  FROM mahasiswa m
                                  JOIN prodi p ON m.prodi_id = p.id
                                  ORDER BY m.id ASC");
        return $stmt->fetchAll();
    }

    public function findById(int $id): ?Mahasiswa
    {
        $stmt = $this->db->prepare("SELECT * FROM mahasiswa WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch();
        return $data ? new Mahasiswa($data) : null;
    }

    public function save(Mahasiswa $mahasiswa): int
    {
        $data = $mahasiswa->toArray();
        unset($data['id']);

        $stmt = $this->db->prepare("INSERT INTO mahasiswa (nim, nama, email, prodi_id, angkatan, status)
                                    VALUES (:nim, :nama, :email, :prodi_id, :angkatan, :status)");
        $stmt->execute($data);
        return (int) $this->db->lastInsertId();
    }

    public function update(Mahasiswa $mahasiswa): void
    {
        $data = $mahasiswa->toArray();
        $id = $data['id'];
        unset($data['id']);

        $stmt = $this->db->prepare("UPDATE mahasiswa SET nim = :nim, nama = :nama, email = :email,
                                    prodi_id = :prodi_id, angkatan = :angkatan, status = :status
                                    WHERE id = :id");
        $data['id'] = $id;
        $stmt->execute($data);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare("DELETE FROM mahasiswa WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

    public function search(string $keyword): array
    {
        $stmt = $this->db->prepare("SELECT m.*, p.nama AS nama_prodi
                                    FROM mahasiswa m
                                    JOIN prodi p ON m.prodi_id = p.id
                                    WHERE m.nim LIKE :keyword OR m.nama LIKE :keyword
                                    ORDER BY m.id ASC");
        $stmt->execute(['keyword' => '%' . $keyword . '%']);
        return $stmt->fetchAll();
    }
}