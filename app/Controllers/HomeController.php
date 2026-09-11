<?php
namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller
{
    public function index(): void
    {
        echo "<h1 style='font-family: Arial;'>Halaman Landing Page (Publik)</h1>";
        $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
        echo "<a href='" . $baseUrl . "/login'>Ke Halaman Login</a>";
    }

    public function dashboard(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $flash = $_SESSION['flash'] ?? null;
        unset($_SESSION['flash']);

        $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

        echo "<div style='font-family: Arial, sans-serif; padding: 20px;'>";
        echo "<h1>Dashboard SI-Akademik</h1>";

        // TUGAS MANDIRI: Tampilkan "Selamat datang, Admin"
        if ($flash) {
            echo "<div style='background: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 12px; border-radius: 4px; margin-bottom: 20px; width: 50%;'>{$flash['message']}</div>";
        }

        echo "<p>Status: <strong>Terautentikasi sebagai " . htmlspecialchars($_SESSION['user']['username']) . "</strong></p>";
        echo "<ul>
                <li><a href='" . $baseUrl . "/mahasiswa'>Kelola Data Mahasiswa</a></li>
                <li><a href='" . $baseUrl . "/logout' style='color: red;'>Logout</a></li>
              </ul>";
        echo "</div>";
    }
}