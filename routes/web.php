<?php
use App\Core\Router;
use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\MahasiswaController;
use App\Core\Middleware\AuthMiddleware;

$router = new Router();

$router->get('/', [HomeController::class, 'index']);
$router->get('/login', [AuthController::class, 'loginForm']);
$router->post('/login-process', [AuthController::class, 'login']);
$router->get('/logout', [AuthController::class, 'logout']);

$router->get('/dashboard', [HomeController::class, 'dashboard'], [AuthMiddleware::class]);

$router->get('/mahasiswa', [MahasiswaController::class, 'index'], [AuthMiddleware::class]);
$router->get('/mahasiswa/create', [MahasiswaController::class, 'create'], [AuthMiddleware::class]);
$router->post('/mahasiswa', [MahasiswaController::class, 'store'], [AuthMiddleware::class]);
$router->get('#^/mahasiswa/(\d+)/edit$#', [MahasiswaController::class, 'edit'], [AuthMiddleware::class]);
$router->put('#^/mahasiswa/(\d+)$#', [MahasiswaController::class, 'update'], [AuthMiddleware::class]);
$router->delete('#^/mahasiswa/(\d+)$#', [MahasiswaController::class, 'destroy'], [AuthMiddleware::class]);

return $router;