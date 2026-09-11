<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Matakuliah;

class MatakuliahController extends Controller
{
    public function index(): void
    {
        $mkModel = new Matakuliah();
        $this->view('matakuliah.index', ['listMk' => $mkModel->getAll()]);
    }
}