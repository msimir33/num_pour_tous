<?php

namespace Library\Core;

use Library\Database\Connection;

abstract class AbstractModel
{
    protected Connection $db;

    /*MODELE ABSTRAIT DU MANAGER*/

    public function __construct()
    {
        $config = require 'config/database.php';
        $this->db = new Connection($config);
    }
}
