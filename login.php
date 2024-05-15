<?php
include_once "classes/User.php";
session_start();

$user = new User();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $login_result = $user->login($username, $password);
    if ($login_result === true) {
        $_SESSION['username'] = $username;
        header("location: dashboard.php");
        exit();
    } else {
        echo $login_result;
    }
}
?>
<?php include_once "includes/__header.php"; ?>
<div class="container p-5">
    <div class="card p-5 ">
        <h2>Login</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div>
                <label for="username" class="form-label">Username:</label>
                <input class="form-control" type="text" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="password">Password:</label>
                <input class="form-control" type="password" id="password" name="password" required>
            </div>
            <button class="btn btn-info swing " type="submit">Login</button>
        </form>
        <div class="container mt-5">
            <div class="row align-items-center">
                <div class="col-auto ms-auto">
                    <h5 class="m-0">Non hai un account? </h5>
                </div>
                <div class="col-auto"><a href="register.php"><button class="btn btn-primary swing" type="submit">Registrati</button></a></div>
            </div>
        </div>
    </div>
</div>
<?php include_once "includes/__footer.php"; ?>