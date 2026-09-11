<?php
namespace App\Models;

class Mahasiswa
{
    private ?int $id;
    private string $nim;
    private string $nama;
    private string $email;
    private int $prodi_id;
    private int $angkatan;
    private string $status;

    public function __construct(array $data = [])
    {
        $this->id = $data['id'] ?? null;
        $this->nim = $data['nim'] ?? '';
        $this->nama = $data['nama'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->prodi_id = $data['prodi_id'] ?? 0;
        $this->angkatan = $data['angkatan'] ?? (int) date('Y');
        $this->status = $data['status'] ?? 'aktif';
    }

    public function getId(): ?int { return $this->id; }
    public function getNim(): string { return $this->nim; }
    public function getNama(): string { return $this->nama; }
    public function getEmail(): string { return $this->email; }
    public function getProdiId(): int { return $this->prodi_id; }
    public function getAngkatan(): int { return $this->angkatan; }
    public function getStatus(): string { return $this->status; }

    public function setNim(string $nim): void
    {
        $nim = trim($nim);
        if (empty($nim)) {
            throw new \InvalidArgumentException("NIM wajib diisi");
        }
        if (strlen($nim) < 3) {
            throw new \InvalidArgumentException("NIM minimal 3 karakter");
        }
        $this->nim = $nim;
    }

    public function setNama(string $nama): void
    {
        $nama = trim($nama);
        if (empty($nama)) {
            throw new \InvalidArgumentException("Nama tidak boleh kosong");
        }
        if (strlen($nama) < 3) {
            throw new \InvalidArgumentException("Nama minimal 3 karakter");
        }
        $this->nama = $nama;
    }

    public function setEmail(string $email): void
    {
        $email = trim($email);
        if (empty($email)) {
            throw new \InvalidArgumentException("Email wajib diisi");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("Format email tidak valid");
        }
        $this->email = $email;
    }

    public function setProdiId(int $prodi_id): void
    {
        if ($prodi_id <= 0) {
            throw new \InvalidArgumentException("Program studi harus dipilih");
        }
        $this->prodi_id = $prodi_id;
    }

    public function setAngkatan(int $angkatan): void
    {
        if ($angkatan < 2000 || $angkatan > (int) date('Y') + 1) {
            throw new \InvalidArgumentException("Angkatan tidak valid");
        }
        $this->angkatan = $angkatan;
    }

    public function setStatus(string $status): void
    {
        $status = strtolower($status);
        if (!in_array($status, ['aktif', 'cuti', 'lulus'])) {
            throw new \InvalidArgumentException("Status tidak valid");
        }
        $this->status = $status;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'nim' => $this->nim,
            'nama' => $this->nama,
            'email' => $this->email,
            'prodi_id' => $this->prodi_id,
            'angkatan' => $this->angkatan,
            'status' => $this->status,
        ];
    }
}