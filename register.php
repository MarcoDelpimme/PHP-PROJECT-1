<?php
include_once "classes/User.php";

$user = new User();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $register_result = $user->register($username, $password);
    if ($register_result === true) {
        $_SESSION['username'] = $username;
        header("location: login.php");
        exit();
    } else {
        echo $register_result;
    }
}
?>
<?php include_once "includes/__header.php"; ?>
<div class="container p-5">
    <div class="card p-5">
        <h2>Registrazione</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div>
                <label class="form-label" for="username">Username:</label>
                <input class="form-control" type="text" id="username" name="username" required>
            </div>
            <div>
                <label class="form-label" for="password">Password:</label>
                <input class="form-control" type="password" id="password" name="password" required>
            </div>
            <button class="btn btn-info mt-3 swing" type="submit">Registrati</button>
        </form>
    </div>
</div>
<?php include_once "includes/__footer.php"; ?>