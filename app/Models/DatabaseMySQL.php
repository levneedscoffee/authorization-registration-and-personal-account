<?php
/**
 * Created by PhpStorm.
 * User: homelinux
 * Date: 15.05.18
 * Time: 16:35
 */

namespace Auth\Models;


class DatabaseMySQL implements DataInterface
{

    public function connection()
    {
        $string = file_get_contents('/var/www/auth/config.json');
        $option = json_decode($string, true)['db'];
        $host = $option['servername'];
        $dbname = $option['dbname'];
        $username = $option["username"];
        $password = $option["password"];

        try {
            $pdo = new \PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username , $password);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );
        } catch (\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        return $pdo;
    }
}