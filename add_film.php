<?php
include_once 'classes/Database.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST['title'];
    $author = $_POST['author'];
    $date = $_POST['date'];


    $database = new Database('localhost', 'root', '', 'db_project_php');


    $success = $database->create('film', ['title' => $title, 'author' => $author, 'date' => $date]);


    if ($success) {

        header("Location: dashboard.php");
        exit();
    } else {

        $errorMessage = "Si è verificato un errore durante l'inserimento del film.";
    }
}
?>

<?php include_once "includes/__header.php" ?>
<div class="container ">
    <div class="text-center">
        <h1>AGGIUNGI UN FILM </h1>
    </div>
    <form method="post">
        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Inserisci il titolo" required>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Autore</label>
            <input type="text" class="form-control" id="author" name="author" placeholder="Inserisci l'autore" required>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Data</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>
        <button type="submit" class="btn btn-primary">Inserisci Film</button>
    </form>
</div>

<?php include_once "includes/__footer.php" ?>