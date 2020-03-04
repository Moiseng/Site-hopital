<?php

namespace App;

use PDO;

final class BddConnection
{

    public static function getPDO(): PDO
    {
        return new \PDO("","","",[
            PDO::ERRMODE_EXCEPTION => PDO::ATTR_ERRMODE,
        ]);
    }

}
