<?php

namespace App\Models;

use Library\Core\AbstractModel;

class UserModel extends AbstractModel
{
    private int $user_id;
    private string $user_name;
    private string $user_email;
    private string $user_address;
    private int $user_income;
    private string $user_password;

    /*SETTERS*/

    public function setuser_id(int $user_id)
    {
        $this->user_id = $user_id;
    }

    public function setuser_name(string $user_name)
    {
        $this->user_name = $user_name;
    }

    public function setuser_email(string $user_email)
    {
        $this->user_email = $user_email;
    }

    public function setuser_address(string $user_address)
    {
        $this->user_address = $user_address;
    }

    public function setuser_income(int $user_income)
    {
        $this->user_income = $user_income;
    }

    public function setuser_password(string $user_password)
    {
        $this->user_password = $user_password;
    }

    /*GETTERS*/

    public function getuser_id(): int
    {
        return $this->user_id;
    }

    public function getuser_name(): string
    {
        return $this->user_name;
    }

    public function getuser_email(): string
    {
        return $this->user_email;
    }

    public function getuser_address(): string
    {
        return $this->user_address;
    }

    public function getuser_income(): int
    {
        return $this->user_income;
    }

    public function getuser_password(): string
    {
        return $this->user_password;
    }

    /*FONCTION PERMETTANT D'INSERER LES INFRMATIONS D'INSCRIPTION DANS LA TABLE USERS*/

    public function create(array $data): ?int
    {
        $userId = $this->db->execute('INSERT INTO users (user_name, user_email, user_address, user_income, user_password) VALUES (:user_name, :user_email, :user_address, :user_income, :user_password)', [
            'user_name' => $data['user_name'],
            'user_email' => $data['user_email'],
            'user_address' => $data['user_address'],
            'user_income' => $data['user_income'],
            'user_password' => $data['user_password']
        ]);

        if ($userId === false) {
            return null;
        }

        return $userId;
    }

    /*FONCTION PERMETTANT DE RECUPERER TOUS LES CHAMPS DE LA TABLE USERS PAR LE CHAMP EMAIL*/

    public function findByUserEmail(string $user_email): ?array
    {
        $user = $this->db->getResults(
            'SELECT user_id, user_name, user_email, user_password
            FROM users
            WHERE user_email = :user_email',
            [
                'user_email' => $user_email
            ]
        );

        if (empty($user)) {
            return null;
        }

        return $user[0];
    }
}
