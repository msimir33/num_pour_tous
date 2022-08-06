<?php

namespace Library\Database;

use PDO;

class Connection
{

    /*CONNEXION A LA BDD*/

    protected PDO $pdo;

    public function __construct(array $config)
    {
        $this->pdo = new PDO(
            "mysql:host={$config['host']};dbname={$config['dbname']};charset=UTF8",
            $config['user'],
            $config['password'],
            [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );
    }

    /*FONCTION PERMETTANT DE RECUPERER LES REQUETES DE PARAMETRAGE DU PDO*/

    public function getResults(string $sql, ?array $parameters = null): array
    {
        $query = $this->pdo->prepare($sql);
        $query->execute($parameters);

        return $query->fetchAll();
    }

    /*EXECUTE LES REQUETES SQL (INSERT, UPDATE, DELETE)*/

    public function execute(string $sql, ?array $parameters = null): string
    {
        $query = $this->pdo->prepare($sql);
        $query->execute($parameters);

        return $this->pdo->lastInsertId();
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }

    public function setPdo(PDO $pdo): void
    {
        $this->pdo = $pdo;
    }
}
