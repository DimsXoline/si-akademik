<?php
namespace App\Core\Middleware;

class AuthMiddleware
{
    public static function handle(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Cek apakah user sudah login
        if (!isset($_SESSION['user'])) {
            $_SESSION['flash'] = [
                'type'    => 'danger',
                'message' => 'Silakan login terlebih dahulu!'
            ];
            
            $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
            header('Location: ' . $baseUrl . '/login');
            exit;
        }
    }
}