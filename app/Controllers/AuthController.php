<?php
namespace App\Controllers;

use App\Core\Controller;

class AuthController extends Controller
{
    // Form Login
    public function loginForm(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $flash = $_SESSION['flash'] ?? null;
        unset($_SESSION['flash']);

        $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

        echo "<div style='width: 350px; margin: 60px auto; padding: 25px; border: 1px solid #ddd; border-radius: 8px; font-family: Arial, sans-serif; box-shadow: 0 4px 6px rgba(0,0,0,0.1);'>";
        echo "<h2 style='text-align:center; margin-top:0;'>Form Login</h2>";

        if ($flash) {
            $bgColor     = $flash['type'] === 'success' ? '#d4edda' : '#f8d7da';
            $color       = $flash['type'] === 'success' ? '#155724' : '#721c24';
            $borderColor = $flash['type'] === 'success' ? '#c3e6cb' : '#f5c6cb';
            
            echo "<div style='background: {$bgColor}; color: {$color}; border: 1px solid {$borderColor}; padding: 10px; border-radius: 4px; margin-bottom: 15px; font-size: 14px;'>{$flash['message']}</div>";
        }

        echo '<form action="' . $baseUrl . '/login-process" method="POST">
                <div style="margin-bottom: 15px;">
                    <label>Username:</label><br>
                    <input type="text" name="username" style="width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box;" required>
                </div>
                <div style="margin-bottom: 15px;">
                    <label>Password:</label><br>
                    <input type="password" name="password" style="width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box;" required>
                </div>
                <button type="submit" style="width: 100%; background: #007bff; color: white; padding: 10px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">Login</button>
              </form>';
        echo "</div>";
    }

    // Proses Login
    public function login(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $baseUrl  = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

        if ($username === 'admin' && $password === 'admin123') {
            $_SESSION['user'] = ['username' => 'Admin'];
            
            // TUGAS MANDIRI: Flash message login sukses
            $_SESSION['flash'] = [
                'type'    => 'success',
                'message' => 'Selamat datang, Admin'
            ];
            
            header('Location: ' . $baseUrl . '/dashboard');
            exit;
        } else {
            $_SESSION['flash'] = [
                'type'    => 'danger',
                'message' => 'Username atau password salah!'
            ];
            header('Location: ' . $baseUrl . '/login');
            exit;
        }
    }

    // Process Logout
    public function logout(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        unset($_SESSION['user']);

        // TUGAS MANDIRI: Flash message logout
        $_SESSION['flash'] = [
            'type'    => 'danger',
            'message' => 'Anda telah logout'
        ];

        $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
        header('Location: ' . $baseUrl . '/login');
        exit;
    }
}