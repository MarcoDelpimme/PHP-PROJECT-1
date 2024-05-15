<?php
session_start();

if (!isset($_SESSION['username'])) {

    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['logout'])) {

    session_destroy();


    header("Location: login.php");
    exit();
}

include_once 'classes/Database.php';

$database = new Database('localhost', 'root', '', 'db_project_php');

$films = $database->read('film');

?>

<?php include_once "includes/__header.php" ?>

<div class="container my-5">
    <div class="text-center mt-5">
        <h1 class="text-white display-1">BENVENUTO, <?php echo $_SESSION['username']; ?>!</h1>
        <p style="color:lightgray;">Questa è la tua dashboard.</p>


    </div>
    <ul class="list-group p-5">
        <h1 class="text-start">Film</h1>
        <?php foreach ($films as $film) : ?>
            <li class="list-group-item pulse ">
                <div class="row align-items-center">
                    <div class="col-8">
                        <div class="row">
                            <div class="col-4">
                                <H5>TITOLO:</H5><span class="font-weight-bold"><?php echo $film['title']; ?></span>
                            </div>
                            <div class="col-4">
                                <h5>AUTORE:</h5><span class="ml-2"><?php echo $film['author']; ?></span>
                            </div>
                            <div class="col-4">
                                <h5>DATA PUBBLICAZIONE:</h5> <span class="ml-2"><?php echo $film['date']; ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-4 text-center">
                        <div class="row justify-content-center">
                            <div class="col-auto"> <a href="modify_film.php?id=<?php echo $film['id']; ?>" class="btn btn-primary btn-sm ml-2">Modifica</a></div>
                            <div class="col-auto">
                                <form method="post" action="delete_film.php">

                                    <input type="hidden" name="film_id" value="<?php echo $film['id']; ?>">
                                    <button type="submit" class="btn btn-danger  btn-sm ml-2">Elimina</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>

        <div class="d-flex justify-content-between mt-3">
            <a href="add_film.php" class="btn btn-primary  ">Aggiungi Film</a>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <button type="submit" name="logout" class="btn btn-danger swing">Logout</button>
            </form>
        </div>
    </ul>
</div>

<?php include_once "includes/__footer.php" ?>