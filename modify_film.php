<?php
include_once 'classes/Database.php';


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $film_id = $_GET['id'];

    $database = new Database('localhost', 'root', '', 'db_project_php');
    $film = $database->read('film', ['id' => $film_id])[0];
} else {
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST['title'];
    $author = $_POST['author'];
    $date = $_POST['date'];
    $film_id = $_GET['id'];


    $database = new Database('localhost', 'root', '', 'db_project_php');


    $success = $database->update('film', ['title' => $title, 'author' => $author, 'date' => $date], ['id' => $film_id]);


    if ($success) {

        header("Location:dashboard.php");
        exit();
    } else {

        $errorMessage = "Si è verificato un errore durante l'aggiornamento del film.";
    }
}
?>

<?php include_once "includes/__header.php" ?>
<div class="container ">
    <div class="text-center">
        <h1>MODIFICA FILM </h1>
    </div>
    <form method="post" action="">
        <input type="hidden" name="film_id" value="<?php echo $film['id']; ?>">
        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Inserisci il titolo" value="<?php echo $film['title']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Autore</label>
            <input type="text" class="form-control" id="author" name="author" placeholder="Inserisci l'autore" value="<?php echo $film['author']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Data</label>
            <input type="date" class="form-control" id="date" name="date" value="<?php echo $film['date']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Modifica Film</button>
    </form>

</div>

<?php include_once "includes/__footer.php" ?>