<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Prodi;

class ProdiController extends Controller
{
    public function index(): void
    {
        $prodiModel = new Prodi();
        $this->view('prodi.index', ['listProdi' => $prodiModel->getAll()]);
    }
}