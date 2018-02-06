<?php
namespace App\Lib;

use PDO;

class Database
{
    public static function StartUp()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=c0630048_tm;charset=utf8', 'c0630048_tm', 'mi69nuFAnu');

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        return $pdo;
    }
}
