<?php
namespace App\Services;

use App\Repositories\MahasiswaRepository;
use App\Models\Mahasiswa;

class MahasiswaService
{
    private MahasiswaRepository $repository;

    public function __construct(MahasiswaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(): array
    {
        return $this->repository->getAll();
    }

    public function findById(int $id): ?Mahasiswa
    {
        return $this->repository->findById($id);
    }

    public function create(array $data): int
    {
        $errors = $this->validate($data);
        if (!empty($errors)) {
            throw new \Exception(implode(", ", $errors));
        }

        $mahasiswa = new Mahasiswa($data);
        return $this->repository->save($mahasiswa);
    }

    public function update(int $id, array $data): void
    {
        $errors = $this->validate($data);
        if (!empty($errors)) {
            throw new \Exception(implode(", ", $errors));
        }

        $mahasiswa = $this->repository->findById($id);
        if (!$mahasiswa) {
            throw new \Exception("Data tidak ditemukan");
        }

        $mahasiswa->setNim($data['nim']);
        $mahasiswa->setNama($data['nama']);
        $mahasiswa->setEmail($data['email']);
        $mahasiswa->setProdiId((int) $data['prodi_id']);
        $mahasiswa->setAngkatan((int) $data['angkatan']);
        $mahasiswa->setStatus($data['status'] ?? 'aktif');

        $this->repository->update($mahasiswa);
    }

    public function delete(int $id): void
    {
        $mahasiswa = $this->repository->findById($id);
        if (!$mahasiswa) {
            throw new \Exception("Data tidak ditemukan");
        }
        $this->repository->delete($id);
    }

    public function search(string $keyword): array
    {
        return $this->repository->search($keyword);
    }

    private function validate(array $data): array
    {
        $errors = [];

        if (empty($data['nim'])) {
            $errors[] = 'NIM wajib diisi';
        } elseif (strlen($data['nim']) < 3) {
            $errors[] = 'NIM minimal 3 karakter';
        }

        if (empty($data['nama'])) {
            $errors[] = 'Nama wajib diisi';
        } elseif (strlen($data['nama']) < 3) {
            $errors[] = 'Nama minimal 3 karakter';
        }

        if (empty($data['email'])) {
            $errors[] = 'Email wajib diisi';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Format email tidak valid';
        }

        if (empty($data['prodi_id']) || $data['prodi_id'] == 0) {
            $errors[] = 'Program studi wajib dipilih';
        }

        if (empty($data['angkatan'])) {
            $errors[] = 'Angkatan wajib diisi';
        } elseif ($data['angkatan'] < 2000) {
            $errors[] = 'Angkatan minimal 2000';
        }

        return $errors;
    }
}