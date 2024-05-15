<?php

class User
{
    private $db;

    public function __construct()
    {
        $stmt = 'mysql:host=localhost;dbname=db_project_php';
        $username = 'root';
        $password = '';

        try {
            $this->db = new PDO($stmt, $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connessione al database fallita: ' . $e->getMessage();
            exit();
        }
    }

    public function login($username, $password)
    {
        $query = "SELECT * FROM userlist_project WHERE username = :username";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':username', $username);
        $statement->execute();

        if ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            if (password_verify($password, $row['password'])) {
                $_SESSION['username'] = $row['username'];
                return true;
            } else {
                return "Password errata.";
            }
        } else {
            return "Utente non trovato.";
        }
    }

    public function register($username, $password)
    {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO userlist_project (username, password) VALUES (:username, :password)";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':username', $username);
        $statement->bindParam(':password', $hashed_password);

        if ($statement->execute()) {
            return true;
        } else {
            return "Errore durante la registrazione.";
        }
    }
}
