<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Services\MahasiswaService;
use App\Repositories\MahasiswaRepository;
use App\Models\Prodi;

class MahasiswaController extends Controller
{
    private MahasiswaService $service;
    private Prodi $prodiModel;

    public function __construct()
    {
        $database = new Database();
        $repository = new MahasiswaRepository($database);
        $this->service = new MahasiswaService($repository);
        $this->prodiModel = new Prodi();
    }

    public function index(): void
    {
        $keyword = $_GET['q'] ?? '';
        if (!empty($keyword)) {
            $mahasiswa = $this->service->search($keyword);
        } else {
            $mahasiswa = $this->service->getAll();
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
        try {
            $this->service->create($_POST);
            $_SESSION['flash'] = 'Data mahasiswa berhasil ditambahkan.';
        } catch (\Exception $e) {
            $_SESSION['flash'] = 'Gagal: ' . $e->getMessage();
        }
        $this->redirect('/mahasiswa');
    }

    public function edit($id): void
    {
        $mahasiswa = $this->service->findById((int) $id);
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
        try {
            $this->service->update((int) $id, $_POST);
            $_SESSION['flash'] = 'Data mahasiswa berhasil diupdate.';
        } catch (\Exception $e) {
            $_SESSION['flash'] = 'Gagal: ' . $e->getMessage();
        }
        $this->redirect('/mahasiswa');
    }

    public function destroy($id): void
    {
        try {
            $this->service->delete((int) $id);
            $_SESSION['flash'] = 'Data mahasiswa berhasil dihapus.';
        } catch (\Exception $e) {
            $_SESSION['flash'] = 'Gagal: ' . $e->getMessage();
        }
        $this->redirect('/mahasiswa');
    }
}