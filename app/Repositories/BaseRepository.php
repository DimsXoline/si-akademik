<?php
namespace App\Repositories;

use PDO;
use App\Core\Database;

abstract class BaseRepository
{
    protected PDO $db;

    public function __construct(Database $database)
    {
        $this->db = $database->getConnection();
    }
}