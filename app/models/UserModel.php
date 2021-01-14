<?php

namespace app\models;

use app\libraries\Database;

class UserModel
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function createNewUser($name, $email, $password)
    {

        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $this->db->query('INSERT INTO users (name, email, password) VALUES (:name,:email,:password_hash)');
        $this->db->bind(':name', $name);
        $this->db->bind(':email', $email);
        $this->db->bind(':password_hash', $password_hash);
        return $this->db->execute();
    }

    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) return true;
        return false;
    }

    public function login($email, $password)
    {
        $this->db->query('SELECT * FROM users WHERE email=:email');
        $this->db->bind(':email', $email);

        $user = $this->db->single();

        $password_hash = $user->password;
        if (password_verify($password, $password_hash)) {
            return $user;
        }
        return false;
    }
}