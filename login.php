<?php
session_start();
?>
<html>

<head>
    <title> Login</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://accounts.google.com/gsi/client" async defer on:load={googleLoaded}></script>
</head>

<body>
    <div id="color"></div>
    <div id="color2"></div>

    <div class="container">
        <div class="row">
            <div class="col"></div>
            <h2> Login</h2>
            <form action="<?php $PHP_SELF; ?>" method="post">
                <div class="form-object">
                    <label>Name/Mail</label>
                    <input type="text" name="user" id="username" required>
                </div>
                <div class="form-object">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>
                <p id="message"></p>
                <button type="submit" name="submit" class="btn btn-primary">Login</button>
                <div class="g_id_signin" data-on-success="onSignIn" data-type="standard"></div>
            </form>
            <a href="register.php">register </a>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>

<?php
if (isset($_POST['submit'])) {
    include("db.php");

    $name = $_POST['user'];
    $userpassword = $_POST['password'];

    $s = "SELECT * FROM users WHERE(name = ? || email = ?)";
    $stmt = $pdo->prepare($s);
    $stmt->execute(array($name, $name));
    $result = $stmt->fetch();

    if (!is_array($result)) {
        echo '<script type="text/javascript">jsFunction("wrong username/email or password");</script>';
    } else if (password_verify($userpassword, $result["password"])) {
        $_SESSION["username"] = $name;
        $_SESSION['password'] = $userpassword;
        header('location:in.php');
    } else{
        echo '<script type="text/javascript">jsFunction("wrong username/email or password");</script>';
    };
}
?>