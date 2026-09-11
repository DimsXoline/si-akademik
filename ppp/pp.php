<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Repositories\MahasiswaRepository;
use App\Models\Prodi;

class MahasiswaController extends Controller
{
    private MahasiswaRepository $repository;
    private Prodi $prodiModel;

    public function __construct()
    {
        $database = new Database();
        $this->repository = new MahasiswaRepository($database);
        $this->prodiModel = new Prodi();
    }

    public function index(): void
    {
        $keyword = $_GET['q'] ?? '';
        if (!empty($keyword)) {
            $mahasiswa = $this->repository->search($keyword);
        } else {
            $mahasiswa = $this->repository->getAll();
        }
        $this->view('mahasiswa/index', ['listMahasiswa' => $mahasiswa, 'keyword' => $keyword]);
    }

    public function create(): void
    {
        $listProdi = $this->prodiModel->getAll();
        $this->view('mahasiswa/create', ['listProdi' => $listProdi]);
    }

    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mahasiswa = new \App\Models\Mahasiswa($_POST);
            $this->repository->save($mahasiswa);
            $_SESSION['flash'] = 'Data mahasiswa berhasil ditambahkan.';
            $this->redirect('/mahasiswa');
        }
    }

    public function edit($id): void
    {
        $mahasiswa = $this->repository->findById((int) $id);
        if (!$mahasiswa) {
            http_response_code(404);
            echo "Data tidak ditemukan";
            exit;
        }
        $listProdi = $this->prodiModel->getAll();
        $this->view('mahasiswa/edit', [
            'mahasiswa' => $mahasiswa->toArray(),
            'listProdi' => $listProdi
        ]);
    }

    public function update($id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mahasiswa = $this->repository->findById((int) $id);
            if (!$mahasiswa) {
                $_SESSION['flash'] = 'Data tidak ditemukan';
                $this->redirect('/mahasiswa');
            }

            $mahasiswa->setNim($_POST['nim']);
            $mahasiswa->setNama($_POST['nama']);
            $mahasiswa->setEmail($_POST['email']);
            $mahasiswa->setProdiId((int) $_POST['prodi_id']);
            $mahasiswa->setAngkatan((int) $_POST['angkatan']);
            $mahasiswa->setStatus($_POST['status'] ?? 'aktif');

            $this->repository->update($mahasiswa);
            $_SESSION['flash'] = 'Data mahasiswa berhasil diupdate.';
            $this->redirect('/mahasiswa');
        }
    }

    public function destroy($id): void
    {
        $this->repository->delete((int) $id);
        $_SESSION['flash'] = 'Data mahasiswa berhasil dihapus.';
        $this->redirect('/mahasiswa');
    }
}