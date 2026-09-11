<?php
namespace App\Core;

abstract class Controller
{
    protected function view(string $view, array $data = []): void
    {
        $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
        $data['baseUrl'] = $baseUrl;

        extract($data);
        ob_start();
        $viewFile = __DIR__ . "/../Views/{$view}.php";
        if (file_exists($viewFile)) {
            require $viewFile;
        } else {
            throw new \Exception("View {$view} tidak ditemukan");
        }
        $content = ob_get_clean();
        require __DIR__ . "/../Views/layouts/main.php";
    }

    protected function redirect(string $url): void
    {
        $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
        header("Location: " . $baseUrl . $url);
        exit;
    }
}