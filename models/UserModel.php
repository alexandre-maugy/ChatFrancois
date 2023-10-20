<?php
require_once('../models/Db.php');

class UserModel
{
    private $id;
    private $username;
    private $db;

    public function __construct()
    {
        $this->db = new Db();
    }

    public function getUserByUsername($username)
    {
        $sql = "SELECT * FROM users WHERE username = :username";
        $this->db->query($sql);
        $this->db->bind(':username', $username);
        $this->db->execute();
        $user = $this->db->fetchAll();
        return $user;
    }

    public function createUser($username)
    {
        $sql = "INSERT INTO users (username) VALUES (:username)";
        $this->db->query($sql);
        $this->db->bind(':username', $username);
        $this->db->execute();
    }
}
