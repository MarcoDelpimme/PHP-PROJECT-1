<?php
session_start();


if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit();
}


require_once 'classes/Database.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['film_id'])) {
    $film_id = $_POST['film_id'];

    $database = new Database('localhost', 'root', '', 'db_project_php');

    $deleted = $database->delete('film', ['id' => $film_id]);

    if ($deleted) {
        header("location: dashboard.php");
        exit();
    } else {
        echo "Si è verificato un errore durante l'eliminazione del film.";
    }
} else {
    header("location: dashboard.php");
    exit();
}
